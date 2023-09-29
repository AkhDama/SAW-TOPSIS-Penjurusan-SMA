<?php
session_start();

	include "../lib/koneksi.php";
	
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

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$nisn = $_POST['nisn'];
	$nama = $_POST['nama'];
	$jurusan = $_POST['jurusan'];
	$smp = $_POST['smp'];
	$un = $_POST['un'];
	$kelamin = $_POST['kelamin'];
	$lahir = $_POST['date-input'];
	$alamat = $_POST['alamat'];
	//echo $email;
	//echo $pass;
	//echo $nisn;
	//echo $nama;
	//echo $jurusan;
	//echo $smp;
	//echo $un;
	//echo $kelamin;
	//echo $lahir;
	//echo $alamat;

	$querySimpan = mysqli_query($mysqli, "INSERT INTO peserta (No_Pendaftaran, Email, Password, NISN, Id_Jurusan, Nama, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah,  Nilai_UN) VALUES ('$kodePeserta', '$email', '$pass', '$nisn',  $jurusan, '$nama', '$kelamin', '$lahir', '$alamat', '$smp', $un)");
	
	if ($querySimpan) {
		$querynilai = mysqli_query($mysqli, "INSERT INTO nilai (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', $un, 0, 0, 0, 0, 0)");
		$querynormalisasi = mysqli_query($mysqli, "INSERT INTO normalisasi (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', 0, 0, 0, 0, 0, 0)");
		$querynormalisasi_matriks = mysqli_query($mysqli, "INSERT INTO normalisasi_matriks (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', 0, 0, 0, 0, 0, 0)");
		$pangkat_kriteria = mysqli_query($mysqli, "INSERT INTO pangkat_kriteria (No_Pendaftaran, C1, C2, C3, C4, C5, C6) VALUES ('$kodePeserta', 0, 0, 0, 0, 0, 0)");
		echo "<script> alert ('Anda Berhasil Mendaftar'); window.location='../login';</script>";
	}else{
		echo "<script> alert ('Anda Gagal Mendaftar, Isi Seluruh Data Dengan Benar'); window.location='../daftar';</script>";
	}

?>
