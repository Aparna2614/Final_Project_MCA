<?php
session_start();
require 'loadenv.php';

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Create connection to video database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Museum</title>
    <link rel="stylesheet" href="int.css">
</head>
<body>
    <div class="container">
        <div class="heading">ＶＩＤＥＯ ＧＡＬＬＥＲＹ<hr><br>
        <video width='720' height='540' src="videos/interview.mp4" autoplay muted loop controls></video>
            <?php
            // Query to fetch videos
            $sql = "SELECT id, name, type, data, title, description FROM video"; // Adjusted to fetch necessary columns
            $result = $conn->query($sql);

            // Display videos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $videoId = $row["id"];
                    $videoName = $row["name"];
                    $videoType = $row["type"];
                    $videoData = $row["data"];
                    $videoTitle = $row["title"];
                    $videoDescription = $row["description"];

                    // Output video tag with data
                    echo "<div class='video-item'>";
                    echo "<h3>$videoTitle</h3>";
                    echo "<p>$videoDescription</p>";
                    echo "<video width='720' height='540' controls>";
                    echo "<source src='data:$videoType;base64," . base64_encode($videoData) . "' type='$videoType'>";
                    echo "Your browser does not support the video tag.";
                    echo "</video>";
                    echo "</div>";
                }
            } else {
                echo "No videos found.";
            }

            // Close connection
            $conn->close();
            ?>
            <br>
            
        </div>
    </div>
</body>
</html>


    
    