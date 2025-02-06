<?php
require 'config.php'; // Include your database connection file

// Admin user details
$email = 'admin@example.com'; // Change to your desired admin email
$password = password_hash('admin123', PASSWORD_BCRYPT); // Change to your desired admin password
$is_admin = 1; // 1 represents true, meaning this user is an admin

// Prepare the SQL query
$stmt = $conn->prepare("INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $email, $password, $is_admin);

// Execute the query and check for errors
if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>