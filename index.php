<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Login, Registration, and Password Reset</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="index.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <h1>Login</h1>
    <form method="POST" action="index.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

    <h1>Forgot Password</h1>
    <form method="POST" action="index.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <button type="submit" name="forgot-password">Reset Password</button>
    </form>
</body>
</html>