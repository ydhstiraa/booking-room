<?php

include("../../config/connect.php");

    $nama = $_POST['nama'];
    $id = $_POST['idAlat'];
    
    // Membuat pernyataan SQL untuk melakukan pembaruan data pada tabel ruangan
    $sql = "UPDATE alat SET nama='$nama' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
?>