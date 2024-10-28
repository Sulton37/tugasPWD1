<?php
include('config.php'); 
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Error: ID not provided.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM registrations WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: No records found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Registration</title>
</head>
<body>
    <h2>Edit Registrasi</h2>
    <form method="POST" action="update_registration.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        Institution: <input type="text" name="institution" value="<?php echo $row['institution']; ?>" required><br>
        Country: <input type="text" name="country" value="<?php echo $row['country']; ?>" required><br>
        Address: <textarea name="address" required><?php echo $row['address']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
