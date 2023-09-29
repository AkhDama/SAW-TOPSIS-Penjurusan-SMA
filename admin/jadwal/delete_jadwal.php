<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_jadwal = $_GET['id_tes'];

	$queryHapus = mysqli_query($mysqli, "DELETE FROM jadwal WHERE id_tes=$id_jadwal");
	if ($queryHapus) {
		echo "<script> alert ('Data Jurusan Berhasil Dihapus'); window.location='../jadwal';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Dihapus'); window.location='../jadwal';</script>";
	}
}
?>
