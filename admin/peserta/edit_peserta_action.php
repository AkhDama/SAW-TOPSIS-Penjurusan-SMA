<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$no_daftar = $_POST['no_daftar'];
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

	$querySimpan = mysqli_query($mysqli, "UPDATE peserta SET Email='$email', Password='$pass', NISN='$nisn', Id_Jurusan=$jurusan, Nama='$nama', Jenis_Kelamin='$kelamin', Tanggal_Lahir='$lahir', Alamat='$alamat', Asal_Sekolah='$smp', Nilai_UN=$un WHERE No_Pendaftaran='$no_daftar'");
	$queryNilai = mysqli_query($mysqli, "UPDATE nilai SET C1 = $un WHERE No_Pendaftaran = '$no_daftar'");
	if ($querySimpan && $queryNilai) {
		echo "<script> alert ('Data Peserta Berhasil Disimpan'); window.location='../peserta';</script>";
	}else{
		echo "<script> alert ('Data Peserta Gagal Disimpan'); window.location='../peserta';</script>";
	}
}
?>
