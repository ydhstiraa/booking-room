<?php
include("../../config/connect.php");
session_start();
$userIdLogin = $_SESSION['userIdLogin'];

// Query SQL
$selectDataTable = "SELECT pemesanan.*, ruangan.nama, validasi.kode_tracking FROM pemesanan left join validasi on pemesanan.id = validasi.pemesanan_id LEFT JOIN ruangan ON pemesanan.ruangan_id = ruangan.id where pemesanan.status = 'Pending' ORDER BY timestamp DESC";
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
              <th>Kode Booking</th>
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
              <th>Approval</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            if ($result->num_rows > 0) {
                // Menampilkan data dalam tabel
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='javascript:void(0);' class='detail-button' data-id='" . $row['id'] . "'>" . $no . "</a></td>";
                    echo "<td>" . $row['kode_tracking'] . "</td>";
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
                    echo "<td>";

                    // if ($row['status'] == "Approved") {
                    //     echo "<a href='javascript:void(0);' class='cancel-button btn btn-danger btn-round btn-xs' data-id='" . $row['id'] . "'>Cancel</a>";
                    // }
                    // if ($row['status'] == "Pending" || $row['status'] == "Cancel") {
                    //     echo "<a href='javascript:void(0);' class='approve-button btn btn-warning btn-round btn-xs' data-id='" . $row['id'] . "'>Approve</a>";
                    // }
                    
                    echo "<a href='javascript:void(0);' class='approve-button btn btn-warning btn-round btn-xs' data-id='" . $row['id'] . "'>Approve</a>";
                    echo "<a href='javascript:void(0);' class='cancel-button btn btn-danger btn-round btn-xs' data-id='" . $row['id'] . "'>Cancel</a>";


                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
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
	<script>
$(document).ready(function() {
  $('.approve-button').click(function(e) {
    e.preventDefault();

    // Mendapatkan nilai ID dari data attribute
    var id = $(this).data('id');
	  var user_id = document.getElementById('user_id').value

    var row = $(this).closest('tr');
    var nama = row.find('td:eq(2)').text();
    var email = row.find('td:eq(9)').text();
    var kode = row.find('td:eq(1)').text();
    
    // Mengirim permintaan AJAX ke server
    $.ajax({
      url: '../process/approve_booking.php',
      method: 'POST',
      data: { 
		id: id,
		user_id : user_id 
		},
      success: function(response) {
        // Memperbarui status pada halaman secara dinamis
        if (response === 'success') {
          // Status berhasil diubah
          alert('Status berhasil diubah menjadi Approved.');
		  $.ajax({
				url: "booking_portal.php",
				type: 'GET',
				success: function(response) {
          $.ajax({
            url: '../../config/mail.php',
            method: 'POST',
            data: { 
                type : 'Approve',
                nama,
                email,
                kode
                },
            success: function(response) {
              console.log("Sent")
            },
            error: function(xhr, status, error) {
                // Kesalahan pada permintaan AJAX
                alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
            }
            });
					$('#mainContent').html(response);
          
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
          // Lakukan perubahan pada tampilan sesuai kebutuhan (misalnya, ubah warna tombol)
        } else {
          // Terjadi kesalahan saat mengubah status
          alert('Terjadi kesalahan saat mengubah status: ' + response);
        }
      },
      error: function(xhr, status, error) {
        // Kesalahan pada permintaan AJAX
        alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
      }
    });
  });
});

$(document).ready(function() {
  $('.cancel-button').click(function(e) {
    e.preventDefault();

    // Mendapatkan nilai ID dari data attribute
    var id = $(this).data('id');
	  var user_id = document.getElementById('user_id').value

    var row = $(this).closest('tr');
    var nama = row.find('td:eq(2)').text();
    var email = row.find('td:eq(9)').text();
    var kode = row.find('td:eq(1)').text();
	
    // Mengirim permintaan AJAX ke server
    $.ajax({
      url: '../process/cancel_booking.php',
      method: 'POST',
      data: { id: id,
		user_id : user_id  
	},
      success: function(response) {
        // Memperbarui status pada halaman secara dinamis
        if (response === 'success') {
          // Status berhasil diubah
          alert('Status berhasil diubah menjadi Cancel.');
		  $.ajax({
				url: "booking_portal.php",
				type: 'GET',
				success: function(response) {
          $.ajax({
            url: '../../config/mail.php',
            method: 'POST',
            data: { 
                type : 'Cancel',
                nama,
                email,
                kode
                },
            success: function(response) {
              console.log("Sent!!")
            },
            error: function(xhr, status, error) {
                // Kesalahan pada permintaan AJAX
                alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
            }
            });
					$('#mainContent').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
          // Lakukan perubahan pada tampilan sesuai kebutuhan (misalnya, ubah warna tombol)
        } else {
          // Terjadi kesalahan saat mengubah status
          alert('Terjadi kesalahan saat mengubah status: ' + response);
        }
      },
      error: function(xhr, status, error) {
        // Kesalahan pada permintaan AJAX
        alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
      }
    });
  });
});

$(document).ready(function() {
  $('.detail-button').click(function(e) {
    e.preventDefault();

    // Mendapatkan nilai ID dari data attribute
    var id = $(this).data('id');
	
    // Mengirim permintaan AJAX ke server
    $.ajax({
      url: 'booking_detail.php',
      method: 'POST',
      data: { id: id,
	},
      success: function(response) {
        $('#mainContent').html(response);
      },
      error: function(xhr, status, error) {
        // Kesalahan pada permintaan AJAX
        alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
      }
    });
  });
});
</script>
