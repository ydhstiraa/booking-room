<?php
include("../../config/connect.php");

    // Ambil data tanggal awal dan tanggal akhir dari form
    $tanggal_awal = $_POST['tgl_awal'];
    $tanggal_akhir = $_POST['tgl_akhir'];

    // Lakukan query SELECT ke database berdasarkan tanggal

    $sql = "SELECT pemesanan.*, validasi.kode_tracking as kode_tracking from pemesanan LEFT JOIN validasi on pemesanan.id = validasi.pemesanan_id WHERE tanggal_pemesanan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

    // Eksekusi query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<button class='btn' onclick='exportToExcel()'>Export to Excel</button>";
        echo "<table class='table'  id='myTable'>
                <tr>
                    <th>No</th>
                    <th>Kode Booking / Tracking</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Jumlah Kursi</th>
                    <th>Nomor WA</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                </tr>";
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no. "</td>";
            echo "<td>" . $row['kode_tracking'] . "</td>";
            echo "<td>" . $row['nama_pemesan'] . "</td>";
            echo "<td>" . $row['tanggal_pemesanan'] . "</td>";
            echo "<td>" . $row['jam_mulai'] . "</td>";
            echo "<td>" . $row['jam_selesai'] . "</td>";
            echo "<td>" . $row['jumlah_kursi'] . "</td>";
            echo "<td>" . $row['no_wa'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "</tr>";
            $no++;
        }
        echo "</table>";
    } else {
        echo "Tidak ada data yang sesuai dengan tanggal yang dipilih.";
    }


    // Tutup koneksi database
    $conn->close();
?>