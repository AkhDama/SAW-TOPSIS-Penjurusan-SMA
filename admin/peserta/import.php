<?php
/*
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/mynotescode
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "../../lib/koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

  $numrow = 1;
	foreach($sheet as $row){
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

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
			// Buat query Insert
        // Buat query Insert
    if ($numrow > 1){
      $query = "SELECT max(No_Pendaftaran) as maxKode FROM peserta";
      $hasil = mysqli_query($mysqli,$query);
      $data = mysqli_fetch_array($hasil);
      $kodePeserta = $data['maxKode'];
       
      // mengambil angka atau bilangan dalam kode anggota terbesar,
      // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
      // misal 'BRG001', akan diambil '001'
      // setelah substring bilangan diambil lantas dicasting menjadi integer
      $noUrut = (int) substr($kodePeserta, 4, 4);
       
      // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
      $noUrut=$noUrut+1;
       
      // membentuk kode anggota baru
      // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
      // misal sprintf("%03s", 12); maka akan dihasilkan '012'
      // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
      $char = "MD-";
      $char2 = "-SK";
      $char3 = "-II";
      $kodePeserta = $char . sprintf("%04s", $noUrut). $char2. $char3;
      echo $kodePeserta;	
    
      $querySimpan = mysqli_query($mysqli, "INSERT INTO peserta (No_Pendaftaran, Email, Password, NISN, Id_Jurusan, Nama, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah, Nilai_UN) VALUES ('$kodePeserta','$email','$password','$nisn','$id_jur','$nama','$gender','$lahir','$alamat','$asal','$rata')");
      
      if ($querySimpan) {
        $querynilai = mysqli_query($mysqli, "INSERT INTO nilai (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', '$rata', '$ripa', '$rips', '$psik', '$mips', '$mipa')");
        $querynormalisasi = mysqli_query($mysqli, "INSERT INTO normalisasi (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', '$rata', '$ripa', '$rips', '$psik', '$mips', '$mipa')");
        $querynormalisasi_matriks = mysqli_query($mysqli, "INSERT INTO normalisasi_matriks (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', '$rata', '$ripa', '$rips', '$psik', '$mips', '$mipa')");  
      }
      echo "<script> alert ('Data Peserta Berhasil Disimpan'); window.location='../peserta';</script>";
    }
    $numrow++;
    
  }
}
  header('location: index.php'); // Redirect ke halaman awal
  ?>
  