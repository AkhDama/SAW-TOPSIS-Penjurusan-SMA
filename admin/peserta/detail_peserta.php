<?php 
session_start();
  include "../../lib/koneksi.php";
  $no_daftar=$_GET['No_Pendaftaran'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../peserta">Peserta</a></li>
          <li class="breadcrumb-item active">Detail Peserta</li>
        </ol>
        <?php  
          $tampilpeserta = mysqli_query($mysqli, "SELECT Email, NISN, Nama, Nama_Jurusan, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah, Nilai_UN, Nilai_Akhir, Kuota FROM peserta p join jurusan j on p.Id_Jurusan = j.Id_Jurusan where No_Pendaftaran = '$no_daftar'");
          $peserta = mysqli_fetch_assoc($tampilpeserta);

          $tampilranking = mysqli_query($mysqli, "SELECT DISTINCT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, Ranking FROM (SELECT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, @peserta:=CASE WHEN @jurusan <> Id_Jurusan THEN 1 ELSE @peserta+1 END AS Ranking, @jurusan:=Id_Jurusan AS Jurusan FROM(SELECT @peserta:= 0) AS P, (SELECT @Jurusan:= 0) AS J, (SELECT * FROM peserta GROUP BY Id_Jurusan, Nilai_Akhir ORDER BY Id_Jurusan, Nilai_Akhir DESC) AS temp) AS temp2 where No_Pendaftaran = '$no_daftar'");
          $ranking = mysqli_fetch_assoc($tampilranking);
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data Peserta</div>
                  <form>
                    <div class="card-body">
                      <div class="row">
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
                      </div>
                    </div>
                  </form>
                </div>
                <?php 
                  if ($ranking['Ranking'] <= $peserta['Kuota']) {
                ?>
                <div class="card text-white bg-success">
                  <div class="card-body">
                    <div class="text-value"><center>PERNYATAAN</center></div>
                    <div><center>Diterima di jurusan <?php echo $peserta['Nama_Jurusan']; ?></center></div>
                  </div>
                </div>
                <?php
                  }else{
                ?>
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <div class="text-value"><center>PERNYATAAN</center></div>
                    <div><center>Belum diterima di jurusan <?php echo $peserta['Nama_Jurusan']; ?></center></div>
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
                        <dd class="col-sm-9"><?php echo $no_daftar; ?></dd>
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
                        <dt class="col-sm-3">Nama Jurusan Yang Dipilih</dt>
                        <dd class="col-sm-9"><?php echo $peserta['Nama_Jurusan']; ?></dd>
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
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
          </div>
        </div>
      </main>
<?php
    include "../template/footer.php";
  }
  else
  {
    header("location: ../login/");
  } 
?>