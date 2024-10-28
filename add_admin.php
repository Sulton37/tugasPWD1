<?php
include('config.php');

// Masukkan password langsung tanpa hashing
$password = password_hash("admin_password", PASSWORD_DEFAULT); // Hash password untuk keamanan

// Query untuk menambahkan admin baru
$sql = "INSERT INTO admin (username, password) VALUES ('admin', '$password')";
$conn->query($sql);

echo "Admin added successfully!";
$conn->close();
?>
