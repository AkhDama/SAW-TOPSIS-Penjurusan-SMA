<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";
	
	$nama_jurusan = $_POST['nama_jurusan'];
	$kuota = $_POST['kuota'];

	$querySimpan = mysqli_query($mysqli, "INSERT INTO jurusan (Nama_Jurusan, Kuota) VALUES ('$nama_jurusan', $kuota)");
	if ($querySimpan) {
		echo "<script> alert ('Data Jurusan Berhasil Disimpan'); window.location='../jurusan';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Disimpan'); window.location='../jurusan';</script>";
	}
}
?>
