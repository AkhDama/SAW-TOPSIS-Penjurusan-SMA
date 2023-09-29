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
		          $tampilpeserta = mysqli_query($mysqli, "SELECT Email, Password, NISN, Nama, Nama_Jurusan, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah, Nilai_UN, Nilai_Akhir FROM peserta p join jurusan j on p.Id_Jurusan = j.Id_Jurusan where No_Pendaftaran = '$session_user'");
		          $peserta = mysqli_fetch_assoc($tampilpeserta);
		        ?>

				<!-- Features Item -->
				
				<div class="col-md-4">
                <div class="card">
                  <div class="card-header">Foto</div>
                  <form>
                    <div class="card-body"></div>
                  </form>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Ubah Data</div>
                  <form action="edit_user_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="no_daftar" value="<?php echo $session_user; ?>">
                        <label for="company">Email</label>
                        <input class="form-control" id="company" type="email" value="<?php echo $peserta['Email']; ?>" name="email">
                      </div>
                      <div class="form-group">
                        <label for="company">Password</label>
                        <input class="form-control" id="company" type="Password" value="<?php echo $peserta['Password']; ?>" name="pass">
                      </div>
                      <div class="form-group">
                        <label for="company">NISN</label>
                        <input class="form-control" id="company" type="number" value="<?php echo $peserta['NISN']; ?>" name="nisn">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jurusan Yang Dipilih</label>
                          <select class="form-control" id="select1" name="jurusan">
                            <?php 
                              $tampiljurusan = mysqli_query($mysqli,"SELECT * from jurusan");
                              while($jurusan = mysqli_fetch_array($tampiljurusan))
                              {
                            if($jurusan['Id_Jurusan'] == $peserta['Id_Jurusan'])
                              {
                            ?>
                            <option value="<?php echo $jurusan['Id_Jurusan']; ?>" selected=""><?php echo $jurusan['Nama_Jurusan']; ?></option>
                            <?php  
                              }
                              else
                              {
                            ?>
                            <option value="<?php echo $jurusan['Id_Jurusan']; ?>"><?php echo $jurusan['Nama_Jurusan']; ?></option>
                            <?php  
                                }
                              }
                            ?>
                          </select>
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Nama</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $peserta['Nama']; ?>" name="nama">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jenis Kelamin</label>
                          <?php 
                            if ($peserta['Jenis_Kelamin']=='L') {
                          ?>
                          <select class="form-control" id="select1" name="kelamin">
                            <option value="L" selected="">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                          <?php
                          }
                          else
                          { 
                          ?>
                          <select class="form-control" id="select1" name="kelamin">
                            <option value="P" selected="">Perempuan</option>
                            <option value="L">Laki-Laki</option>
                          </select>
                          <?php 
                          }
                          ?>
                      </div>
                      <div class="form-group">
                        <label for="company">Tanggal Lahir</label>
                        <input class="form-control" id="date-input" type="date" name="date-input" value="<?php echo $peserta['Tanggal_Lahir']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="company">Alamat</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $peserta['Alamat']; ?>" name="alamat">
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Asal Sekolah</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $peserta['Asal_Sekolah']; ?>" name="smp">
                      </div>
                      <div class="form-group">
                        <label for="company">Nilai Rata UN</label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['Nilai_UN']; ?>" name="un">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../user">Batal</a>
                      </div>
                      </div>
                    </div>
                  </form>
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