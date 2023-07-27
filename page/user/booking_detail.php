<?php 

include("../../config/connect.php");

// Mengupdate status menjadi "Approved" berdasarkan ID
$id = $_POST['id'];
$sql = "SELECT * FROM pemesanan LEFT JOIN ruangan ON pemesanan.ruangan_id = ruangan.id where pemesanan.id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql2 = "SELECT * FROM detail_alat LEFT JOIN alat ON detail_alat.alat_id = alat.id where detail_alat.pemesanan_id=$id";
$result2 = $conn->query($sql2);

$sql3 = "SELECT log.*, users.nama AS nama_user FROM log JOIN users ON log.user_id = users.id where log.pemesanan_id = $id order by timestamp desc";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM validasi where pemesanan_id=$id";
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();
?>

<div class="col-md-12">
	<a href='javascript:void(0);' class='back-button' id='back-button'>Kembali</a>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Detail Booking</h4>
		</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<td>Kode Tracking / Booking</td>
					<td>:</td>
					<td><?= $row4['kode_tracking']?></td>
				</tr>
				<tr>
					<td>Nama Pemesan</td>
					<td>:</td>
					<td><?= $row['nama_pemesan']?></td>
				</tr>
				<tr>
					<td>Ruangan Yang Dipesan</td>
					<td>:</td>
					<td><?= $row['nama']?></td>
				</tr>
				<tr>
					<td>Tanggal Pesan</td>
					<td>:</td>
					<td><?= $row['tanggal_pemesanan']?></td>
				</tr>
				<tr>
					<td>Jam Mulai</td>
					<td>:</td>
					<td><?= $row['jam_mulai']?></td>
				</tr>
				<tr>
					<td>Jam Selesai</td>
					<td>:</td>
					<td><?= $row['jam_selesai']?></td>
				</tr>
				<tr>
					<td>Kursi Yang dipakai</td>
					<td>:</td>
					<td><?= $row['jumlah_kursi']?></td>
				</tr>
				<tr>
					<td>Nomor Wa</td>
					<td>:</td>
					<td><?= $row['no_wa']?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?= $row['email']?></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><?= $row['keterangan']?></td>
				</tr>
				<tr>
					<td>Alat yang dipinjam</td>
					<td>:</td>
					<td>
						<ul>

						<?php 
						if ($result2->num_rows > 0) {
							while ($row2 = $result2->fetch_assoc()) {
								echo "<li>".$row2['nama']."</li>";
							}
						}else{
							echo "<li>Tidak ada alat yang dipinjam</li>";
						}
						?>
						</ul>
					</td>
				</tr>
			</table>
			<div class="card-title">Log Aktivitas</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Timestamp</th>
						<th>User</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= $row['timestamp']?></td>
						<td><?= $row['nama_pemesan']?></td>
						<td>Created</td>
					</tr>
					<?php
						while ($row3 = $result3->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$row3['timestamp']."</td>";
							echo "<td>".$row3['nama_user']."</td>";
							echo "<td>".$row3['status']."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
        </div>
    </div>
</div>

<script>
	document.getElementById('back-button').addEventListener('click', function() {
  	// Kembali ke halaman sebelumnya
  	window.history.back();
	})
</script>