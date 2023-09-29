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
          <li class="breadcrumb-item active">Nilai</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Nilai Peserta</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Jurusan Pilihan</th>
                          <?php  
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran ORDER BY No_Pendaftaran");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['Nama_Jurusan']; ?></td>
                          <td><?php echo $peserta['C1']; ?></td>
                          <td><?php echo $peserta['C2']; ?></td>
                          <td><?php echo $peserta['C3']; ?></td>
                          <td><?php echo $peserta['C4']; ?></td>
                          <td><?php echo $peserta['C5']; ?></td>
                          <td><?php echo $peserta['C6']; ?></td>
                          <td>
                            <!--<a href="detail_nilai.php?No_Pendaftaran=<?php echo $peserta['No_Pendaftaran']; ?>">
                              <button class="btn btn-primary" type="button">
                                <i class="fa fa-file-text"></i>
                              </button>-->
                            </a>
                            <a href="edit_nilai.php?No_Pendaftaran=<?php echo $peserta['No_Pendaftaran']; ?>">
                              <button class="btn btn-success" type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
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