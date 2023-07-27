<?php

include("../../config/connect.php");
    $id = $_POST['idUser'];
    
    // Membuat pernyataan SQL untuk melakukan pembaruan data pada tabel ruangan
    $sql = "UPDATE users SET status = 'Inactive' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
?>