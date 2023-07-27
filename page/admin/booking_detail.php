<?php 

include("../../config/connect.php");

//select data pemesanan
$id = $_POST['id'];
$sql = "SELECT pemesanan.*, pemesanan.id as id_pemesanan FROM pemesanan LEFT JOIN ruangan ON pemesanan.ruangan_id = ruangan.id where pemesanan.id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// select alat apa aja yang dipinjam
$sql2 = "SELECT * FROM detail_alat LEFT JOIN alat ON detail_alat.alat_id = alat.id where detail_alat.pemesanan_id=$id";
$result2 = $conn->query($sql2);

//select log tracking
$sql3 = "SELECT log.*, users.nama AS nama_user FROM log JOIN users ON log.user_id = users.id where log.pemesanan_id = $id order by timestamp desc";
$result3 = $conn->query($sql3);

//select kode tracking 
$sql4 = "SELECT * FROM validasi where pemesanan_id=$id";
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();

//select ruangan
$sql5 = "SELECT * FROM ruangan";
$result5 = $conn->query($sql5);

?>

<div class="col-md-12">
	<!-- <a href='javascript:void(0);' class='back-button' id='back-button'>Kembali</a> -->
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Detail Booking</h4>
		</div>
		<div class="card-body">
			<table class="table">
				<input type="hidden" value="<?= $row['id_pemesanan']?>" id="idPemesanan" name="idPemesanan">
				<tr>
					<td>Kode Tracking / Booking</td>
					<td>:</td>
					<td><?= $row4['kode_tracking']?></td>
				</tr>
				<tr>
					<td>Nama Pemesan</td>
					<td>:</td>
					<td><input type="text" class="form-control" value="<?= $row['nama_pemesan']?>" id="nama_pemesan" name="nama_pemesan"></td>
				</tr>
				<tr>
					<td>Ruangan Yang Dipesan</td>
					<td>:</td>
					<td>
					<select name="ruangan" id="ruangan" class="form-control">	
						<?php 	
							while ($row4 = $result5->fetch_assoc()) {
								if ($row4['nama'] == $row['nama']) {
									echo "<option value='".$row4['id']."' selected>".$row4['nama']."</option>";
								}else{
									echo "<option value='".$row4['id']."'>".$row4['nama']."</option>";
								}        
							}		
						?>
					</select>	
					</td>
				</tr>
				<tr>
					<td>Tanggal Pesan</td>
					<td>:</td>
					<td><input type="date" class="form-control" value="<?= $row['tanggal_pemesanan']?>" id="tanggal_pemesanan" name="tanggal_pemesanan"></td>
				</tr>
				<tr>
					<td>Jam Mulai</td>
					<td>:</td>
					<td><input type="time" class="form-control" value="<?= $row['jam_mulai']?>" id="jam_mulai" name="jam_mulai"></td>
				</tr>
				<tr>
					<td>Jam Selesai</td>
					<td>:</td>
					<td><input type="time" class="form-control" value="<?= $row['jam_selesai']?>" id="jam_selesai" name="jam_selesai"></td>
				</tr>
				<tr>
					<td>Kursi Yang dipakai</td>
					<td>:</td>
					<td><input type="number" class="form-control" value="<?= $row['jumlah_kursi']?>" id="jumlah_kursi" name="jumlah_kursi"></td>
				</tr>
				<tr>
					<td>Nomor Wa</td>
					<td>:</td>
					<td><input type="tel" class="form-control" value="<?= $row['no_wa']?>" id="no_wa" name="no_wa"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="email" class="form-control" value="<?= $row['email']?>" id="email" name="email"></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td>
						<textarea name="keterangan" id="keterangan" class="form-control"><?= $row['keterangan']?></textarea>
					</td>
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
				<tr>
					<td colspan="2"></td>
					<td class="text-right"><button class="btn btn-warning" name="update" id="update">Update</button></td>
				</tr>
			</table>
		</div>
		<div class="card-body">
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
	// document.getElementById('back-button').addEventListener('click', function() {
  	// // Kembali ke halaman sebelumnya
  	// window.history.back();
	// })

	$(document).on('click', '#update', function(e) {
        e.preventDefault(); // Mencegah reload halaman
		console.log("ok")

        // Ambil data form	
        var nama_pemesan = $("#nama_pemesan").val();
        var ruangan = $("#ruangan").val();
        var tanggal_pemesanan = $("#tanggal_pemesanan").val();
        var jam_mulai = $("#jam_mulai").val();
        var jam_selesai = $("#jam_selesai").val();
        var jumlah_kursi = $("#jumlah_kursi").val();
        var no_wa = $("#no_wa").val();
        var email = $("#email").val();
        var keterangan = $("#keterangan").val();
		var idPemesanan = $("#idPemesanan").val();

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: "../process/edit_booking.php",
            method: "POST",
            data: {
                nama_pemesan : nama_pemesan,
				ruangan : ruangan,
				tanggal_pemesanan : tanggal_pemesanan,
				jam_mulai : jam_mulai,
				jam_selesai : jam_selesai,
				jumlah_kursi : jumlah_kursi,
				no_wa : no_wa,
				email : email,
				keterangan : keterangan,
				idPemesanan : idPemesanan
            },
            success: function(response) {
                if (response === "success") {
					$.ajax({
						url: 'booking_detail.php',
						method: 'POST',
						data: { id: idPemesanan,
						},
						success: function(response) {
							$('#mainContent').empty();
							alert('Berhasil update data')
							$('#mainContent').html(response);
						},
						error: function(xhr, status, error) {
							// Kesalahan pada permintaan AJAX
							alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
						}
					});
                    
                } else {
                    alert("Terjadi kesalahan: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan pada permintaan AJAX: " + error);
            }
        });
    });
</script>