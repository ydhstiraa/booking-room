<?php
// Mengimpor kelas PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Memuat autoloader PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Buat objek PHPMailer
$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();                                      // Menggunakan SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Alamat SMTP server Gmail
    $mail->SMTPAuth   = true;                             // Mengaktifkan otentikasi SMTP
    $mail->Username   = 'noreply.bookingapps@gmail.com';           // Email pengirim
    $mail->Password   = 'fsxbhtiumzqdwvdf';            // Kata sandi email
    $mail->SMTPSecure = 'tls';                            // Pengaturan keamanan (tls atau ssl)
    $mail->Port       = 587;                             // Port SMTP (587 untuk TLS, 465 untuk SSL)

    // Informasi pengirim dan penerima
    $mail->setFrom('noreply.bookingapps@gmail.com', 'Booking Apps Garena');
    $mail->addAddress('ownedbyid512@gmail.com', 'Recipient Name');
    $mail->isHTML(true);


    // Subjek dan isi email
    $mail->Subject = 'Garena Booking Information';
    $mail->Body    = '  
    <html>
        <body>
            <h1 style="color: #007bff;">Hai, Bambang!</h1>
            <p style="font-size: 16px;">Berikut adalah kode booking Kamu:</p>
            <h2 style="background-color: #f8d7da; padding: 10px;">64bb510a4b076</h2>
            <p style="font-size: 14px;">Saat ini kita lagi nunggu resepsionis deh buat nge-approve pesanan kamu. Jangan khawatir, kita bakal kabarin secepatnya ya. </p>
            <p style="font-size: 14px;">Oh iya, jangan lupa ya untuk selalu cek email kamu, termasuk folder spam, supaya nggak kelewat info penting dari kita.</p>
            <p style="font-size: 14px;">Makasih udah nunggu!</p>

        </body>
    </html>';

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim.';
} catch (Exception $e) {
    echo "Email gagal dikirim. Pesan kesalahan: {$mail->ErrorInfo}";
}
?>
