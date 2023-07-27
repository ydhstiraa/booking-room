<?php 

include("../../config/connect.php");
include("input_log.php");

// Mengupdate status menjadi "Approved" berdasarkan ID
$id = $_POST['id'];
$user_id = $_POST['user_id'];

$sql = "UPDATE pemesanan SET status = 'Cancel' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    insertLogToDatabase($user_id, $id, "Canceled");
    echo 'success';
} else {
    echo 'Terjadi kesalahan saat mengubah status: ' . $conn->error;
}

$conn->close();
?>