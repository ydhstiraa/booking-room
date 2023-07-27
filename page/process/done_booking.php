<?php 

include("../../config/connect.php");
include("input_log.php");

$id = $_POST['id'];
$user_id = $_POST['user_id'];

$sql = "UPDATE pemesanan SET status = 'Finished' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    insertLogToDatabase($user_id, $id, "Finished");
    echo 'success';
} else {
    echo 'Terjadi kesalahan saat mengubah status: ' . $conn->error;
}

$conn->close();
?>