<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    $kapasitas = $_POST['kapasitas'];
    $deskripsi = $_POST['deskripsi'];
    
    $sql = "INSERT INTO ruangan ( nama, kapasitas, deskripsi)
        VALUES ( '$nama', '$kapasitas', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'Terjadi kesalahan saat mengubah status: ' . $conn->error;
    }

$conn->close();
?>