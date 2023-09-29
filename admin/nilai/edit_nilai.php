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
          <li class="breadcrumb-item"><a href="../nilai">Nilai</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampilpeserta = mysqli_query($mysqli, "SELECT Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where n.No_Pendaftaran =  '$no_daftar'");
          $peserta = mysqli_fetch_assoc($tampilpeserta)
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data Peserta</div>
                    <div class="card-body">
                      <h2><?php echo $no_daftar; ?></h2>
                      <h2><?php echo $peserta['Nama']; ?></h2>
                    </div>
                </div>
              </div>
              <?php 
                $tampilC1 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 1");
                $C1 = mysqli_fetch_assoc($tampilC1);
                $tampilC2 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 2");
                $C2 = mysqli_fetch_assoc($tampilC2);
                $tampilC3 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 3");
                $C3 = mysqli_fetch_assoc($tampilC3);
                $tampilC4 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 4");
                $C4 = mysqli_fetch_assoc($tampilC4);
                $tampilC5 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 5");
                $C5 = mysqli_fetch_assoc($tampilC5);
                $tampilC6 = mysqli_query($mysqli, "SELECT * FROM kriteria where Id_Kriteria = 6");
                $C6 = mysqli_fetch_assoc($tampilC6);
              ?>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Ubah Data Nilai Peserta</div>
                  <form action="edit_nilai_action.php" method="post">
                    <div class="card-body">
                      <input type="hidden" name="no_daftar" value="<?php echo $no_daftar; ?>">
                      <div class="form-group">
                        <label for="company"><?php echo $C1['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C1']; ?>" name="C1">
                      </div>
                      <div class="form-group">
                        <label for="company"><?php echo $C2['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C2']; ?>" name="C2">
                      </div>
                      <div class="form-group">
                        <label for="company"><?php echo $C3['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C3']; ?>" name="C3">
                      </div>
                      <div class="form-group">
                        <label for="company"><?php echo $C4['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C4']; ?>" name="C4">
                      </div>
                      <div class="form-group">
                        <label for="company"><?php echo $C5['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C5']; ?>" name="C5">
                      </div>
                      <div class="form-group">
                        <label for="company"><?php echo $C6['Nama_Kriteria']; ?></label>
                        <input class="form-control" id="company" type="number" step="any" value="<?php echo $peserta['C6']; ?>" name="C6">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../nilai">Batal</a>
                      </div>
                      </div>
                    </div>
                  </form>
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