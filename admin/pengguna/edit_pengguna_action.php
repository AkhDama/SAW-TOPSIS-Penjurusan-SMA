<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_admin = $_POST['id_admin'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$querySimpan = mysqli_query($mysqli, "UPDATE admin SET Nama='$nama', Jabatan='$jabatan', Username='$user', Password='$pass' WHERE Id_Admin=$id_admin");
	if ($querySimpan) {
		echo "<script> alert ('Data Pengguna Berhasil Disimpan'); window.location='../pengguna';</script>";
	}else{
		echo "<script> alert ('Data Pengguna Gagal Disimpan'); window.location='../pengguna';</script>";
	}
}
?>
