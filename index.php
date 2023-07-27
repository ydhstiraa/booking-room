<?php

include("./config/connect.php");

$sql = "SELECT id, nama FROM alat where status = 'Active'";
$alat = $conn->query($sql);

$sql2 = "SELECT pemesanan.*, ruangan.nama as nama_ruangan from pemesanan left join ruangan on pemesanan.ruangan_id = ruangan.id where pemesanan.status = 'Confirmed'";
$event = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Garena</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/my-styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Garena Gamming & Community Hub</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item my-auto" ><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item my-auto"><a class="nav-link" href="#services">Event</a></li>
                        <li class="nav-item my-auto"><a class="nav-link" href="#portfolio">Galery</a></li>
                        <li class="nav-item my-auto"><a class="nav-link" href="#contact">Booking</a></li>
                        <li class="nav-item my-auto"><a class="nav-link" href="#tracking">Tracking</a></li>
                        <li class="nav-item my-auto"><a class="btn btn-danger btn-md" href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-white font-weight-bold">The home for all gaming communities in Solo City.</h1>
                        <hr class="divider danger" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Your favorite place for gathering, collaborating, and creating together for gaming events and eSports tournaments.</p>
                        <a class="btn btn-danger btn-xl" href="#contact">Book now</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-danger" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">
                            Garena resmi membuka  Garena Gaming & Community Hub rumah bagi seluruh komunitas gaming Kota Solo untuk berkumpul, berkolaborasi, dan berkarya bersama dalam membuat acara gaming maupun menjalankan turnamen esports.
                        </p>
                        <p class="text-white-75 mb-4">
                            Garena Gaming & Community Hub yang hadir di Solo Technopark seluas 8 hektar ini terbuka untuk umum dan gratis.
                        </p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Upcoming Event</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <table class="table">
                        <tr class="text-center">
                            <th>Keterangan</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                        </tr>
                        <?php 
                        
                        while ($row2 = $event->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row2['keterangan']."</td>";
                            echo "<td>".$row2['nama_ruangan']."</td>";
                            echo "<td>".$row2['tanggal_pemesanan']."</td>";
                            echo "<td>".$row2['jam_mulai']."</td>";
                            echo "</tr>";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/1.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/4.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/5.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/5.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/6.jpg" title="Project Name">
                            <img class="img-fluid" src="assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                    <form id="contactForm" action="./page/process/input_booking.php" method="POST">
    <!-- Nama Pemesan input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="nama_pemesan" name="nama_pemesan" type="text" placeholder="Masukkan nama lengkap Anda..." data-sb-validations="required" />
        <label for="nama_pemesan">Nama Pemesan</label>
        <div class="invalid-feedback" data-sb-feedback="nama_pemesan:required">Nama Pemesan wajib diisi.</div>
    </div>
    <div class="form-floating mb-3">
        <select class="form-control" name="ruangan" id="ruangan" data-sb-validations="required" >
            <option value="1">Ruang Mabar</option>
            <option value="2">Ruang Nobar</option>
        </select>
        <label for="ruangan">Ruangan</label>
        <div class="invalid-feedback" data-sb-feedback="ruangan:required">Ruangan yang akan di booking wajib diisi.</div>
    </div>
    <!-- Tanggal Pemesanan input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" type="date" data-sb-validations="required" />
        <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
        <div class="invalid-feedback" data-sb-feedback="tanggal_pemesanan:required">Tanggal Pemesanan wajib diisi.</div>
    </div>
    <!-- Jam Mulai input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="jam_mulai" name="jam_mulai" type="time" data-sb-validations="required" />
        <label for="jam_mulai">Jam Mulai</label>
        <div class="invalid-feedback" data-sb-feedback="jam_mulai:required">Jam Mulai wajib diisi.</div>
    </div>
    <!-- Jam Selesai input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="jam_selesai" name="jam_selesai" type="time" data-sb-validations="required" />
        <label for="jam_selesai">Jam Selesai</label>
        <div class="invalid-feedback" data-sb-feedback="jam_selesai:required">Jam Selesai wajib diisi.</div>
    </div>
    <!-- Jumlah Kursi input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="jumlah_kursi" name="jumlah_kursi" type="number" placeholder="Masukkan jumlah kursi..." data-sb-validations="required" />
        <label for="jumlah_kursi">Jumlah Kursi</label>
        <div class="invalid-feedback" data-sb-feedback="jumlah_kursi:required">Jumlah Kursi wajib diisi.</div>
    </div>
    <div class="form-floating mb-3">
    <?php 
    
    while ($row = $alat->fetch_assoc()) {
        $id = $row['id'];
        $nama = $row['nama'];

        echo "<input type='checkbox' name='alat[]' id='alat' value='$id'> $nama<br>";
    }
    
    ?>
    </div>
    <!-- Nomor WhatsApp input -->
    <div class="form-floating mb-3">
        <input class="form-control" id="no_wa" name="no_wa" type="tel" placeholder="Masukkan nomor WhatsApp Anda..." data-sb-validations="required" />
        <label for="no_wa">Nomor WhatsApp</label>
        <div class="invalid-feedback" data-sb-feedback="no_wa:required">Nomor WhatsApp wajib diisi.</div>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" id="email" name="email" type="email" placeholder="Masukkan Email Anda..." data-sb-validations="required" />
        <label for="email">Email</label>
        <div class="invalid-feedback" data-sb-feedback="no_wa:required">Email wajib diisi.</div>
    </div>
    <!-- Keterangan input -->
    <div class="form-floating mb-3">
        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keperluan..." style="height: 10rem" data-sb-validations="required"></textarea>
        <label for="keterangan">Keperluan</label>
        <div class="invalid-feedback" data-sb-feedback="keterangan:required">Keperluan wajib diisi.</div>
    </div>

                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <!-- <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div> -->
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <!-- <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div> -->
                            <!-- Submit Button-->
                            <div class="d-grid"><input class="btn btn-danger btn-xl" type="submit" name="submit" id="submit" value="Submit"></div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Tracking -->
        <section class="page-section bg-danger" id="tracking">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Cek / Tracking kode booking</h2>
                        <hr class="divider divider-light" />
                        <div class="form-floating mb-3">
                            <input class="form-control" id="kode_booking" name="kode_booking" type="text" placeholder="Masukkan nama lengkap Anda..." data-sb-validations="required" />
                            <label for="kode_booking">Kode Booking</label>
                            <div class="invalid-feedback" data-sb-feedback="kode_booking:required">Kode Booking wajib diisi.</div>
                        </div>
                        <div class="d-grid"><input class="btn btn-success btn-xl cek-tracking" value="Cek !"></div>
                    </div>
                    <br>
                    <br>
                    <div class="col-lg-8 text-center" id="data_tracking">

                    </div>
                </div>
            </div>
        </section>


        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="assets/js/core/jquery.3.2.1.min.js"></script>
        <script>
            $(document).ready(function() {
            $('.cek-tracking').click(function(e) {
                e.preventDefault();

                    var kode_tracking = $("#kode_booking").val();

                // Mengirim permintaan AJAX ke server
                $.ajax({
                url: 'cek_booking.php',
                method: 'POST',
                data: { kode_tracking : kode_tracking
                },
                success: function(response) {
                    $('#data_tracking').html(response);
                },
                error: function(xhr, status, error) {
                    // Kesalahan pada permintaan AJAX
                    alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
                }
                });
            });
            });
        </script>
    </body>
</html>
