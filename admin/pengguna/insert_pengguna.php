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
          <li class="breadcrumb-item"><a href="../pengguna">Pengguna</a></li>
          <li class="breadcrumb-item active">Baru</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Foto</div>
                  <form action="insert_pengguna_action.php" method="post">
                    <div class="card-body">
                      
                    </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Tambah Data Pengguna</div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="company">Nama</label>
                        <input class="form-control" id="company" type="text" placeholder="Nama" name="nama">
                      </div>
                      <div class="form-group">
                        <label for="select1">Jabatan</label>
                          <select class="form-control" id="select1" name="jabatan">
                            <option value="Anggota">Anggota</option>
                            <option value="Admin">Admin</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="company">Username</label>
                        <input class="form-control" id="company" type="text" placeholder="Username" name="user">
                      </div>
                      <div class="form-group">
                        <label for="company">Password</label>
                        <input class="form-control" id="company" type="Password" placeholder="Password" name="pass">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../pengguna">Batal</a>
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