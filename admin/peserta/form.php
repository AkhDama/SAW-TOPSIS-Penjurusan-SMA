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
          <li class="breadcrumb-item active">Import Peserta</li>
        </ol>
    <script>
    $(document).ready(function(){
      // Sembunyikan alert validasi kosong
      $("#kosong").hide();
    });
    </script>
    
    <!-- Content -->
    <div style="padding: 0 15px;">
      <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
      <a href="index.php" class="btn btn-danger pull-right">
        <span class="glyphicon glyphicon-remove"></span> Cancel
      </a>
      
      <h3>Form Import Data</h3>
      <hr>
      
      <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
      <form method="post" action="" enctype="multipart/form-data">
        <!-- <a href="Format.xlsx" class="btn btn-default">
          <span class="glyphicon glyphicon-download"></span>
          Download Format
        </a><br><br> -->
        
        <!-- 
        -- Buat sebuah input type file
        -- class pull-left berfungsi agar file input berada di sebelah kiri
        -->
        <input type="file" name="file" class="pull-left">
        
        <button type="submit" name="preview" class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-eye-open"></span> Preview
        </button>
      </form>
      
      <hr>
      
      <!-- Buat Preview Data -->
      <?php
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){
        $nama_file_baru = 'data.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
          unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
        $tmp_file = $_FILES['file']['tmp_name'];
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if($ext == "xlsx"){
          // Upload file yang dipilih ke folder tmp
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once 'PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='import.php'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
          </div>";
          
          echo "<table class='table table-bordered'>
          <tr>
            <th colspan='16' class='text-center'>Preview Data</th>
          </tr>
          <tr>
          <th>No</th>
          <th>Email</th>
          <th>Password</th>
          <th>NISN</th>
          <th>ID Jurusan</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>Asal</th>
          <th>Nilai Rata Rapor</th>
          <th>Rata IPA</th>
          <th>Rata IPS</th>
          <th>Psikotes</th>
          <th>Minat IPS</th>
          <th>Minat IPA</th>
          </tr>";
          $numrow = 1;
          $kosong = 0;
          foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            // Ambil data pada excel sesuai Kolom
            $no = $row['A']; // Ambil data email
            $email = $row['B']; // Ambil data email
            $password = $row['C']; // Ambil data passsword
            $nisn = $row['D']; // Ambil data nisn
            $id_jur = $row['E']; // Ambil data jurusan
            $nama = $row['F']; // Ambil data nama
            $gender = $row['G']; // Ambil data gender
            $lahir = $row['H']; // Ambil data lahir
            $alamat = $row['I']; // Ambil data alamat
            $asal = $row['J']; // Ambil data asal
            $rata = $row['K']; // Ambil data nisn
            $ripa = $row['L']; // Ambil data jurusan
            $rips = $row['M']; // Ambil data nama
            $psik = $row['N']; // Ambil data gender
            $mips = $row['O']; // Ambil data lahir
            $mipa = $row['P']; // Ambil data alamat

            // Cek jika semua data tidak diisi
            if($email == "" && $password == "" && $nisn == "" && $id_jur == "" && $nama == "" && $gender == "" && $lahir == "" && $alamat == "" && $asal == "")
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
              // Validasi apakah semua data telah diisi
              $no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika No Kosng
              $email_td = ( ! empty($email))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
              $password_td = ( ! empty($password))? "" : " style='background: #E07171;'";
              $nisn_td = ( ! empty($nisn))? "" : " style='background: #E07171;'";
              $id_jur_td = ( ! empty($id_jur))? "" : " style='background: #E07171;'";
              $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
              $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              $lahir_td = ( ! empty($lahir))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
              $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
              $asal_td = ( ! empty($asal))? "" : " style='background: #E07171;'";
              $rata_td = ( ! empty($rata))? "" : " style='background: #E07171;'";
              $ripa_td = ( ! empty($ripa))? "" : " style='background: #E07171;'";
              $rips_td = ( ! empty($rips))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
              $psik_td = ( ! empty($psik))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              $mips_td = ( ! empty($mips))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
              $mipa_td = ( ! empty($mipa))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
              // Jika salah satu data ada yang kosong
              if($email == "" or $password == "" or $nisn == "" or $nama == "" or $gender == "" or $lahir == "" or $alamat == "" or $asal == ""){
                $kosong++; // Tambah 1 variabel $kosong
              }
              
              echo "<tr>";
              echo "<td".$no_td.">".$no."</td>";
              echo "<td".$email_td.">".$email."</td>";
              echo "<td".$password_td.">".$password."</td>";
              echo "<td".$nisn_td.">".$nisn."</td>";
              echo "<td".$id_jur_td.">".$id_jur."</td>";
              echo "<td".$nama_td.">".$nama."</td>";
              echo "<td".$gender_td.">".$gender."</td>";
              echo "<td".$lahir_td.">".$lahir."</td>";
              echo "<td".$alamat_td.">".$alamat."</td>";
              echo "<td".$asal_td.">".$asal."</td>";
              echo "<td".$rata_td.">".$rata."</td>";
              echo "<td".$ripa_td.">".$ripa."</td>";
              echo "<td".$rips_td.">".$rips."</td>";
              echo "<td".$psik_td.">".$psik."</td>";
              echo "<td".$mips_td.">".$mips."</td>";
              echo "<td".$mipa_td.">".$mipa."</td>";
              echo "</tr>";
            }
            
            $numrow++; // Tambah 1 setiap kali looping
          }
          
          echo "</table>";
          
          // Cek apakah variabel kosong lebih dari 0
          // Jika lebih dari 0, berarti ada data yang masih kosong
          if($kosong > 0){
          ?>  
            <script>
            $(document).ready(function(){
              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
              
              $("#kosong").show(); // Munculkan alert validasi kosong
            });
            </script>
          <?php
           }
          // Jika semua data sudah diisi
            echo "<hr>";
            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-primary pull-right'><span class='glyphicon glyphicon-upload'></span> Import</button>";
          echo "</form>";
          echo "<br>"; echo "<br>";echo "<br>"; echo "<br>";
        }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
          // Munculkan pesan validasi
          echo "<div class='alert alert-danger'>
          Hanya File Excel 2007 (.xlsx) yang diperbolehkan
          </div>";
        }
      }
      ?>
    </div>
  </body>
</html>
<?php
    include "../template/footer.php";
  }
  else
  {
    header("location: ../login/");
  } 
?>