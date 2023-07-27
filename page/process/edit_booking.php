<?php

    include("../../config/connect.php");

    
    $nama_pemesan = $_POST['nama_pemesan'];
    $ruangan = $_POST['ruangan'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $no_wa = $_POST['no_wa'];
    $email = $_POST['email'];
    $keterangan = $_POST['keterangan'];
    $idPemesanan = $_POST['idPemesanan'];

    // Membuat pernyataan SQL untuk melakukan pembaruan data pada tabel ruangan
    $sql = "UPDATE pemesanan SET nama_pemesan='$nama_pemesan', ruangan_id='$ruangan', tanggal_pemesanan='$tanggal_pemesanan', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', jumlah_kursi='$jumlah_kursi', no_wa='$no_wa', email='$email', keterangan='$keterangan' WHERE id='$idPemesanan'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
    ?>