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
          <li class="breadcrumb-item active">Kriteria</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Kriteria</div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <a href="insert_kriteria.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Kriteria</i>
                      </a>
                    </div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>Bobot IPS</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $total_bobot =  mysqli_query($mysqli, "SELECT sum(Bobot) as Total from kriteria2");
                          $bobot = mysqli_fetch_assoc($total_bobot);
                          if ($bobot['Total'] < 1) {
                        ?>
                          <h1>Total Bobot Terlalu Sedikit yaitu sebesar = <?php echo $bobot['Total']; ?></h1>
                        <?php 
                          }
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria2");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <tr>
                          <td><?php echo $kriteria['Id_Kriteria']; ?></td>
                          <td><?php echo $kriteria['Nama_Kriteria']; ?></td>
                          <td><?php echo $kriteria['Bobot']; ?></td>
                          <td><?php echo $kriteria['Keterangan']; ?></td>
                          <td>
                            <a href="edit_kriteria.php?id_kriteria=<?php echo $kriteria['Id_Kriteria']; ?>">
                              <button class="btn btn-success" type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                            <a href="delete_kriteria.php?id_kriteria=<?php echo $kriteria['Id_Kriteria']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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