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
          <li class="breadcrumb-item active">Jadwal Tes</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Jadwal Tes</div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <a href="insert_jadwal.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Data</i>
                      </a>
                    </div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Nama Tes</th>
                          <th>Jadwal</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jadwal");
                          while($jurusan = mysqli_fetch_array($tampiljurusan))
                          {
                        ?>
                        <tr>
                          <td><?php echo $jurusan['jenis_tes']; ?></td>
                          <td><?php echo $jurusan['jadwal']; ?></td>
                          <td>
                            <a href="edit_jadwal.php?id_tes=<?php echo $jurusan['id_tes']; ?>">
                              <button class="btn btn-success"? type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                            <a href="delete_jadwal.php?id_tes=<?php echo $jurusan['id_tes']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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