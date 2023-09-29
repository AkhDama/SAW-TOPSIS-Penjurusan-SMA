<?php 
session_start();
  include "../../lib/koneksi.php";
  $idJurusan=$_GET['id_jurusan'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../jurusan">Jurusan</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jurusan where Id_Jurusan = $idJurusan");
          $jurusan = mysqli_fetch_assoc($tampiljurusan)
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Ubah Data Jurusan</div>
                  <form action="edit_jurusan_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id_jurusan" value="<?php echo $idJurusan; ?>">
                        <label for="company">Nama Jurusan</label>
                        <input class="form-control" id="company" type="text" name="nama_jurusan" value="<?php echo $jurusan['Nama_Jurusan']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="vat">Kuota</label>
                        <input class="form-control" id="vat" type="text" name="kuota" value="<?php echo $jurusan['Kuota']; ?>">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../jurusan">Batal</a>
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