<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";
	
	$nama_kriteria = $_POST['nama_kriteria'];
	$bobot = $_POST['bobot'];
	$keterangan = $_POST['keterangan'];

	$querySimpan = mysqli_query($mysqli, "INSERT INTO kriteria2 (Nama_Kriteria, Bobot, Keterangan) VALUES ('$nama_kriteria', $bobot, '$keterangan')");
	if ($querySimpan) {
		echo "<script> alert ('Data Kriteria Berhasil Disimpan'); window.location='../kriteria2';</script>";
	}else{
		echo "<script> alert ('Data Kriteria Gagal Disimpan'); window.location='../kriteria2';</script>";
	}
}
?>
