<?php
include("../../config/connect.php");
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: ../../login.php');
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$userIdLogin = $_SESSION['userIdLogin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Garena Booking Apps</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/azzara.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="purple">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="index.html" class="logo">
					<img src="../../assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
								<div class="">
									
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="../../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4><?= $username ?></h4>
											<h4><?= $userIdLogin ?></h4>
											<p class="text-muted"><?= $email ?></p><a href="../process/logout.php" class="btn btn-rounded btn-danger btn-sm">Log Out</a>
										</div>
									</div>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav">
						<li class="nav-item active">
							<a href="dashboard.php" class="ajax-link">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Booking</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="booking_portal.php" class="ajax-link">
											<span class="sub-item">Booking Portal</span>
										</a>
									</li>
									<li>
										<a href="booking_incoming.php" class="ajax-link">
											<span class="sub-item">Incoming</span>
										</a>
									</li>
									<li>
										<a href="booking_history.php" class="ajax-link">
											<span class="sub-item">History</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="fas fa-pen-square"></i>
								<p>Master</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="master_user.php" class="ajax-link">
											<span class="sub-item">User</span>
										</a>
									</li>
									<li>
									<a href="master_ruangan.php" class="ajax-link">
											<span class="sub-item">Ruangan</span>
										</a>
									</li>
									<li>
										<a href="master_alat.php" class="ajax-link">
											<span class="sub-item">Alat</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#charts">
								<i class="far fa-chart-bar"></i>
								<p>Laporan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="laporan1.php" class="ajax-link">
											<span class="sub-item">Laporan 1</span>
										</a>
									</li>
									<li>
										<a href="charts/sparkline.html">
											<span class="sub-item">Sparkline</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
				<div class="mainContent" id="mainContent"></div>
				</div>
			</div>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Moment JS -->
	<script src="../../assets/js/plugin/moment/moment.min.js"></script>

	<!-- Chart JS -->
	<script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Bootstrap Toggle -->
	<script src="../../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Google Maps Plugin -->
	<script src="../../assets/js/plugin/gmaps/gmaps.js"></script>

	<!-- Sweet Alert -->
	<script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Azzara JS -->
	<script src="../../assets/js/ready.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
	
	<script>
	$(document).ready(function() {
		// pertama kali halaman dibuka, load dashboard.php
		$.ajax({
			url: 'dashboard.php',
			type: 'GET',
			success: function(response) {
				// Mengganti isi div dengan hasil respons PHP
				$('#mainContent').empty();
				$('#mainContent').html(response);
			},
			error: function(xhr, status, error) {
				console.log(error);
			}
		});

		//merubah div mainContent dengan menu yang dipilih
		// Menangani klik pada tautan dengan class "ajax-link"
		$('.ajax-link').click(function(e) {
			e.preventDefault(); // Mencegah tindakan default mengikuti tautan

			// Mendapatkan URL halaman PHP dari atribut href pada tautan
			var pageURL = $(this).attr('href');

			// Melakukan permintaan AJAX ke halaman PHP yang sesuai
			$.ajax({
				url: pageURL,
				type: 'GET',
				success: function(response) {
					// Mengganti isi div dengan hasil respons PHP
					$('#mainContent').empty();
					$('#mainContent').html(response);
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		});
		
	});
	</script>
	

</body>
</html>