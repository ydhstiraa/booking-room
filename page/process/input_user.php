<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    $encryptedPassword = md5($password);
    
    $sql = "INSERT INTO users (nama, username, password, email, level)
        VALUES ( '$nama', '$username', '$encryptedPassword', '$email', '$level')";
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'Terjadi kesalahan saat mengubah status: ' . $conn->error;
    }

$conn->close();
?>