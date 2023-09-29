<?php
session_start();
include "../lib/koneksi.php";
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$username = $_SESSION['user'];
$uri = explode('/',  $_SERVER['PHP_SELF']);
if (!isset($_SESSION['have_minat'])) {
?>
<script>
    var httpHost = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/';
    var uri = '<?php echo $uri[1].'/'.$uri[2].'/';?>';
    alert('Anda telah megikuti kuis peminatan');
    location.href = httpHost+uri+'home.php';
</script>
<?php
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

  <center><h2> Hasil Tes Peminatan Anda<hr></h2></center>
			
        <table>
<?php
 $status = (isset($_GET['status']) ? $_GET['status'] : '');
?>
<?php
	$soal1 = (isset($_POST['soal1']) ? $_POST['soal1'] : '');
	$soal2 = (isset($_POST['soal2']) ? $_POST['soal2'] : '');
	$soal3 = (isset($_POST['soal3']) ? $_POST['soal3'] : '');
	$soal4 = (isset($_POST['soal4']) ? $_POST['soal4'] : '');
	$soal5 = (isset($_POST['soal5']) ? $_POST['soal5'] : '');
	$soal6 = (isset($_POST['soal6']) ? $_POST['soal6'] : '');
	$soal7 = (isset($_POST['soal7']) ? $_POST['soal7'] : '');
	$soal8	= (isset($_POST['soal8']) ? $_POST['soal8'] : '');
	$soal9 = (isset($_POST['soal9']) ? $_POST['soal9'] : '');
	$soal10 = (isset($_POST['soal10']) ? $_POST['soal10'] : '');
?>
			<table>
			<tr>
				<td width="20px" align="right" >&nbsp;</td>
				<td class="style4">Berdasarkan kuis peminatan yang telah Anda ikuti, hasil mengenai minat Anda adalah sebagai berikut : <br/>
				<br/>
				<?php
					$skorIPA = 0;
					$skorIPS = 0;
				
						switch($soal1)
						{
							case "a" : $skorIPA = $skorIPA + 3; break;
							case "b" : $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 2; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal2)
						{
							case "a" : $skorIPA = $skorIPA + 2; break;
							case "b" : $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPS = $skorIPS + 3; break;
						}
						
						switch($soal3)
						{
							case "a" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1;	break;
							case "b" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 2;
									   $skorIPS = $skorIPS + 1; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 2; break;
						}
						
						switch($soal4)
						{
							case "a" : $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 3; break;
							case "d" : $skorIPA = $skorIPA + 2;
									   $skorIPS = $skorIPS + 3; break;
							
						}
						
						switch($soal5)
						{
							case "a" : $skorIPS = $skorIPS + 2; break;
							case "b" : $skorIPS = $skorIPS + 2; break;
							case "c" : $skorIPA = $skorIPA + 2; break;
							case "d" : $skorIPA = $skorIPA + 3; break;
						}
						
						switch($soal6)
						{
							case "a" : $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 3; break;
							case "c" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 3; break;
							case "d" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 4; break;
						}
						
						switch($soal7)
						{
							case "a" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 2; break;
							case "c" : $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 4; break;
						}
						
						switch($soal8)
						{
							case "a" : $skorIPA = $skorIPA + 4; break;
							case "b" : $skorIPA = $skorIPA + 1; 
									   $skorIPS = $skorIPS + 2; break;
							case "c" : $skorIPS = $skorIPS + 4; break;
							case "d" : $skorIPA = $skorIPA + 4;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal9)
						{
							case "a" : $skorIPA = $skorIPA + 2; break;
							case "b" : $skorIPS = $skorIPS + 3; break;
							case "c" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal10)
						{
							case "a" : $skorIPS = $skorIPS + 2; break;
							case "b" : $skorIPA = $skorIPA + 1; break;
							case "c" : $skorIPA = $skorIPA + 2; 
									   $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 1; break;
						}
				
					$total = $skorIPA + $skorIPS;
					$preIPA = round(($skorIPA/$total)*100);
					$preIPS = round(($skorIPS/$total)*100);
					
					$simpan = mysqli_query($mysqli, "UPDATE nilai SET C5=$preIPS, C6=$preIPA where No_Pendaftaran = '$username'");
					$tampilminat = mysqli_query($mysqli, "SELECT C5, C6 from nilai where No_pendaftaran='$username'");
					$hslminat = mysqli_fetch_assoc($tampilminat);
				?>
				Presentase minat bidang :
				<ul><table>
					<tr><td class="style4"><li>IPA</li></td><td>:</td><td class="style4"><?php echo $hslminat['C6'];?>%</td></tr>
					<tr><td class="style4"><li>IPS</li></td><td>:</td><td class="style4"><?php echo $hslminat['C5'];?>%</td></tr>
					</table>
				</ul>
						<?php
							$_SESSION['preIPA']=$preIPA;
							$_SESSION['preIPS']=$preIPS;
						?>
				<br/>
				Terima Kasih Sudah Mengisi Tes Peminatan.<br/><br/>
				<p align="left">
				<form action="index.php?ipa=<?=$preIPA?>&ips=<?=$preIPS?>" method="post">
					
					<input class="btn btn-primary" type="submit" name="next" value="finish">
				</form></p>
				</td>
			</tr>
			</table>
			</td>
			</tr>
	</table>
	</td>
	
