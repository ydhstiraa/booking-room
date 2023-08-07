<?php 

include("../../config/connect.php");

// Query SQL
$selectRuangan = "SELECT * from ruangan";
$result2 = $conn->query($selectRuangan);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Master Ruangan</div>
            </div>
            <div class="card-body">
                    <div class="row">
					<input type="hidden" id="idRuangan" value="" readonly>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Ruangan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Ruangan">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Kapasitas">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" rows="5" name="deskripsi"></textarea>
                    </div>
                    <div id="optionButton">
						
						<button class="btn btn-success" name="submit" id="submit">Submit</button>
					</div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Ruangan</th>
                            <th>Kapasitas</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
						if ($result2->num_rows > 0) {
							// Menampilkan data dalam tabel
							$no = 1;
							while ($row = $result2->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $no . "</td>";
								echo "<td>" . $row["nama"] . "</td>";
								echo "<td>" . $row["kapasitas"] . "</td>";
								echo "<td>" . $row["deskripsi"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
								echo "<td>";
                                if ($row["status"] == "Active") {
                                    echo "<a href='javascript:void(0);' class='edit-button btn btn-warning btn-round btn-sm far fa-edit' data-id='" . $row['id'] . "'></a> ";
                                }
                                if ($row["status"] == "Active") {
                                    echo "<a href='javascript:void(0);' class='delete-button btn btn-danger btn-round btn-sm far ' data-id='" . $row['id'] . "'>Inactive</a>";
                                }else{
                                    echo "<a href='javascript:void(0);' class='active-button btn btn-success btn-round btn-sm far' data-id='" . $row['id'] . "'>Active</a>";
                                }
                                echo "</td>";
								echo "</tr>";
								$no++;
							}
						}
						?>
					</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
		retrieve: true,
        pageLength: 10,
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $(
                        '<select class="form-control"><option value=""></option></select>'
                    )
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
});

$(document).ready(function() {
    // Tangkap event submit form
    $("#submit").click(function(e) {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data form
        var namaRuangan = $("#nama").val();
        var kapasitas = $("#kapasitas").val();
        var deskripsi = $("#deskripsi").val();

        if (namaRuangan == "" || kapasitas == "" || deskripsi == "") {
            alert("Data tidak boleh kosong")
        }else{
            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "../process/input_ruangan.php",
                method: "POST",
                data: {
                    nama: namaRuangan,
                    kapasitas: kapasitas,
                    deskripsi: deskripsi
                },
                success: function(response) {
                    // Tampilkan pesan sukses atau kesalahan
                    if (response === "success") {
                        $.ajax({
                            url: "master_ruangan.php",
                            type: 'GET',
                            success: function(response) {
                                $('#mainContent').empty()
                                $('#mainContent').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    } else {
                        alert("Terjadi kesalahan: " + response);
                    }
                },
                error: function(xhr, status, error) {
                    alert("Terjadi kesalahan pada permintaan AJAX: " + error);
                }
            });
        }
        
        
    });
});

$(document).on('click', '.edit-button', function(e) {
    e.preventDefault();

    // Dapatkan baris tabel terkait dengan tombol "Edit"
    var row = $(this).closest('tr');

    // Ambil data dari tiap kolom pada baris tabel
    var no = row.find('td:eq(0)').text();
    var nama = row.find('td:eq(1)').text();
    var kapasitas = row.find('td:eq(2)').text();
    var deskripsi = row.find('td:eq(3)').text();
	var dataId = this.getAttribute('data-id');
	console.log(dataId)

	document.getElementById("nama").value = nama
	document.getElementById("kapasitas").value = kapasitas
	document.getElementById("deskripsi").value = deskripsi
	document.getElementById("idRuangan").value = dataId
	// console.log(document.getElementById("optionButton").innerHTML)
	document.getElementById("optionButton").innerHTML = "<button class='btn btn-warning' name='update' id='update'>Update</button>"
	console.log(document.getElementById("idRuangan").value)
});

$(document).on('click', '#update', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    // Ambil data form	
    var namaRuangan = $("#nama").val();
    var kapasitas = $("#kapasitas").val();
    var deskripsi = $("#deskripsi").val();
    var idRuangan = $("#idRuangan").val();

    // Kirim data ke server menggunakan AJAX
    $.ajax({
        url: "../process/edit_ruangan.php",
        method: "POST",
        data: {
            nama: namaRuangan,
            kapasitas: kapasitas,
            deskripsi: deskripsi,
            idRuangan: idRuangan
        },
        success: function(response) {
            // Tampilkan pesan sukses atau kesalahan
            if (response === "success") {
                $.ajax({
                    url: "master_ruangan.php",
                    type: 'GET',
                    success: function(response) {
                        $('#mainContent').empty();
                        $('#mainContent').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            } else {
                alert("Terjadi kesalahan: " + response);
            }
        },
        error: function(xhr, status, error) {
            alert("Terjadi kesalahan pada permintaan AJAX: " + error);
        }
    });
});

$(document).on('click', '.delete-button', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    // Ambil data form	
    var idRuangan = $(this).data('id');
    console.log("OK")

    // Kirim data ke server menggunakan AJAX
    // var confirmDelete = confirm('Apakah Anda yakin ingin Menonaktifkan?');
    // if (confirmDelete) {
        $.ajax({
            url: "../process/delete_ruangan.php",
            method: "POST",
            data: {
                idRuangan: idRuangan
            },
            success: function(response) {
                // Tampilkan pesan sukses atau kesalahan
                if (response === "success") {
                    $.ajax({
                        url: "master_ruangan.php",
                        type: 'GET',
                        success: function(response) {
                            $('#mainContent').empty()
                            $('#mainContent').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                } else {
                    alert("Terjadi kesalahan: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan pada permintaan AJAX: " + error);
            }
        });
    //}
});

$(document).on('click', '.active-button', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    // Ambil data form	
    var idRuangan = $(this).data('id');

    // Kirim data ke server menggunakan AJAX
    // var confirmDelete = confirm('Apakah Anda yakin ingin Mengaktifkan?');
    //if (confirmDelete) {
        $.ajax({
            url: "../process/active_ruangan.php",
            method: "POST",
            data: {
                idRuangan: idRuangan
            },
            success: function(response) {
                // Tampilkan pesan sukses atau kesalahan
                if (response === "success") {
                    $.ajax({
                        url: "master_ruangan.php",
                        type: 'GET',
                        success: function(response) {
                            $('#mainContent').empty()
                            $('#mainContent').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                } else {
                    alert("Terjadi kesalahan: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan pada permintaan AJAX: " + error);
            }
        });
    // }
});
</script>
