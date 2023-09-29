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
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM peserta where No_Pendaftaran = '$no_daftar'");
          $peserta = mysqli_fetch_assoc($tampilpeserta);
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
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
                  <div class="card-header">Ubah Data Peserta</div>
                  <form action="edit_peserta_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="no_daftar" value="<?php echo $no_daftar; ?>">
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
                        <label for="select1">Jurusan</label>
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
                        <a class="btn btn-outline-info btn-lg btn-block" href="../peserta">Batal</a>
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