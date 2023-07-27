<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    $kapasitas = $_POST['kapasitas'];
    $deskripsi = $_POST['deskripsi'];
    $id = $_POST['idRuangan'];
    
    // Membuat pernyataan SQL untuk melakukan pembaruan data pada tabel ruangan
    $sql = "UPDATE ruangan SET nama='$nama', kapasitas='$kapasitas', deskripsi='$deskripsi' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
?>