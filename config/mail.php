<?php
// Mengimpor kelas PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Memuat autoloader PHPMailer
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// Buat objek PHPMailer
$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();                                      // Menggunakan SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Alamat SMTP server Gmail
    $mail->SMTPAuth   = true;                             // Mengaktifkan otentikasi SMTP
    $mail->Username   = 'your_email@gmail.com';           // Email pengirim
    $mail->Password   = 'your_email_password';            // Kata sandi email
    $mail->SMTPSecure = 'tls';                            // Pengaturan keamanan (tls atau ssl)
    $mail->Port       = 587;                             // Port SMTP (587 untuk TLS, 465 untuk SSL)

    // Informasi pengirim dan penerima
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Subjek dan isi email
    $mail->Subject = 'Contoh Email dengan PHPMailer';
    $mail->Body    = 'Ini adalah contoh email yang dikirim menggunakan PHPMailer.';

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim.';
} catch (Exception $e) {
    echo "Email gagal dikirim. Pesan kesalahan: {$mail->ErrorInfo}";
}
?>
