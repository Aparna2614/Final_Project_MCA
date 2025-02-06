<?php
session_start();
require 'loadenv.php';

// Check if user is logged in


// Logout functionality


// Database connection credentials
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$blog_dbname = getenv('BLOG_DB_NAME');

// Create connection to video database
$conn_video = new mysqli($servername, $username, $password, $dbname);
if ($conn_video->connect_error) {
    die("Connection to video database failed: " . $conn_video->connect_error);
}

// Create connection to blog database
$conn_blog = new mysqli($servername, $username, $password, $blog_dbname);
if ($conn_blog->connect_error) {
    die("Connection to blog database failed: " . $conn_blog->connect_error);
}

// Process announcement form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_announcement'])) {
    $announcementTitle = $conn_blog->real_escape_string($_POST['announcementTitle']);
    $announcementContent = $conn_blog->real_escape_string($_POST['announcementContent']);

    $sql = "INSERT INTO blog (title, content) VALUES ('$announcementTitle', '$announcementContent')";
    if ($conn_blog->query($sql) === TRUE) {
        echo '<div class="message-box">Announcement added successfully.</div>';
    } else {
        echo '<div class="error-box">Error adding announcement: ' . $conn_blog->error . '</div>';
    }
}

// Handle delete request for announcements
if (isset($_POST['delete_announcement'])) {
    $id = intval($_POST['id']);
    $deleteSql = "DELETE FROM blog WHERE id = $id";
    if ($conn_blog->query($deleteSql) === TRUE) {
        echo '<div class="message-box">Announcement deleted successfully.</div>';
    } else {
        echo '<div class="error-box">Error deleting announcement: ' . $conn_blog->error . '</div>';
    }
}

// Fetch announcements for display
$announcement_sql = "SELECT id, title, content FROM blog";
$announcement_result = $conn_blog->query($announcement_sql);

// Delete video
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteSql = "DELETE FROM video WHERE id = $id";
    if ($conn_video->query($deleteSql) === TRUE) {
        echo '<div class="message-box">Video deleted successfully.</div>';
    } else {
        echo '<div class="error-box">Error deleting video: ' . $stmt->error . '</div>';
    }
}

// Replace video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['replace'])) {
    $id = intval($_POST['video_id']);
    $videoTitle = $_POST['videoTitle'];
    $videoDescription = $_POST['videoDescription'];
    $videoName = $_FILES['video']['name'];
    $videoType = $_FILES['video']['type'];
    $videoSize = $_FILES['video']['size'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoError = $_FILES['video']['error'];

    if ($videoError === UPLOAD_ERR_OK) {
        $videoData = file_get_contents($videoTmpName);
        $videoData = $conn_video->real_escape_string($videoData); // Use $conn_video here, not $conn

        $updateSql = "UPDATE video SET name = '$videoName', type = '$videoType', size = $videoSize, data = '$videoData', title = '$videoTitle', description = '$videoDescription' WHERE id = $id";
        if ($conn_video->query($updateSql) === TRUE) {
            echo '<div class="message-box">Video replaced successfully.</div>';
        } else {
            echo '<div class=" error-box">Error replacing video: ' . $stmt->error . '</div>';
        }
    } else {
        echo "Upload failed with error code " . $videoError;
    }
}


// Process uploaded file
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload'])) {
    $videoTitle = $_POST['videoTitle'];
    $videoDescription = $_POST['videoDescription'];
    $videoName = $_FILES['video']['name'];
    $videoType = $_FILES['video']['type'];
    $videoSize = $_FILES['video']['size'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoError = $_FILES['video']['error'];

    if ($videoError === UPLOAD_ERR_OK) {
        $videoData = file_get_contents($videoTmpName);
        $videoData = $conn_video->real_escape_string($videoData);

        $sql = "INSERT INTO video (name, type, size, data, title, description) VALUES ('$videoName', '$videoType', $videoSize, '$videoData', '$videoTitle', '$videoDescription')";
        
        if ($conn_video->query($sql) === TRUE) {
            echo '<div class="message-box">Video uploaded successfully.</div>';
        } else {
            echo "Error uploading video: " . $conn->error;
        }
    } else {
        echo '<div class=" error-box">Error uploading video: ' . $stmt->error . '</div>';
    }
}

