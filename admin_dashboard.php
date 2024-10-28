<?php
include('config.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $institution = $_POST['institution'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    
    $check_email = "SELECT * FROM registrations WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error:Email sudah digunakan!";
    } else {
        $sql = "INSERT INTO registrations (email, name, institution, country, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $name, $institution, $country, $address);

        if ($stmt->execute()) {
            echo "Registrasi sukses ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Manage Registrations</title>
</head>
<body>
    <h2>Atur Registrasi</h2>

        <h3>Tambah Registrasi</h3>
    <form method="POST" action="">
        Email: <input type="email" name="email" required><br>
        Name: <input type="text" name="name" required><br>
        Institution: <input type="text" name="institution" required><br>
        Country: <input type="text" name="country" required><br>
        Address: <textarea name="address" required></textarea><br>
        <input type="submit" value="Add Registration">
    </form>

    <br><br>

    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Institution</th>
            <th>Country</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM registrations");
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['email']}</td>
                <td>{$row['name']}</td>
                <td>{$row['institution']}</td>
                <td>{$row['country']}</td>
                <td>{$row['address']}</td>
                <td>
                    <a href='edit_registration.php?id={$row['id']}'>Edit</a> |
                    <a href='delete_registration.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
