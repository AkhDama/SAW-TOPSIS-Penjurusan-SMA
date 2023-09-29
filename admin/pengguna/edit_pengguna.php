<?php 
session_start();
  include "../../lib/koneksi.php";
  $idadmin=$_GET['Id_Admin'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../pengguna">Pengguna</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampiladmin = mysqli_query($mysqli, "SELECT * FROM admin where Id_Admin = $idadmin");
          $admin = mysqli_fetch_assoc($tampiladmin)
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Foto</div>
                  <form action="edit_pengguna_action.php" method="post">
                    <div class="card-body">
                      
                    </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Ubah Data Pengguna</div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id_admin" value="<?php echo $idadmin; ?>">
                        <label for="company">Nama</label>
                        <input class="form-control" id="company" type="text" name="nama" value="<?php echo $admin['Nama']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jabatan</label>
                          <?php 
                            if ($admin['Jabatan']=='Admin') {
                          ?>
                          <select class="form-control" id="select1" name="jabatan">
                            <option value="Anggota">Anggota</option>
                            <option value="Admin" selected="">Admin</option>
                          </select>
                          <?php
                          }
                          else
                          { 
                          ?>
                          <select class="form-control" id="select1" name="jabatan">
                            <option value="Anggota" selected="">Anggota</option>
                            <option value="Admin">Admin</option>
                          </select>
                          <?php 
                          }
                          ?>
                      </div>
                      <div class="form-group">
                        <label for="company">Username</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $admin['Username']; ?>" name="user">
                      </div>
                      <div class="form-group">
                        <label for="company">Password</label>
                        <input class="form-control" id="company" type="Password" value="<?php echo $admin['Password']; ?>" name="pass">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../pengguna">Batal</a>
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