// Fetch videos for display
$sql = "SELECT id, name, title, description, type, data FROM video";
$result = $conn_video->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <style> .navbar {
    width: 250px;
    background-color:transparent;
    position: absolute;
    height: 100%;
    overflow: auto;
    top: 0;
    left: 0;
}

.navbar a {
    display:block;
    color: white;
    margin-top:-1vh;
    padding: 1.2rem;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.navbar a:hover {
    background-color: rgba(128, 0, 128);
}

.navbar a.highlight{
display:block;
background-color:rgba(128, 0, 128);
}
.navbar h2{
    position:relative;
    left:-4vh;
    top:-2vh;
    font-size: 3rem;
    color:rgba(8,127,149,1);
}


    </style>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="navbar">
        <h2>Admin Panel</h2>
        <a  href="admin_panel.php">Dashboard</a>
        <a  href="imgupload.php">Upload Image</a>
        <a  href="manage_images.php">Manage Images</a>
        <a href="index.php">Visit Website</a>
        <a href="manage_contact.php"> Manage Contact Data</a>
        <a href="manage_comments.php">Manage Comments</a>
        <a class="highlight"href="vd_upd.php">Upload Announcement and Video</a>
        <a href="logout.php">Logout</a>
    </div>
<h2>𝙰𝚍𝚍 𝙰𝚗𝚗𝚘𝚞𝚗𝚌𝚎𝚖𝚎𝚗𝚝</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="announcementTitle">Title:</label>
        <input type="text" id="announcementTitle" name="announcementTitle" required>
        <br><br>
        <label for="announcementContent">Content:</label>
        <textarea id="announcementContent" name="announcementContent" required></textarea>
        <br><br>
        <input type="submit" value="Add Announcement" name="add_announcement">
    </form>
    <!-- Uploaded Announcements -->
    <h2>𝚄𝚙𝚕𝚘𝚊𝚍𝚎𝚍 𝙰𝚗𝚗𝚘𝚞𝚗𝚌𝚎𝚖𝚎𝚗𝚝𝚜</h2>
    <div class="announcement-list">
        <?php if ($announcement_result && $announcement_result->num_rows > 0): ?>
            <?php while ($row = $announcement_result->fetch_assoc()): ?>
                <div class="announcement-item">
                    <h3><?php echo isset($row['title']) ? htmlspecialchars($row['title']) : "No Title"; ?></h3>
                    <p><?php echo isset($row['content']) ? htmlspecialchars($row['content']) : "No Content"; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete_announcement" value="Delete">
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No announcements found.</p>
        <?php endif; ?>
    </div>



    <br>
    <h2>𝚄𝙿𝙻𝙾𝙰𝙳 𝚅𝙸𝙳𝙴𝙾 </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="videoTitle">Title:</label>
        <input type="text" id="videoTitle" name="videoTitle" required>
        <br><br>
        <label for="videoDescription">Description:</label>
        <textarea id="videoDescription" name="videoDescription" required></textarea>
        <br><br>
        <label for="videoFile">Choose video file:</label>
        <input type="file" id="videoFile" name="video" required>
        <br><br>
        <input type="submit" value="Upload" name="upload">
    </form>
    <h2>𝚄𝙿𝙻𝙾𝙰𝙳𝙴𝙳  𝚅𝙸𝙳𝙴𝙾𝚂</h2>
    <div class="video-container">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="video-item">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <video width="300" height="240" controls>
                    <source src="data:<?php echo $row['type']; ?>;base64,<?php echo base64_encode($row['data']); ?>" type="<?php echo $row['type']; ?>">
                    Your browser does not support the video tag.
                </video>
                <br>
                <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="video_id" value="<?php echo $row['id']; ?>">
                    <label for="videoTitle">New Title:</label>
                    <input type="text" id="videoTitle" name="videoTitle" required>
                    <br><br>
                    <label for="videoDescription">New Description:</label>
                    <textarea id="videoDescription" name="videoDescription" required></textarea>
                    <br><br>
                    <label for="videoFile">Choose new video file:</label>
                    <input type="file" id="videoFile" name="video" required>
                    <br><br>
                    <input type="submit" value="Replace" name="replace">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No videos found.</p>
    <?php endif; ?>

    </div>

    
    <br>
    
</body>
</html>
<?php
// Close connection
$conn_video->close();
$conn_blog->close();

?>

