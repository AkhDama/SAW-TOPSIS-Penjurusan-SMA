<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
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

  <center><h2> Silahkan mengisi kuis peminatan di bawah ini dengan jujur !<hr></h2></center>
			
<?php
	$status = (isset($_GET['status']) ? $_GET['status'] : '');
?>
				<form name="formMinat" method="post" action="getMinat.php">
	<table>
		<tr>
			<td class="style4"> 1. </td>
			<td class="style4"> Pekerjaan mana yang menurut anda lebih menarik dan menyenangkan? </td> 
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal1" value="a" /> Dokter 
				<br />
				<input type="radio" name="soal1" value="b" />Pengusaha
				<br />
				<input type="radio" name="soal1" value="c" /> Insinyur
				<br />
				<input type="radio" name="soal1" value="d" /> Seniman
			</td>
		</tr>
		<tr>
			<td class="style4">&nbsp;   </td>
			<td class="style4">&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 2. </td>
			<td class="style4"> Seberapa sering anda mengikuti perkembangan politik dan ekonomi? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal2" value="a" /> Tidak pernah 
				<br />
				<input type="radio" name="soal2" value="b" /> Tidak Sering
				<br />
				<input type="radio" name="soal2" value="c" /> Sering
				<br />
				<input type="radio" name="soal2" value="d" /> Sangat Sering
				
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 3. </td>
			<td class="style4"> Berapa banyak jenis bahasa yang anda kuasai? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal3" value="a"  /> 1
				<br />
				<input type="radio" name="soal3" value="b" /> 2
				<br />
				<input type="radio" name="soal3" value="c" /> 3
				<br />
				<input type="radio" name="soal3" value="d" /> Lebih dari 3
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">4. </td>
			<td class="style4"> Bergerak dibidang apakah kebanyakan keluarga anda?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal4" value="a"  /> Bisnis / pengusaha
				<br />
				<input type="radio" name="soal4" value="b" /> Entertaiment
				<br />
				<input type="radio" name="soal4" value="c" /> Kesehatan (Dokter, perawat, analis gizi, dsb)
				<br />
				<input type="radio" name="soal4" value="d" /> Relegius

			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 5. </td>
			<td class="style4"> Berapa banyak anda menghabiskan waktu untuk merawat tubuh?? (baik untuk kecantikan maupun kesehatan)? </td> 
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal5" value="a" /> Tidak pernah 
				<br />
				<input type="radio" name="soal5" value="b" />sedikit
				<br />
				<input type="radio" name="soal5" value="c" /> Banyak
				<br />
				<input type="radio" name="soal5" value="d" />  Sangat banyak
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">6. </td>
			<td class="style4"> Manakah sifat dibawah ini yang sesuai dengan karakter anda?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal6" value="a"  /> keras, tegas, selalu mengikuti perkembangan (update)
				<br />
				<input type="radio" name="soal6" value="b" /> pendiam, suka mencari tahu sesuatu, teliti
				<br />
				<input type="radio" name="soal6" value="c" />  Suka mencoba hal baru, kreatif, pemberani
				<br />
				<input type="radio" name="soal6" value="d" />  tertutup, malu-malu
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">7. </td>
			<td class="style4">  Apa yang sering anda lakukan untuk mengisi waktu luang?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal7" value="a" /> tidur 
				<br />
				<input type="radio" name="soal7" value="b" />Belajar
				<br />
				<input type="radio" name="soal7" value="c" /> Game
				<br />
				<input type="radio" name="soal7" value="d" /> Internet-an mencari informasi baru
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">8. </td>
			<td class="style4"> Tugas apa yang paling anda benci?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal8" value="a"  /> berhitung, serba menggunakan rumus
				<br />
				<input type="radio" name="soal8" value="b" /> mengarang
				<br />
				<input type="radio" name="soal8" value="c" />  menghafal 
				<br />
				<input type="radio" name="soal8" value="d" />  menciptakan sesuatu yang baru
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">9. </td>
			<td class="style4"> Apakah anda takut atau merasa kesulitan untuk berbicara di depan umum?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal9" value="a"  /> sangat takut
				<br />
				<input type="radio" name="soal9" value="b" /> tidak takut
				<br />
				<input type="radio" name="soal9" value="c" />  kadang-kadang
				<br />
				<input type="radio" name="soal9" value="d" />  awalnya saja, seterusnya tidak
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">10. </td>
			<td class="style4"> Manakah yang lebih menakutkan? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal10" value="a"  /> melihat ceceran darah
				<br />
				<input type="radio" name="soal10" value="b" /> berdebat dan mempertahankan pendapat
				<br />
				<input type="radio" name="soal10" value="c" />  ber-acting  
				<br />
				<input type="radio" name="soal10" value="d" />  presentasi didepan orang banyakwalnya saja, seterusnya tidak
			</td>
		</tr>
		<tr>
			<td colspan="2">
			</td>
		</tr>
	</table>
	<br>			
				<!-- -->
				
				Klik next untuk melihat hasil kuis peminatan.<br/><br/>
				<p align="left">
					<input type="hidden" name="username">
					<input class="btn btn-primary "type="submit" name="next" value="next">
				</form></p>
				</td>
			</tr>
			</table>
			</td>
			</tr>
	</table>
	</td>
	
</tr>
</body>
