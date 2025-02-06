<?php
require 'imgconnection.php';

// Function to delete an image by its ID
function deleteImage($conn, $imageId) {
    $query = "SELECT image FROM imagetb WHERE id = $imageId";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $imageFilename = $row['image'];

    // Delete image file from server
    $filePath = 'images/' . $imageFilename;
    if (file_exists($filePath)) {
        unlink($filePath); // Delete the file
    }

    // Delete record from database
    $deleteQuery = "DELETE FROM imagetb WHERE id = $imageId";
    mysqli_query($conn, $deleteQuery);
}

// Handle delete request if image ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image'])) {
    $imageId = $_POST['image_id'];
    deleteImage($conn, $imageId);

    // Redirect back to the same page after deletion
    header('Location: manage_images.php');
    exit;
}

// Fetch images from database in descending order
$query = "SELECT * FROM imagetb ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$imageData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $imageData[] = [
        'id' => $row['id'],
        'image' => $row['image'],
        'description' => $row['description']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Images</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
<div class="navbar">
    <h2>Admin Panel</h2>
    <a href="admin_panel.php">Dashboard</a>
    <a href="imgupload.php">Upload Image</a>
    <a class="highlight" href="manage_images.php">Manage Images</a>
    <a href="index.php">Visit Website</a>
    <a href="manage_contact.php">Manage Contact Data</a>
    <a href="manage_comments.php">Manage Comments</a>
    <a href="vd_upd.php">Upload Announcement and Video</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Manage Uploaded Images</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($imageData as $image): ?>
                <tr>
                    <td><?php echo $image['id']; ?></td>
                    <td><img src="images/<?php echo $image['image']; ?>" alt="Image"></td>
                    <td><?php echo $image['description']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                            <button type="submit" name="delete_image">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>