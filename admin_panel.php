<?php
require 'config.php';


if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
<div class="navbar">
        <h2>Admin Panel</h2>
        <a class="highlight" href="admin_panel.php">Dashboard</a>
        <a href="imgupload.php">Upload Image</a>
        <a href="manage_images.php">Manage Images</a>
        <a href="index.php">Visit Website</a>
        <a href="manage_contact.php"> Manage Contact Data</a>
        <a href="manage_comments.php">Manage Comments</a>
        <a href="vd_upd.php">Upload Announcement and Video</a>

        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1 style="color: royalblue; text-align: center;">Welcome to THE STORY TELLING MUSEUM, <?php echo $_SESSION['email']; ?>!</h1>
        
    </div>
</body>
</html> 

