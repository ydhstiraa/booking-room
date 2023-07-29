<?php 
include("../../config/connect.php");

$jumlah_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jumlah_data FROM users where level = 'user'"));
$jumlah_pemesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jumlah_data FROM pemesanan"));
$jumlah_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jumlah_data FROM pemesanan where status='Pending'"));
$jumlah_confirm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jumlah_data FROM pemesanan where status='Confirmed'"));
$pemesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS Pending, SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) AS Approved, SUM(CASE WHEN status = 'Confirmed' THEN 1 ELSE 0 END) AS Confirmed, SUM(CASE WHEN status = 'Finished' THEN 1 ELSE 0 END) AS Finished, SUM(CASE WHEN status = 'Cancel' THEN 1 ELSE 0 END) AS Canceled FROM pemesanan"));
$top5Booking = mysqli_query($conn, "select pemesanan.id, pemesanan.tanggal_pemesanan, pemesanan.nama_pemesan, pemesanan.jam_mulai, pemesanan.jam_selesai, ruangan.nama, pemesanan.keterangan, pemesanan.status from pemesanan left join ruangan on pemesanan.ruangan_id = ruangan.id where pemesanan.status = 'Confirmed' ORDER BY pemesanan.tanggal_pemesanan asc LIMIT 5");

?>

<!-- tempat menampung nilai dari select mysql untuk pie chart -->
<input type="hidden" id="approved" value="<?= $pemesanan['Approved']?>">
<input type="hidden" id="pending" value="<?= $pemesanan['Pending']?>">
<input type="hidden" id="confirmed" value="<?= $pemesanan['Confirmed']?>">
<input type="hidden" id="finished" value="<?= $pemesanan['Finished']?>">
<input type="hidden" id="cancel" value="<?= $pemesanan['Canceled']?>">


<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Resepsionist</p>
                                <h4 class="card-title"><?= $jumlah_user['jumlah_data']?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="far fa-newspaper"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Booking</p>
                                <h4 class="card-title"><?= $jumlah_pemesanan['jumlah_data']?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Need Approval</p>
                                <h4 class="card-title"><?= $jumlah_pending['jumlah_data']?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Upcoming Event</p>
                                <h4 class="card-title"><?= $jumlah_confirm['jumlah_data']?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Booking Status</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?= $jumlah_confirm['jumlah_data']?> Upcoming Event</div>
                </div>
                <div class="card-body">
                    <ol class="activity-feed">
                        <?php
                            $warna = ['success', 'info', 'warning', 'danger', 'primary'];
                            $arr = 0;
                            while ($data = $top5Booking->fetch_assoc()) {
                        ?>
                            <li class="feed-item feed-item-<?= $warna[$arr]?>">
                            <time class="date"><?= $data['tanggal_pemesanan']?> (<?= $data['jam_mulai']?> - <?= $data['jam_selesai']?>)</time>
                            <span class="text"><?= $data['nama_pemesan']?> ordered a <?= $data['nama']?> for <a href='javascript:void(0);' class='detail-button' data-id='<?= $data['id']?>'>"<?= $data['keterangan']?>"</a></span>
                        </li>
                        <?php
                            $arr++;
                            };
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    pieChart = document.getElementById('pieChart').getContext('2d')
    approved = document.getElementById('approved').value
    pending = document.getElementById('pending').value
    confirmed = document.getElementById('confirmed').value
    finished = document.getElementById('finished').value
    cancel = document.getElementById('cancel').value

    var myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [approved, pending, confirmed, finished, cancel],
                backgroundColor :["#8CFF98","#AAD922","#6F7C12","#483519","#000000"],
                borderWidth: 0
            }],
            labels: ['Approved', 'Pending', 'Confirmed', 'Finished', 'Cancel'] 
        },
        options : {
            responsive: true, 
            maintainAspectRatio: false,
            legend: {
                position : 'bottom',
                labels : {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle : true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })

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