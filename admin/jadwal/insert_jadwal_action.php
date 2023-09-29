<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";
	
	$nama = $_POST['nama_tes'];
	$jadwal = $_POST['jadwal_tes'];

	$querySimpan = mysqli_query($mysqli, "INSERT INTO jadwal (jenis_tes, jadwal) VALUES ('$nama', '$jadwal')");
	if ($querySimpan) {
		echo "<script> alert ('Data Jurusan Berhasil Disimpan'); window.location='../jadwal';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Disimpan'); window.location='../jadwal';</script>";
	}
}
?>
