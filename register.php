<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $institution = $_POST['institution'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    $sql = "INSERT INTO registrations (email, name, institution, country, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $name, $institution, $country, $address);

    if ($stmt->execute()) {
        echo "Registrasi sukses!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close();
?>
