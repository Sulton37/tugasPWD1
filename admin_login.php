<?php include('config.php'); session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST" action="admin_login.php">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $conn->query("SELECT * FROM admin WHERE username = '$username'");
        $admin = $result->fetch_assoc();

        if ($admin && $admin['password'] === $password) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
        } else {
            echo "Invalid login credentials!";
        }
    }
    ?>
</body>
</html>
