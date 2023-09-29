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
          <li class="breadcrumb-item active">Peserta</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Peserta</div>
                    <a href="insert_peserta.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Peserta</i>
                    </a>
                  <div class="card-body">
                    
                      <a href="form.php" class="btn btn-success pull-right">
                        <span class="glyphicon glyphicon-upload"></span> Import Data
                      </a>
                      <a href="clear.php" onClick="return confirm('Anda yakin ingin menghapus seluruh data ini?')" class="btn btn-danger pull-center">
                        <span class="glyphicon glyphicon-upload"></span> Clear All Data 
                      </a>
                    </div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NISN</th>
                          <th>Nama</th>
                          <th>Tanggal Lahir</th>
                          <th>Jenis Kelamin</th>
                          <th>Email</th>
                          <th>Asal Sekolah</th>
                          <th>Jurusan Pilihan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampilpeserta = mysqli_query($mysqli, "SELECT No_Pendaftaran,NISN,Nama,Jenis_Kelamin,Tanggal_Lahir,Email,Nama_Jurusan,Asal_Sekolah FROM peserta p join jurusan j on p.Id_Jurusan = j.Id_Jurusan ORDER BY No_Pendaftaran");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['NISN']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['Tanggal_Lahir']; ?></td>
                          <td><?php echo $peserta['Jenis_Kelamin']; ?></td>
                          <td><?php echo $peserta['Email']; ?></td>
                          <td><?php echo $peserta['Asal_Sekolah']; ?></td>
                          <td><?php echo $peserta['Nama_Jurusan']; ?></td>
                          <td>
                            <a href="detail_peserta.php?No_Pendaftaran=<?php echo $peserta['No_Pendaftaran']; ?>">
                              <button class="btn btn-primary" type="button">
                                <i class="fa fa-file-text"></i>
                              </button>
                            </a>
                            <a href="edit_peserta.php?No_Pendaftaran=<?php echo $peserta['No_Pendaftaran']; ?>">
                              <button class="btn btn-success" type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                            <a href="delete_peserta.php?No_Pendaftaran=<?php echo $peserta['No_Pendaftaran']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                        <?php  
                          }
                        ?>
                      </tbody>
                    </table>
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