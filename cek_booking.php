<?php 

include("config/connect.php");

    // Ambil data tanggal awal dan tanggal akhir dari form
    $kode_tracking = $_POST['kode_tracking'];

    // Lakukan query SELECT ke database berdasarkan tanggal

    $sql = "SELECT *, pemesanan.timestamp as dibuat, log.status as status_pemesanan FROM validasi left join pemesanan on validasi.pemesanan_id = pemesanan.id left join log on pemesanan.id = log.pemesanan_id left join users on log.user_id = users.id where kode_tracking='$kode_tracking' GROUP BY log.id";
    $result4 = $conn->query($sql);
	// $row3 = $result4->fetch_assoc();

	if ($result4->num_rows > 0) {
?>

<table class="table table-hover text-white mt-3">
				<thead>
					<tr>
						<th>Timestamp</th>
						<th>User</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<!-- <tr>
						<td><?= $row3['dibuat']?></td>
						<td><?= $row3['nama_pemesan']?></td>
						<td>Created</td>
					</tr> -->
					<?php
						while ($row3 = $result4->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$row3['timestamp']."</td>";
							echo "<td>".$row3['nama']."</td>";
							echo "<td>".$row3['status_pemesanan']."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
<?php
	}else{
?>
	<!-- <h4 class="text-white text-center mt-2"></h4> -->
	<script>alert("Data yang kamu masukkan salah, Cek kembali kode Booking / Tracking kamu")</script>
<?php
	}
?>