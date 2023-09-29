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
          <li class="breadcrumb-item"><a href="../jurusan">Jurusan</a></li>
          <li class="breadcrumb-item active">Baru</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Tambah Data Jurusan</div>
                  <form action="insert_jurusan_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="company">Nama Jurusan</label>
                        <input class="form-control" id="company" type="text" placeholder="Nama Jurusan" name="nama_jurusan">
                      </div>
                      <div class="form-group">
                        <label for="vat">Kuota</label>
                        <input class="form-control" id="vat" type="number" placeholder="Kuota" name="kuota">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../jurusan">Batal</a>
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