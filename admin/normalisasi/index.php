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
          <li class="breadcrumb-item active">Normalisasi</li>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-sm-12 col-xl-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa icon-graduation"></i> Jurusan
                  </div>
                  <div class="card-body">
                    <div class="list-group">
                      <?php 
                        $tampiljurusan = mysqli_query($mysqli,"SELECT * from jurusan");
                        while($jurusan = mysqli_fetch_array($tampiljurusan))
                        {
                      ?>
                      <a class="list-group-item list-group-item-action list-group-item-info" href="normalisasi.php?id_jurusan=<?php echo $jurusan['Id_Jurusan']; ?>">
                        <?php echo $jurusan['Nama_Jurusan']; ?>
                      </a>
                      <?php 
                        }
                      ?>
                    </div>
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