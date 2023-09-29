<?php

include "../../lib/koneksi.php";

$id_jurusan=$_GET['id_jurusan'];
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
    header("Content-Disposition: attachment; filename=Laporan_Pendaftar_Semua_Jurusan.xls");
// Tambahkan table

?>
<table border="1">
<thead>
<tr>
    <th>No Pendaftaran</th>
    <th>NISN</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Email</th>
    <th>Asal Sekolah</th>
    <th>Jurusan Yang Dipilih</th>
    <th>Nilai UN</th>
    <th>Rata IPA</th>
    <th>Rata IPS</th>
    <th>Psikotes</th>
    <th>Minat IPS</th>
    <th>Minat IPA</th>
    <th>Nilai Perhitungan Akhir</th>
</tr>
</thead>
<tbody>

    
    <?php 
    $rank = 0;
    $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, NISN,  Nama, Jenis_Kelamin, Email, Asal_Sekolah, Nama_Jurusan, Nilai_Akhir, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran ORDER BY No_Pendaftaran");
    while($peserta = mysqli_fetch_array($tampilpeserta))
    {
        $rank = $rank + 1;
?>

<tr>
    <td><?php echo $peserta['No_Pendaftaran']; ?></td>
    <td><?php echo $peserta['NISN']; ?></td>
    <td><?php echo $peserta['Nama']; ?></td>
    <td><?php echo $peserta['Jenis_Kelamin']; ?></td>
    <td><?php echo $peserta['Email']; ?></td>
    <td><?php echo $peserta['Asal_Sekolah']; ?></td>
    <td><?php echo $peserta['Nama_Jurusan']; ?></td>
    <td><?php echo $peserta['C1']; ?></td>
    <td><?php echo $peserta['C2']; ?></td>
    <td><?php echo $peserta['C3']; ?></td>
    <td><?php echo $peserta['C4']; ?></td>
    <td><?php echo $peserta['C5']; ?></td>
    <td><?php echo $peserta['C6']; ?></td>
    <td><?php echo $peserta['Nilai_Akhir']; ?></td>
    
</tr>
<?php 
    }
?>
</tbody>
</table>