<?php 
session_start();
  include "../../lib/koneksi.php";
  $idtes=$_GET['id_tes'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../jadwal">Jadwal</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jadwal where id_tes = $idtes");
          $jurusan = mysqli_fetch_assoc($tampiljurusan)
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Ubah Data Tes</div>
                  <form action="edit_jadwal_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id_tes" value="<?php echo $idtes; ?>">
                        <label for="company">Nama Tes</label>
                        <input class="form-control" id="company" type="text" name="nama_tes" value="<?php echo $jurusan['jenis_tes']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="vat">Jadwal</label>
                        <input class="form-control" id="company" type="text" name="jadwal" value="<?php echo $jurusan['jadwal']; ?>">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../jadwal">Batal</a>
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