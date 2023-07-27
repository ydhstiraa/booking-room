<?php
    function insertLogToDatabase($user_id, $pemesanan_id, $status) {
        include("../../config/connect.php");

        $sql = "INSERT INTO log (user_id, status, pemesanan_id) VALUES ('$user_id', '$status', '$pemesanan_id')";
        $conn->query($sql);
    }
?>