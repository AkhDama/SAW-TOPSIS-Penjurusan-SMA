<?php 
session_start();
  include "../lib/koneksi.php";
  $session_user = $_SESSION['user']; 
  if(isset($_SESSION['user']))
  {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SPK-Penjurusan SMA IDAMAN</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>
	</header>

	<!-- Features -->

	<div class="popular">
		<div class="section_background parallax-window" data-parallax="scroll" data-image-src="images/courses_background.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row courses_row justify-content-center">
				
				<?php  
		          $tampilpeserta = mysqli_query($mysqli, "SELECT Email, NISN, Nama, Nama_Jurusan, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah, Nilai_UN, Nilai_Akhir, Kuota, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan = j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.No_Pendaftaran = '$session_user'");
		          $peserta = mysqli_fetch_assoc($tampilpeserta);

		          $tampilranking = mysqli_query($mysqli, "SELECT DISTINCT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, Ranking FROM (SELECT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, @peserta:=CASE WHEN @jurusan <> Id_Jurusan THEN 1 ELSE @peserta+1 END AS Ranking, @jurusan:=Id_Jurusan AS Jurusan FROM(SELECT @peserta:= 0) AS P, (SELECT @Jurusan:= 0) AS J, (SELECT * FROM peserta GROUP BY Id_Jurusan, Nilai_Akhir ORDER BY Id_Jurusan, Nilai_Akhir DESC) AS temp) AS temp2 where No_Pendaftaran = '$session_user'");
		          $ranking = mysqli_fetch_assoc($tampilranking);

              $i = 1;
              $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
              while($kriteria = mysqli_fetch_assoc($tampilkriteria)){
                $C[$i] = $kriteria['Nama_Kriteria'];
                $i++;
              }
		        ?>

				<!-- Features Item -->
				<div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data Peserta</div>
                  <form>
                    <div class="card-body">
                      <div class="row justify-content-center">
                        <div class="col-sm-6">
                          <div class="callout callout-info">
                            <small class="text-muted">Nilai Akhir</small>
                            <br>
                            <strong class="h4">
                              <?php 
                                if ($peserta['Nilai_Akhir'] == NULL) {
                                  echo "0";
                                } else {
                                  echo $peserta['Nilai_Akhir'];
                                }
                              ?>
                            </strong>
                            <div class="chart-wrapper">
                              <canvas id="sparkline-chart-1" width="100" height="30"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="callout callout-danger">
                            <small class="text-muted">Ranking</small>
                            <br>
                            <strong class="h4">
                              <?php 
                                echo $ranking['Ranking'];
                              ?>
                            </strong>
                            <div class="chart-wrapper">
                              <canvas id="sparkline-chart-1" width="100" height="30"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                        	  <a href="edit_user.php" class="btn btn-success btn-block">
		                        <i class="fa fa-pencil"> Edit</i>
		                      </a>
		                      <a href="cetak_user.php" target="_blank" class="btn btn-info btn-block">
		                        <i class="fa fa-print"> Cetak</i>
		                      </a>
                              <a href="home.php" class="btn btn-warning btn-block">
		                        <i class="fa fa-pencil"> Quiz Peminatan</i>
		                      </a>
                        	  <a href="../logout_user.php" class="btn btn-danger btn-block">
		                        <i class="fa fa-lock"> Logout</i>
		                      </a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <br>
                <?php 
                  if ($ranking['Ranking'] <= $peserta['Kuota']) {
                ?>
                <div class="card text-white bg-success">
                  <div class="card-body">
                    <div class="text-value"><center>PERNYATAAN</center></div>
                    <div><center>Anda LULUS di jurusan <?php echo $peserta['Nama_Jurusan']; ?></center></div>
                  </div>
                </div>
                <?php
                  }else{
                ?>
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <div class="text-value"><center>PERNYATAAN</center></div>
                    <div><center>Anda Belum Direkomendasikan Untuk Memilih Jurusan <?php echo $peserta['Nama_Jurusan']; ?></center></div>
                  </div>
                </div>
                <?php  
                  }
                ?>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Detail Data Peserta</div>
                  <div class="card-body">
                    <div class="bd-example">
                      <dl class="row">
                        <dt class="col-sm-3">No Pendaftaran</dt>
                        <dd class="col-sm-9"><?php echo $session_user; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Email']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">NISN</dt>
                        <dd class="col-sm-9"><?php echo $peserta['NISN']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Jurusan Pilihan</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Nama_Jurusan']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Kuota Jurusan Pilihan</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Kuota']; ?></dd>
                      </dl>
                      <hr class="mt-0">
                      <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Nama']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Jenis Kelamin</dt>
                        <dd class="col-sm-9">
                          <?php
                            if ($peserta['Jenis_Kelamin'] == 'L') {
                              echo "Laki-Laki";
                            }
                            else{
                              echo "Perempuan";
                            }
                          ?>
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Tanggal Lahir</dt>
                        <dd class="col-sm-9">
                          <?php 
                            $originalDate = $peserta['Tanggal_Lahir'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo $newDate;
                          ?>
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Alamat</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Alamat']; ?></dd>
                      </dl>
                      <hr class="mt-0">
                      <dl class="row">
                        <dt class="col-sm-3">Asal Sekolah</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Asal_Sekolah']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai Rata UN</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Nilai_UN']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[2]; ?></dt>
                        <dd class="col-sm-9"><?php echo $peserta['C2']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[3]; ?></dt>
                        <dd class="col-sm-9"><?php echo $peserta['C3']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[4]; ?></dt>
                        <dd class="col-sm-9"><?php echo $peserta['C4']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[5]; ?></dt>
                        <dd class="col-sm-9"><?php echo $peserta['C5']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[6]; ?></dt>
                        <dd class="col-sm-9"><?php echo $peserta['C6']; ?></dd>
                      </dl>
                    </div>
                  </div>
                </div>
              </div>

			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="app-footer">
		<div class="container">
			<div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<div style='left: -1988px; position: absolute; top: -1999px;'>
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						</div>
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SMA IDAMAN <i class="fa fa-heart-o" aria-hidden="true"></i>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a>Desa Kota Negara, Kec. Madang Suku II, Kab. Ogan Komering Ulu Timur Prov. Sumatera Selatan</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../styles/bootstrap4/popper.js"></script>
<script src="../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../plugins/greensock/TweenMax.min.js"></script>
<script src="../plugins/greensock/TimelineMax.min.js"></script>
<script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../plugins/greensock/animation.gsap.min.js"></script>
<script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../plugins/easing/easing.js"></script>
<script src="../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
<?php 
	}
	else{
		header("location: ../login/");
	}
 ?>