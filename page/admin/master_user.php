<?php 

include("../../config/connect.php");

// Query SQL
$selectRuangan = "SELECT * from users";
$result2 = $conn->query($selectRuangan);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Master User</div>
            </div>
            <div class="card-body">
                    <div class="row">
					<input type="hidden" id="idUser" value="" readonly>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama User</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                        </div>
                    </div>
                    <div class="row">
					<input type="hidden" id="idUser" value="" readonly>
                        <div class="form-group col-md-6">
                            <label for="uername">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
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
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
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
                                echo "<td>" . $row["username"] . "</td>";
								echo "<td>" . $row["email"] . "</td>";
								echo "<td>" . $row["level"] . "</td>";
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
        var nama = $("#nama").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
        var level = $("#level").val();

        if (nama == "" || username == "" || password == "" || email == "" || level == "") {
            alert("Data tidak boleh kosong")
        }else{
            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "../process/input_user.php",
                method: "POST",
                data: {
                    nama: nama,
                    username: username,
                    password: password,
                    email: email,
                    level: level
                },
                success: function(response) {
                    // Tampilkan pesan sukses atau kesalahan
                    if (response === "success") {
                        $.ajax({
                            url: "master_user.php",
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
    var username = row.find('td:eq(2)').text();
    var email = row.find('td:eq(3)').text();
    var level = row.find('td:eq(4)').text();
	var dataId = this.getAttribute('data-id');
	console.log(dataId)

	document.getElementById("nama").value = nama
	document.getElementById("username").value = username
	document.getElementById("email").value = email
    document.getElementById("level").value = level
	document.getElementById("idUser").value = dataId
	// console.log(document.getElementById("optionButton").innerHTML)
	document.getElementById("optionButton").innerHTML = "<button class='btn btn-warning' name='update' id='update'>Update</button>"
	console.log(document.getElementById("idRuangan").value)
});

$(document).on('click', '#update', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    // Ambil data form	
    var nama = $("#nama").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var email = $("#email").val();
    var level = $("#level").val();
    var idUser = $("#idUser").val();

    // Kirim data ke server menggunakan AJAX
    $.ajax({
        url: "../process/edit_user.php",
        method: "POST",
        data: {
            nama: nama,
            username: username,
            password: password,
            email: email,
            level: level,
            idUser: idUser
        },
        success: function(response) {
            // Tampilkan pesan sukses atau kesalahan
            if (response === "success") {
                $.ajax({
                    url: "master_user.php",
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
    var idUser = $(this).data('id');
    console.log("OK")

    // Kirim data ke server menggunakan AJAX
    // var confirmDelete = confirm('Apakah Anda yakin ingin Menonaktifkan?');
    // if (confirmDelete) {
        $.ajax({
            url: "../process/delete_user.php",
            method: "POST",
            data: {
                idUser: idUser
            },
            success: function(response) {
                // Tampilkan pesan sukses atau kesalahan
                if (response === "success") {
                    $.ajax({
                        url: "master_user.php",
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
    var idUser = $(this).data('id');

    // Kirim data ke server menggunakan AJAX
    // var confirmDelete = confirm('Apakah Anda yakin ingin Mengaktifkan?');
    //if (confirmDelete) {
        $.ajax({
            url: "../process/active_user.php",
            method: "POST",
            data: {
                idUser: idUser
            },
            success: function(response) {
                // Tampilkan pesan sukses atau kesalahan
                if (response === "success") {
                    $.ajax({
                        url: "master_user.php",
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
