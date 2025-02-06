
<?php
session_start();
require 'loadenv.php';

// Initialize connection variables
$conn = null;

// Assuming you have a database connection established
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$blog_dbname = getenv('BLOG_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $blog_dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch undeleted announcements for display
$announcement_sql = "SELECT id, title, content FROM blog WHERE deleted = 0 ORDER BY created_at DESC";

$announcement_result = $conn->query($announcement_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>

body{
     background: rgb(63,13,115);
    background: linear-gradient(90deg, rgba(63,13,115,1) 7%, rgba(240,152,77,1) 51%, rgba(8,127,149,1) 100%);
    padding:0;
    margin:0;
}
 .navcurrent{
  
background-color: rgb(104, 39, 166);
color:beige;
}
    .announcement-list {
            max-width: 1200px;
            margin: 20px auto;
            padding: 40px;
            background: rgb(63,13,115);
            background: linear-gradient(90deg, rgba(63,13,115,1) 7%, rgba(240,152,77,1) 51%, rgba(8,127,149,1) 100%);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 15px;
        }

        .announcement-list h2 {
            font-size: 4.5rem;
            margin-top: 0;
            padding-bottom: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: -webkit-linear-gradient(#002c64, #763fbe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .announcement-item {
            margin-bottom: 40px;
            padding: 30px;
            background-color: #edf3b3;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .announcement-item h3 {
            font-size: 2rem;
            margin-top: 0;
            color: #1e90ff;
        }

        .announcement-item p {
            margin-top: 10px;
            line-height: 1.8;
            color: #333;
            font-size: 1.2rem;
        }

        @media screen and (max-width: 768px) {
            .announcement-list {
                padding: 20px;
            }

            .announcement-list h2 {
                font-size: 3rem;
                padding-bottom: 20px;
            }

            .announcement-item {
                padding: 20px;
            }

            .announcement-item h3 {
                font-size: 1.5rem;
            }

            .announcement-item p {
                font-size: 1rem;
            }
        }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($announcement_title); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="navbar">
        <div class="bar" style="height: 5.5vh; border-spacing: 10rem;">
        <p id="heading">THE STORY TELLING MUSEUM</p>
        <ul>
        <li><a href="index.php">HOME</a></li>
                <li><a href="imgdata.php">IMAGES</a></li>
                <li><a href="vdo.php">VIDEOS</a></li>
                <li class="navcurrent"><a href="storyteller.php">STORY TELLER</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
        </ul>
    </div>
</header>
<div class="announcement-list">
    <h2>𝕿𝖍𝖊 𝕻𝖆𝖗𝖙𝖎𝖙𝖎𝖔𝖓 𝕾𝖙𝖔𝖗𝖎𝖊𝖘</h2>
    <?php if ($announcement_result && $announcement_result->num_rows > 0): ?>
        <?php while ($row = $announcement_result->fetch_assoc()): ?>
            <div class="announcement-item">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No announcements found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php

// Close connection
$conn->close();
?>