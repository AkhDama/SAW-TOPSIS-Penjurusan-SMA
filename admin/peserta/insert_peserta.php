<?php 
session_start();
  include "../../lib/koneksi.php";
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
          <li class="breadcrumb-item active">Baru</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
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
                  <div class="card-header">Tambah Data Peserta</div>
                  <form action="insert_peserta_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="company">Email</label>
                        <input class="form-control" id="company" type="email" placeholder="Email" name="email">
                      </div>
                      <div class="form-group">
                        <label for="company">Password</label>
                        <input class="form-control" id="company" type="Password" placeholder="Password" name="pass">
                      </div>
                      <div class="form-group">
                        <label for="company">NISN</label>
                        <input class="form-control" id="company" type="number" placeholder="NISN" name="nisn">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jurusan Yang Dipilih</label>
                          <select class="form-control" id="select1" name="jurusan">
                            <?php 
                              $tampiljurusan = mysqli_query($mysqli,"SELECT * from jurusan");
                              while($jurusan = mysqli_fetch_array($tampiljurusan))
                              {
                            ?>
                            <option value="<?php echo $jurusan['Id_Jurusan']; ?>"><?php echo $jurusan['Nama_Jurusan']; ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Nama</label>
                        <input class="form-control" id="company" type="text" placeholder="Nama" name="nama">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jenis Kelamin</label>
                          <select class="form-control" id="select1" name="kelamin">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="company">Tanggal Lahir</label>
                        <input class="form-control" id="date-input" type="date" name="date-input" placeholder="Tanggal Lahir">
                      </div>
                      <div class="form-group">
                        <label for="company">Alamat</label>
                        <input class="form-control" id="company" type="text" placeholder="Alamat" name="alamat">
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Asal Kelas</label>
                        <input class="form-control" id="company" type="text" placeholder="Contoh : X1" name="smp">
                      </div>
                      <div class="form-group">
                        <label for="company">Nilai Rata Mapel Umum Kelas X</label>
                        <input class="form-control" id="company" type="number" step="any" placeholder="Semester 1&2 (MTK+B.Inggris+B.Indonesia+Agama)" name="un">
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