<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {

include "../../lib/koneksi.php";
	$Hapus1 = mysqli_query($mysqli, "DELETE FROM nilai");
	$Hapus2 = mysqli_query($mysqli, "DELETE FROM normalisasi");
    $Hapus3 = mysqli_query($mysqli, "DELETE FROM normalisasi_matriks");
	$queryHapus = mysqli_query($mysqli, "DELETE FROM peserta");

if ($queryHapus && $Hapus1 && $Hapus2 && $Hapus3) {

    echo "<script> alert ('Data Peserta Berhasil Dihapus'); window.location='../peserta';</script>";
}else{
    echo "<script> alert ('Data Peserta Gagal Dihapus'); window.location='../peserta';</script>";
}
}
?>