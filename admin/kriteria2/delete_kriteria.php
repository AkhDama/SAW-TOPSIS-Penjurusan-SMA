<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_kriteria = $_GET['id_kriteria'];

	$queryHapus = mysqli_query($mysqli, "DELETE FROM kriteria2 WHERE Id_Kriteria=$id_kriteria");
	if ($queryHapus) {
		echo "<script> alert ('Data kriteria Berhasil Dihapus'); window.location='../kriteria2';</script>";
	}else{
		echo "<script> alert ('Data kriteria Gagal Dihapus'); window.location='../kriteria2';</script>";
	}
}
?>
