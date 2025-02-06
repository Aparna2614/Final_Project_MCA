<?php
require 'imgconnection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $images = $_FILES['image'];

    foreach ($images['tmp_name'] as $key => $tmpName) {
        $descriptionText = mysqli_real_escape_string($conn, $description[$key]); // Escape to prevent SQL injection
        $originalFileName = mysqli_real_escape_string($conn, $images['name'][$key]);

        // Check if the file already exists and generate a unique name if necessary
        $uploadDir = 'images/';
        $filePath = $uploadDir . $originalFileName;
        $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $fileNameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);
        $counter = 1;

        while (file_exists($filePath)) {
            $filePath = $uploadDir . $fileNameWithoutExt . '_' . $counter . '.' . $fileExt;
            $counter++;
        }

        // Move the uploaded file
        move_uploaded_file($tmpName, $filePath);
        
        // Resize the image if necessary
        $newWidth = 800; // Set your desired width
        $newHeight = 800; // Set your desired height

        list($width, $height) = getimagesize($filePath);
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        $sourceImage = imagecreatefromjpeg($filePath);

        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save the resized image
        imagejpeg($resizedImage, $filePath);

        // Store image info in the database
        $fileName = basename($filePath); // Get the final filename
        $query = "INSERT INTO imagetb (description, image) VALUES ('$descriptionText', '$fileName')";
        mysqli_query($conn, $query);


        // Reload and redirect to the same page
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;

       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image File</title>
    <link rel="stylesheet" type="text/css" href="admin.css">

    <style>

textarea {
    width: 100%; /* Full width of the container */
    max-width: 100%; /* Prevent exceeding the container width */
    padding: 10px; /* Padding inside the textarea */
    border: 1px solid #ddd; /* Light border */
    border-radius: 4px; /* Rounded corners */
    font-size: 14px; /* Font size */
    line-height: 1.5; /* Line height */
    resize: vertical; /* Allow vertical resizing only */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
    background-color: #fff; /* White background */
    margin-bottom: 15px; /* Space below the textarea */
    transition: border-color 0.3s ease; /* Smooth transition for border color */
}

/* Apply styles when textarea is focused */
textarea:focus {
    border-color: #2287d9; /* Blue border color on focus */
    outline: none; /* Remove default outline */
    box-shadow: 0 4px 12px rgba(34, 135, 217, 0.2); /* Slightly deeper shadow on focus */
}

/* Optional: Apply styles to label associated with textarea */
label[for="description"] {
    display: block; /* Ensure label takes full width */
    margin-bottom: 5px; /* Space between label and textarea */
    font-weight: bold; /* Bold text for label */
    font-size: 16px; /* Font size */
}
    </style>
</head>
<body>
<div class="navbar">
        <h2>Admin Panel</h2>
        <a  href="admin_panel.php">Dashboard</a>
        <a class="highlight" href="imgupload.php">Upload Image</a>
        <a href="manage_images.php">Manage Images</a>
        <a href="index.php">Visit Website</a>
        <a href="manage_contact.php"> Manage Contact Data</a>
        <a href="manage_comments.php">Manage Comments</a>
        <a href="vd_upd.php">Upload Announcement and Video</a>

        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <div class="upload-form">
            <h1>Upload Image File</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="description">Description:</label>
                <textarea name="description[]" id="description" required></textarea><br>
                <label for="image">Image:</label>
                <input type="file" name="image[]" id="image" accept=".jpg, .jpeg, .png" required><br><br>
                <button type="submit" name="submit">Submit</button>
            </form>
            <br>
            <a href="imgdata.php">View Uploaded Images</a>
        </div>
    </div>
</body>
</html>
