<?php
require_once 'config.php';
require_once 'UserController.php';

// Create DB con instance
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('DB connection faild: ' . $e->getMessage());
}

$userModel = new User($db);
$userController = new UserController($userModel);


// If the form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        try {
            $userController->registerUser($username, $password);
        } catch (Exception $e) {
        }
        echo "Registration successful!";
    } elseif (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($userController->loginUser($username, $password)) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password!";
        }
    } elseif (isset($_POST['forgot-password'])) {
        $username = $_POST['username'];
        $userController->resetPassword($username);
        echo "Password reset instructions sent to your email!";
    }
}

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