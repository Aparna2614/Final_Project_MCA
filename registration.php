<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $is_admin = 0; // By default, users are not admin

    $stmt = $conn->prepare("INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $email, $password, $is_admin);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="container registration-form">
        <h1>Register</h1>
        <form method="post" action="registration.php">
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

