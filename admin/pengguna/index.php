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
          <li class="breadcrumb-item active">Pengguna</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Pengguna</div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <a href="insert_pengguna.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Pengguna</i>
                      </a>
                    </div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Jabatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampiladmin = mysqli_query($mysqli, "SELECT * FROM admin");
                          while($admin = mysqli_fetch_array($tampiladmin))
                          {
                        ?>
                        <tr>
                          <td><?php echo $admin['Id_Admin']; ?></td>
                          <td><?php echo $admin['Nama']; ?></td>
                          <td><?php echo $admin['Username']; ?></td>
                          <td><?php echo $admin['Jabatan']; ?></td>
                          <td>
                            <a href="edit_pengguna.php?Id_Admin=<?php echo $admin['Id_Admin']; ?>">
                              <button class="btn btn-success" type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                            <a href="delete_pengguna.php?Id_Admin=<?php echo $admin['Id_Admin']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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