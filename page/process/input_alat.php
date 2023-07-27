<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    
    $sql = "INSERT INTO alat ( nama)
        VALUES ( '$nama')";
    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'Terjadi kesalahan saat mengubah status: ' . $conn->error;
    }

$conn->close();
?>