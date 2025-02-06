<?php
session_start();
require 'loadenv.php';

// Initialize connection variables
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME_EMAIL');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Insert email into database
    $stmt = $conn->prepare("INSERT INTO email_entry (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo '<div style="width: 100%; max-width: 400px; margin: 20px auto; padding: 50px; text-align: center; border-radius: 
        5px; font-size: 16px; background-color: #4caf50; color: #fff;">Email subscribed successfully!</div>';
        } else {
        // Error message with inline CSS
        echo '<div style="width: 100%; max-width: 400px; margin: 20px auto; padding: 10px; text-align: center; border-radius: 5px; font-size: 16px; background-color: #f44336; color: #fff;">Error: ' . $stmt->error . '</div>';
        }
        
        

    $stmt->close();
    $conn->close();
}
?>
