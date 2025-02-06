<?php
require 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $is_admin);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = (bool)$is_admin; // Convert to Boolean
            header("Location: admin_panel.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="container login-form">
    <h3 style="color: royalblue; text-align: center;">THE STORY TELLING MUSEUM LOGIN</h3>        <form method="post" action="login.php">
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
        <p><a href="forgot_password.php">Forgot Password?</a></p>
    </div>
</body>
</html>
