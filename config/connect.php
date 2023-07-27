<?php

// Mengatur koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking_room";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


