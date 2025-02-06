<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a random reset token
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt->close();

        // Store the reset token in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);

        if ($stmt->execute()) {
            // Send reset email (here we just echo the token for simplicity)
            echo "Reset link: <a href='reset_password.php?token=$token'>reset_password.php?token=$token</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="container forgot-password-form">
        <h1>Forgot Password</h1>
        <form method="post" action="forgot_password.php">
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>

