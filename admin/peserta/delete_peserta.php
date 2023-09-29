<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$no_daftar = $_GET['No_Pendaftaran'];

	$Hapus1 = mysqli_query($mysqli, "DELETE FROM nilai WHERE No_Pendaftaran='$no_daftar'");
	$Hapus2 = mysqli_query($mysqli, "DELETE FROM normalisasi WHERE No_Pendaftaran='$no_daftar'");
	$Hapus3 = mysqli_query($mysqli, "DELETE FROM normalisasi_matriks WHERE No_Pendaftaran='$no_daftar'");
	$queryHapus = mysqli_query($mysqli, "DELETE FROM peserta WHERE No_Pendaftaran='$no_daftar'");
	if ($queryHapus && $Hapus1 && $Hapus2 && $Hapus3) {
		echo "<script> alert ('Data Peserta Berhasil Dihapus'); window.location='../peserta';</script>";
	}else{
		echo "<script> alert ('Data Peserta Gagal Dihapus'); window.location='../peserta';</script>";
	}
}
?>
