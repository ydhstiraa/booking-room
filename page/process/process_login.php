<?php
include("../../config/connect.php");

session_start();

// Mendapatkan nilai dari form
$username = $_POST['username'];
$password = $_POST['password'];

$encryptedPassword = md5($password);

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$encryptedPassword'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Jika data ditemukan, set session
    
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $row['email'];
    $_SESSION['userIdLogin'] = $row['id'];
    $_SESSION['level'] = $row['level'];
    
    if ($row['level'] == "admin") {
        // Redirect ke halaman utama
        header('Location: ../admin/home.php');
    }if ($row['level'] == "user") {
        // Redirect ke halaman utama
        header('Location: ../user/home.php');
    }


    exit();
} else {
    // Jika tidak valid, kembali ke halaman login dengan pesan error
    $_SESSION['login_error'] = 'Username or password is incorrect.';
    header('Location: ../../login.php');
    exit();
}

$conn->close();

?>