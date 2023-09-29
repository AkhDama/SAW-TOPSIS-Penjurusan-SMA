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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-users bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-success">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from peserta");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as totalL from peserta where Jenis_Kelamin='L'");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['totalL']. '(L)';
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as totalP from peserta where Jenis_Kelamin='P'");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['totalP']. '(P)';
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Peserta</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-graduation-cap bg-info p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-primary">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from jurusan");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as totalIPA from peserta where Id_Jurusan='1'");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['totalIPA']. '(IPA)';
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as totalIPS from peserta where Id_Jurusan='2'");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['totalIPS']. '(IPS)';
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Jurusan</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-list-ul bg-warning p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-warning">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from kriteria");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Kriteria</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-user bg-danger p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-danger">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from admin");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Admin</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Sistem Pendukung Keputusan</div>
                  <div class="card-body">
                  <div class="col-md-10">
                    	<!-- Features -->

	<div class="features">
		<div class="container">
			<div class="row features_row justify-content-center">
				<div class="col-md-10">
                <h4>PETUNJUK CARA KERJA & PENGGUNAAN SISTEM PENDUKUNG KEPUTUSAN METODE SAW-TOPSIS</h4>
				<hr><br>
					<!-- Features Item -->
	                <h4>1.	Untuk Siswa</h4>
	                <li>Siswa membuat akun terlebih dahulu dengan mengisi data pribadi, pilihan jurusan dan data nilai</li>
					<li>Untuk data pribadi, peserta harus mengisi dengan baik dan benar.</li>
					<li>Untuk pilihan jurusan, peserta dipersilakan memilih jurusan yang diminati untuk sementara sebab system akan menyocokkan hasil.</li>
					<li>Untuk data nilai, pada saat pendaftaran peserta harus mengisi dengan jujur dan benar nilai rata UN SMP/MTS.</li>
	                <li>Pada saat awal kemungkinan pada laman dashboard akan memberikan keterangan lulus pada jurusan yang dipilih atau tidak, namun ini belum akhir dan masih bersifat sementara sampai seluruh data semua siswa lengkap dan benar.</li>
					<i><b>Note : Hasil keputusan akhir berada pada pihak sekolah</i></b>
					<br><br>
	                <h4>2.	Untuk Admin</h4>
	                <li>Admin diperkenankan menambahkan data siswa baru dengan berkoordinasi dengan siswa yang bersangkutan.</li>
					<li>Admin dapat mengubah data siswa baik data pribadi, data nilai dan pilihan jurusan siswa.</li>
					<li>Admin dapat menghapus data salah satu siswa atau seluruh.</li>
					<li>Admin harus mengklik menu yang ada secara berurutan pada dashboard, karena hal tersebut menyangkut daripada proses perhitungan.</li>
					<i><b>Note : Hasil keputusan akhir berada ditangan pihak sekolah.</i></b>
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