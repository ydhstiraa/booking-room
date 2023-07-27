<?php 

include("config/connect.php");

    // Ambil data tanggal awal dan tanggal akhir dari form
    $kode_tracking = $_POST['kode_tracking'];

    // Lakukan query SELECT ke database berdasarkan tanggal

    $sql = "SELECT *, pemesanan.timestamp as dibuat, log.status as status_pemesanan FROM validasi left join pemesanan on validasi.pemesanan_id = pemesanan.id left join log on pemesanan.id = log.pemesanan_id left join users on log.user_id = users.id where kode_tracking='$kode_tracking' GROUP BY log.id";
    $result4 = $conn->query($sql);
	// $row3 = $result4->fetch_assoc();
?>

<table class="table table-hover text-white">
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