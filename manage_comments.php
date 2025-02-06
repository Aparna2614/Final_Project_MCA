<?php
$conn = mysqli_connect("localhost", "root", "", "contactdb");

// Handle comment approval
if(isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $approve_sql = "UPDATE commenttb SET approved = 1 WHERE id = $approve_id";
    if ($conn->query($approve_sql) === TRUE) {
        echo "<script>alert('Comment approved successfully');</script>";
    } else {
        echo "Error approving comment: " . $conn->error;
    }
}

// Handle delete functionality
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM commenttb WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all comments and replies
$limit = 10; // Number of comments to display initially
$offset = 0; 
$comments = mysqli_query($conn, "SELECT * FROM commenttb WHERE reply_id = 0 ORDER BY date DESC LIMIT $limit OFFSET $offset");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Comments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

<link rel="stylesheet" type="text/css" href="admin.css">

</head>
<body>

<div class="navbar">
        <h2>Admin Panel</h2>
        <a  href="admin_panel.php">Dashboard</a>
        <a  href="imgupload.php">Upload Image</a>
        <a href="manage_images.php">Manage Images</a>
        <a href="index.php">Visit Website</a>
        <a href="manage_contact.php"> Manage Contact Data</a>
        <a class="highlight" href="manage_comments.php">Manage Comments</a>
        <a href="vd_upd.php">Upload Announcement and Video</a>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Manage Comments</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($comments as $comment) : ?>
                <tr>
                    <td><?= $comment['id']; ?></td>
                    <td><?= $comment['Name']; ?></td>
                    <td><?= $comment['comment']; ?></td>
                    <td><?= $comment['date']; ?></td>
                    <td>
                        <?php if ($comment['approved'] == 0) : ?>
                            <a href="manage_comments.php?approve_id=<?= $comment['id']; ?>">Approve</a> |
                        <?php endif; ?>
                        <a href="manage_comments.php?delete_id=<?= $comment['id']; ?>" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</a>
                    </td>
                </tr>
                <?php
                // Fetch replies for this comment
                $reply_id = $comment['id'];
                $replies = mysqli_query($conn, "SELECT * FROM commenttb WHERE reply_id = $reply_id");
                if(mysqli_num_rows($replies) > 0) {
                    foreach($replies as $reply){
                        echo '<tr>';
                        echo '<td>' . $reply['id'] . '</td>';
                        echo '<td>' . $reply['Name'] . '</td>';
                        echo '<td>' . $reply['comment'] . '</td>';
                        echo '<td>' . $reply['date'] . '</td>';
                        echo '<td>';
                        if ($reply['approved'] == 0) {
                            echo '<a href="manage_comments.php?approve_id=' . $reply['id'] . '">Approve</a> | ';
                        }
                        echo '<a href="manage_comments.php?delete_id=' . $reply['id'] . '" onclick="return confirm(\'Are you sure you want to delete this reply?\')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
