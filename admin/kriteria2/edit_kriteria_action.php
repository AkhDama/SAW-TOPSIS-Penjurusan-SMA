<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_kriteria = $_POST['id_kriteria'];
	$nama_kriteria = $_POST['nama_kriteria'];
	$bobot = $_POST['bobot'];
	$keterangan = $_POST['keterangan'];

	$tampilkriteria = mysqli_query($mysqli, "SELECT SUM(Bobot) as total FROM kriteria2 WHERE Id_Kriteria != $id_kriteria");
    $kriteria = mysqli_fetch_assoc($tampilkriteria);

	$total = $kriteria['total'] + $bobot;
	echo $total;

	if ( $total > 1) {

		echo "<script> alert ('Kelebihan Bobot Kriteria'); window.location='../kriteria2';</script>";

	} else {
		$querySimpan = mysqli_query($mysqli, "UPDATE kriteria2 SET Nama_Kriteria='$nama_kriteria', Bobot=$bobot, Keterangan='$keterangan' WHERE Id_Kriteria=$id_kriteria");
		if ($querySimpan) {
			echo "<script> alert ('Data Kriteria Berhasil Disimpan'); window.location='../kriteria2';</script>";
		}else{
			echo "<script> alert ('Data Kriteria Gagal Disimpan'); window.location='../kriteria2';</script>";
		}
	}
	

	
}
?>
