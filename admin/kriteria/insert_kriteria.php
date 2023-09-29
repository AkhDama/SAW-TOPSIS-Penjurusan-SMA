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
          <li class="breadcrumb-item"><a href="../kriteria">Kriteria</a></li>
          <li class="breadcrumb-item active">Baru</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Tambah Data Kriteria</div>
                  <form action="insert_kriteria_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="company">Nama Kriteria</label>
                        <input class="form-control" id="company" type="text" placeholder="Nama kriteria" name="nama_kriteria">
                      </div>
                      <div class="form-group">
                        <label for="vat">Bobot</label>
                        <input class="form-control" id="vat" type="number" step="any" placeholder="Bobot" name="bobot">
                      </div>
                      <div class="form-group">
                        <label for="select1">Keterangan</label>
                          <select class="form-control" id="select1" name="keterangan">
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                          </select>
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../kriteria">Batal</a>
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