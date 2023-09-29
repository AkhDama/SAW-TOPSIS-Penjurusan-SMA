<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_tes = $_POST['id_tes'];
	$nama_tes = $_POST['nama_tes'];
	$jadwal = $_POST['jadwal'];

	$querySimpan = mysqli_query($mysqli, "UPDATE jadwal SET jenis_tes='$nama_tes', jadwal='$jadwal' WHERE id_tes='$id_tes'");
	if ($querySimpan) {
		echo "<script> alert ('Data Jurusan Berhasil Disimpan'); window.location='../jadwal';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Disimpan'); window.location='../jadwal';</script>";
	}
}
?>
