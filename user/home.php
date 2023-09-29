<?php
session_start();
include("../lib/koneksi.php");
if(!isset($_SESSION['user'])){
	header("location:login.php");
}
$username=$_SESSION['user'];
$tampilminat = mysqli_query($mysqli, "SELECT C5, C6 from nilai where No_pendaftaran='$username'");
$hslminat = mysqli_fetch_assoc($tampilminat);
$ipa = $hslminat['C6'];
$ips = $hslminat['C5'];
if (!empty($hslminat)) {
    $_SESSION['have_minat'] = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SPK-Penjurusan SMA Idaman</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/responsive.css">
</head>
<body>

<div class="features">
		<div class="container">
        <div class="card">

  <center><h2> Selamat datang di website Sistem Pendukung Keputusan Pemilihan Jurusan SMA (IPA/IPS/Bahasa)<hr></h2></center>
        <table>
                            <tr>
                                <td width="20px" align="right" >&nbsp;</td>
                                <td class="style4" align="left">
                                        Ada tiga tahapan yang akan dilakukan dalam pemilihan jurusan dengan SPK ini, antara lain :<br/>
                                        <ol>
                                                <li>Mengambil dan Menghitung rata-rata nilai per-bidang jurusan</li>
                                                <li>Mengambil data Hasil Psikotes</li>
                                                <li>Mengikuti kuis peminatan jurusan</li>
                                        </ol>
                                        
                                        <p align="left">
                                            <?php
                                                if (isset($_SESSION['have_minat'])) {
                                                
                                            ?>
                                                <i>Silahkan klik tombol start untuk mulai menggunakan SPK ini.</i><br/>
                                                <form action="minat.php" method="post">
                                                        <input type="hidden" name="username">
                                                        <input class="btn btn-primary" type="submit" name="start" value="start">
                                                </form>
                                        <?php
                                            } else {
                                        ?>
                                            <?php 
                                            $tampilnama = mysqli_query($mysqli, "SELECT * from peserta where No_pendaftaran='$username'");
                                            $nama = mysqli_fetch_assoc($tampilnama);
                                            
                                            echo $nama['Nama'];?> telah mengikuti kuis peminatan ini hasilnya sebagai berikut:<br/>
                                            <ul>
                                                <table>
                                                    <tr><td class="style4"><li>IPA</li></td><td>:</td><td class="style4"><?php echo $hslminat['C6'];?>%</td></tr>
                                                    <tr><td class="style4"><li>IPS</li></td><td>:</td><td class="style4"><?php echo $hslminat['C5'];?>%</td></tr>
                                                </table>
                                            </ul>
                                        <?php
                                            }
                                        ?>
                                        </p>
                                </td>
                            </tr>
			</table>
    </div>
</div>
</body>
