<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_admin = $_GET['Id_Admin'];

	$queryHapus = mysqli_query($mysqli, "DELETE FROM admin WHERE Id_Admin=$id_admin");
	if ($queryHapus) {
		echo "<script> alert ('Data Pengguna Berhasil Dihapus'); window.location='../pengguna';</script>";
	}else{
		echo "<script> alert ('Data Pengguna Gagal Dihapus'); window.location='../pengguna';</script>";
	}
}
?>
