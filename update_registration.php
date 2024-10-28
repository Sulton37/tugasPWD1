<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $institution = $_POST['institution'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    $sql = "UPDATE registrations SET email = ?, name = ?, institution = ?, country = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $email, $name, $institution, $country, $address, $id);

    if ($stmt->execute()) {
        echo "Registrasi sukses diperbaharui";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close();
?>
