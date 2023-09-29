<?php 
session_start();
  include "../lib/koneksi.php";
  $session_user = $_SESSION['user']; 
  $tampilpeserta = mysqli_query($mysqli, "SELECT Email, NISN, Nama, Nama_Jurusan, Jenis_Kelamin, Tanggal_Lahir, Alamat, Asal_Sekolah, Kuota, Nilai_UN, Nilai_Akhir FROM peserta p join jurusan j on p.Id_Jurusan = j.Id_Jurusan where No_Pendaftaran = '$session_user'");
  $peserta = mysqli_fetch_assoc($tampilpeserta);
  $tampilpeserta1 = mysqli_query($mysqli, "SELECT C2, C3, C4, C5, C6 FROM nilai where No_Pendaftaran = '$session_user'");
  $peserta1 = mysqli_fetch_assoc($tampilpeserta1);
  $tampilranking = mysqli_query($mysqli, "SELECT DISTINCT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, Ranking FROM (SELECT Id_Jurusan, No_Pendaftaran, Nama, Nilai_Akhir, @peserta:=CASE WHEN @jurusan <> Id_Jurusan THEN 1 ELSE @peserta+1 END AS Ranking, @jurusan:=Id_Jurusan AS Jurusan FROM(SELECT @peserta:= 0) AS P, (SELECT @Jurusan:= 0) AS J, (SELECT * FROM peserta GROUP BY Id_Jurusan, Nilai_Akhir ORDER BY Id_Jurusan, Nilai_Akhir DESC) AS temp) AS temp2 where No_Pendaftaran = '$session_user'");
  $ranking = mysqli_fetch_assoc($tampilranking);
  if(isset($_SESSION['user']))
  {
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bukti Pendaftaran <?php echo $session_user; echo $peserta['Nama']; ?></title>
</head>
<body>

	<center><br><br>
	<b><h2>
		<?php
			$sma = 'SMA NEGERI 1 MADANG SUKU II';
			$tp ='( TAHUN AJARAN '.date('Y').'-'.(date('Y') + 1).')';
			echo $sma;
			echo "<br>$tp</br>";
		?>
	</h2></b>
	<i><h4>
		<?php
			$jl = 'Jl. Raya Komering, Desa Kotanegara Kecamatan Madang Suku II';
			$kb = 'Kabupaten OKU Timur (Kode POS:32161)';
			echo $jl;
			echo "<br>$kb</br>";
		?>
	</h4></i>
	</center>
	<hr>
	<br/>

	<center>
		<h3>BUKTI HASIL PENJURUSAN PESERTA DIDIK</h3>
		<table border="0">
			<tr>
				<td>No Pendaftaran</td>
				<td>:</td>
				<td><?php echo $session_user; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><?php echo $peserta['Email']; ?></td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>:</td>
				<td><?php echo $peserta['NISN']; ?></td>
			</tr>
			<tr>
				<td>Jurusan Yang Dipilih</td>
				<td>:</td>
				<td><?php echo $peserta['Nama_Jurusan']; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $peserta['Nama']; ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<?php
                        if ($peserta['Jenis_Kelamin'] == 'L') {
                            echo "Laki-Laki";
                        }
                        else{
                            echo "Perempuan";
                        }
                    ?>
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<?php 
                        $originalDate = $peserta['Tanggal_Lahir'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        echo $newDate;
                    ?>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?php echo $peserta['Alamat']; ?></td>
			</tr>
			<tr>
				<td>Asal Sekolah</td>
				<td>:</td>
				<td><?php echo $peserta['Asal_Sekolah']; ?></td>
			</tr>
			<tr>
				<td>Nilai Rata UN</td>
				<td>:</td>
				<td><?php echo $peserta['Nilai_UN']; ?></td>
			</tr>
			<tr>
				<td>Nilai Rata IPA</td>
				<td>:</td>
				<td><?php echo $peserta1['C2']; ?></td>
			</tr>
			<tr>
				<td>Nilai Rata IPS</td>
				<td>:</td>
				<td><?php echo $peserta1['C3']; ?></td>
			</tr>
			<tr>
				<td>Nilai Psikotes</td>
				<td>:</td>
				<td><?php echo $peserta1['C4']; ?></td>
			</tr>
			<tr>
				<td>Nilai Minat IPA</td>
				<td>:</td>
				<td><?php echo $peserta1['C5']; ?></td>
			</tr>
			<tr>
				<td>Nilai Minat IPS</td>
				<td>:</td>
				<td><?php echo $peserta1['C6']; ?></td>
			</tr>
			<tr>
				<td>Nilai Akhir Perhitungan (SAW-TOPSIS)</td>
				<td>:</td>
				<td><?php echo $peserta['Nilai_Akhir']; ?></td>
			</tr>
			<tr>
				<td>Pernyataan</td>
				<td>:</td>
				<br>
			<td><?php 
                  if ($ranking['Ranking'] <= $peserta['Kuota']) {
                ?>
                Anda Lulus Di Jurusan <b> <?php echo $peserta['Nama_Jurusan']; ?> </b>
                <?php
                  }else{
                ?>
            	Anda Belum Direkomendasikan Untuk Memilih Jurusan <b><?php echo $peserta['Nama_Jurusan']; ?></b>
                <?php  
                  }
                ?>
			</td>
			</tr>
		</table>

	</center>
	<center><br><br>
	<i><h4>
		<?php
			$jl = 'Catatan**';
			$kb = 'Hasil masih bersifat sementara, keputusan mutlak berada di pihak sekolah';
			echo $jl;
			echo "<br>$kb</br>";
		?>
	</h4></i>
	</center>

	<script>
		window.print();
		window.location='../user';
		window.onafterprint=window.close();
	</script>
	
</body>
</html>

<?php 
	}
	else{
		header("location: ../login/");
	}
 ?>