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
          <li class="breadcrumb-item active">Jurusan</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Jurusan</div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <a href="insert_jurusan.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Jurusan</i>
                      </a>
                    </div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama Jurusan</th>
                          <th>Kuota</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jurusan");
                          while($jurusan = mysqli_fetch_array($tampiljurusan))
                          {
                        ?>
                        <tr>
                          <td><?php echo $jurusan['Id_Jurusan']; ?></td>
                          <td><?php echo $jurusan['Nama_Jurusan']; ?></td>
                          <td><?php echo $jurusan['Kuota']; ?></td>
                          <td>
                            <a href="edit_jurusan.php?id_jurusan=<?php echo $jurusan['Id_Jurusan']; ?>">
                              <button class="btn btn-success"? type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                            <a href="delete_jurusan.php?id_jurusan=<?php echo $jurusan['Id_Jurusan']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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