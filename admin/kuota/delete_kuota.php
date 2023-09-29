<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_jurusan = $_GET['id_jurusan'];

	$queryHapus = mysqli_query($mysqli, "DELETE FROM jurusan WHERE Id_Jurusan=$id_jurusan");
	if ($queryHapus) {
		echo "<script> alert ('Data Jurusan Berhasil Dihapus'); window.location='../jurusan';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Dihapus'); window.location='../jurusan';</script>";
	}
}
?>
