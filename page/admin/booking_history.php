<?php
include("../../config/connect.php");
session_start();
$userIdLogin = $_SESSION['userIdLogin'];

// Query SQL
$selectDataTable = "SELECT pemesanan.*, ruangan.nama FROM pemesanan LEFT JOIN ruangan ON pemesanan.ruangan_id = ruangan.id where pemesanan.status = 'Finished' ORDER BY timestamp DESC";
$result = $conn->query($selectDataTable);
?>

<div class="page-header">
	<h4 class="page-title">Booking Portal</h4>
</div>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Multi Filter Select</h4>
		</div>
		<div class="card-body">
			<input type="hidden" id="user_id" value=<?=$userIdLogin?>>
			<div class="table-responsive">
				<table id="multi-filter-select" class="display table table-striped table-hover" >
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Pemesan</th>
							<th>Ruangan</th>
							<th>Tanggal</th>
							<th>Jam Mulai</th>
							<th>Jam Selesai</th>
							<th>Jumlah Kursi</th>
							<th>Nomor WA</th>
							<th>Email</th>
							<th>Status</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						
						if ($result->num_rows > 0) {
							// Menampilkan data dalam tabel
							$no = 1;
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $no . "</td>";
								echo "<td>" . $row['nama_pemesan'] . "</td>";
								echo "<td>" . $row['nama'] . "</td>";
								echo "<td>" . $row['tanggal_pemesanan'] . "</td>";
								echo "<td>" . $row['jam_mulai'] . "</td>";
								echo "<td>" . $row['jam_selesai'] . "</td>";
								echo "<td>" . $row['jumlah_kursi'] . "</td>";
								echo "<td>" . $row['no_wa'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								echo "<td>" . $row['status'] . "</td>";
								echo "<td>" . $row['keterangan'] . "</td>";
								echo "</tr>";
								$no++;
							};
						};

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

                        <script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 10,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});
		});
	</script>
</script>
