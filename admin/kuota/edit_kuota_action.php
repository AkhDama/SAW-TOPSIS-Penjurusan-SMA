<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_jurusan = $_POST['id_jurusan'];
	$nama_jurusan = $_POST['nama_jurusan'];
	$kuota = $_POST['kuota'];

	$querySimpan = mysqli_query($mysqli, "UPDATE jurusan SET Nama_Jurusan='$nama_jurusan', Kuota=$kuota WHERE Id_Jurusan=$id_jurusan");
	if ($querySimpan) {
		echo "<script> alert ('Data Jurusan Berhasil Disimpan'); window.location='../jurusan';</script>";
	}else{
		echo "<script> alert ('Data Jurusan Gagal Disimpan'); window.location='../jurusan';</script>";
	}
}
?>
