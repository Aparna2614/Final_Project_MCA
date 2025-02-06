<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Data</title>
    <style>
        
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #ca2e2e;
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
        <a class="highlight"href="manage_contact.php"> Manage Contact Data</a>
        <a href="manage_comments.php">Manage Comments</a>
        <a href="vd_upd.php">Upload Announcement and Video</a>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Contact Data</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "contactdb";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Delete functionality
            if(isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $delete_sql = "DELETE FROM contacttb WHERE id = $delete_id";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "<script>alert('Record deleted successfully');</script>";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            // Query to fetch contact data including submission_date
            $sql = "SELECT id, name, email, contact, message, submission_date FROM contacttb ORDER BY id DESC" ;
            $result = $conn->query($sql);

            // Display data
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["contact"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";
                    echo "<td>" . $row["submission_date"] . "</td>";
                    echo "<td><a class='delete-btn' href='contactdata.php?delete_id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No contact data available</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
