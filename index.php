<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Seminar</title>
</head>
<body>
    <h2>Registrasi Seminar</h2>
    <form method="POST" action="register.php">
        Email: <input type="email" name="email" required><br>
        Name: <input type="text" name="name" required><br>
        Institution: <input type="text" name="institution" required><br>
        Country: <input type="text" name="country" required><br>
        Address: <textarea name="address" required></textarea><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
