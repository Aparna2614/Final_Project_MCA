<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $new_password, $token);

        if ($stmt->execute()) {
            echo "Password reset successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid or expired token.";
    }

    $stmt->close();
    $conn->close();
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    die("No token provided.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="container reset-password-form">
        <h1>Reset Password</h1>
        <form method="post" action="reset_password.php">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label>New Password:</label>
            <input type="password" name="new_password" required><br>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>

