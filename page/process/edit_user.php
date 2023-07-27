<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $id = $_POST['idUser'];

    $encryptedPassword = md5($password);
    
    // Membuat pernyataan SQL untuk melakukan pembaruan data pada tabel ruangan
    $sql = "UPDATE users SET nama='$nama', username='$username', password='$encryptedPassword', email='$email', level='$level' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
?>