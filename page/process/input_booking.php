<?php




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Garena</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="../../css/my-styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

    <?php 
    include("../../config/connect.php");
    include("input_log.php");

    $namaPemesan = $_POST['nama_pemesan'];
    $tanggalPemesanan = $_POST['tanggal_pemesanan'];
    $jamMulai = $_POST['jam_mulai'];
    $jamSelesai = $_POST['jam_selesai'];
    $jumlahKursi = $_POST['jumlah_kursi'];
    $nomorWA = $_POST['no_wa'];
    $email = $_POST['email'];
    $keterangan = $_POST['keterangan'];
    $ruangan = $_POST['ruangan'];
    $selectedItems = $_POST['alat'];
    

    // foreach ($selectedItems as $itemId) {
    //     // Lakukan query INSERT untuk menyimpan nilai ke dalam tabel database
    //     $sql = "INSERT INTO detail_alat (item_name) VALUES ('$itemId')";
    //     if ($conn->query($sql) !== TRUE) {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // }
    
    //generate ko booking
    function generateKodeUnik() {
        return uniqid();
    }
    
    function isKodeUnikExists($kode_unik, $conn) {
        $sql = "SELECT COUNT(*) AS count FROM validasi WHERE kode_tracking = '$kode_unik'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        }
    
        return false;
    }

    do {
        $kode_unik = generateKodeUnik();
    }while (isKodeUnikExists($kode_unik, $conn));
    
    //insert data pemesanan
    $sql = "INSERT INTO pemesanan ( ruangan_id, nama_pemesan, tanggal_pemesanan, jam_mulai, jam_selesai, jumlah_kursi, no_wa, email, keterangan)
        VALUES ( '$ruangan', '$namaPemesan', '$tanggalPemesanan', '$jamMulai', '$jamSelesai', '$jumlahKursi', '$nomorWA', '$email', '$keterangan')";
        
    if ($conn->query($sql) === TRUE) {
        $inserted_id = $conn->insert_id;
        // insert data kode booking ke pemesanan
        $sql2 = "INSERT INTO validasi (pemesanan_id, kode_tracking) VALUES ('$inserted_id', '$kode_unik')";
            if ($conn->query($sql2) === TRUE) {
                echo "Kode unik berhasil disimpan: $kode_unik";
        }
        foreach ($selectedItems as $itemId) {
            // Lakukan query INSERT untuk menyimpan nilai ke dalam tabel database
            $sql = "INSERT INTO detail_alat (pemesanan_id, alat_id) VALUES ('$inserted_id', '$itemId')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        echo " 
        <input type='hidden' id='nama' value='".$namaPemesan."'>
        <input type='hidden' id='email' value='".$email."'>
        <input type='hidden' id='kode' value='".$kode_unik."'>
        <div class='card mt-4 ' id='submitSuccessMessage'>
            <div class='text-center mb-3'>
                <div class='fw-bolder'>Form submission successful!</div>
                Kode Booking / Tracking Kamu ".$kode_unik."
                <br />
                <div class='fw-bolder'>Periksa email kamu secara berkala</div>
                <a href='../../index.php'>Home</a>
            </div>
        </div> ";
        } else {
        echo "Terjadi kesalahan: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    ?>


        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
        <script>
        $(document).ready(function() {
            // Mendapatkan nilai ID dari data attribute
            var nama = document.getElementById('nama').value
            var email = document.getElementById('email').value
            var kode = document.getElementById('kode').value

            // Mengirim permintaan AJAX ke server
            $.ajax({
            url: '../../config/mail.php',
            method: 'POST',
            data: { 
                type : 'input',
                nama,
                email,
                kode,
                },
            success: function(response) {
                // Memperbarui status pada halaman secara dinamis
                if (response === 'success') {
                // Status berhasil diubah
                alert('Email berhasil terkirim!.');
                // Lakukan perubahan pada tampilan sesuai kebutuhan (misalnya, ubah warna tombol)
                } else {
                // Terjadi kesalahan saat mengubah status
                alert('Terjadi kesalahan saat mengubah status: ' + response);
                }
            },
            error: function(xhr, status, error) {
                // Kesalahan pada permintaan AJAX
                alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
            }
            });
        });
        </script>
    </body>
</html>