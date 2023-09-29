<?php 
session_start();
  include "../../lib/koneksi.php";
  $id_jurusan=$_GET['id_jurusan'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    $tampilmax = mysqli_query($mysqli, "SELECT MAX(C1) as maxC1, MAX(C2) as maxC2, MAX(C3) as maxC3, MAX(C4) as maxC4, MAX(C5) as maxC5, MAX(C6) as maxC6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
    $maksimal = mysqli_fetch_assoc($tampilmax);

    $i=1;
    $tampilbobot = mysqli_query($mysqli, "SELECT Bobot from kriteria");
    while($bobot_kriteria = mysqli_fetch_assoc($tampilbobot))
    {
      $bobot[$i] = $bobot_kriteria['Bobot'];
      $i++;
    }

    $a=1;
    $tampilbobot2 = mysqli_query($mysqli, "SELECT Bobot from kriteria2");
    while($bobot_kriteria2 = mysqli_fetch_assoc($tampilbobot2))
    {
      $bobot2[$a] = $bobot_kriteria2['Bobot'];
      $a++;
    }

    $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
    while($peserta = mysqli_fetch_array($tampilpeserta))
    {
      $nomor = $peserta['No_Pendaftaran'];
      $normalC1 = round($peserta['C1'] / $maksimal['maxC1'],6);
      $normalC2 = round($peserta['C2'] / $maksimal['maxC2'],6);
      $normalC3 = round($peserta['C3'] / $maksimal['maxC3'],6);
      $normalC4 = round($peserta['C4'] / $maksimal['maxC4'],6);
      $normalC5 = round($peserta['C5'] / $maksimal['maxC5'],6);
      $normalC6 = round($peserta['C6'] / $maksimal['maxC6'],6);

      $simpan = mysqli_query($mysqli, "UPDATE normalisasi SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5, C6=$normalC6 where No_Pendaftaran = '$nomor'");
      }

      $paC1=0;$paC2=0;$paC3=0;$paC4=0;$paC5=0;$paC6=0;
      $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
      while($peserta = mysqli_fetch_array($tampilpeserta))
    {
      $paC1++;$paC2++;$paC3++;$paC4++;$paC5++;$paC6++;
      $nomor = $peserta['No_Pendaftaran'];
      $total1 [$paC1] = round(pow($peserta['C1'],2),6);
      $total2 [$paC2] = round(pow($peserta['C2'],2),6);
      $total3 [$paC3] = round(pow($peserta['C3'],2),6);
      $total4 [$paC4] = round(pow($peserta['C4'],2),6);
      $total5 [$paC5] = round(pow($peserta['C5'],2),6);
      $total6 [$paC6] = round(pow($peserta['C6'],2),6);
      
      $SqpaC1 = round(sqrt(array_sum($total1)),6);
      $SqpaC2 = round(sqrt(array_sum($total2)),6);
      $SqpaC3 = round(sqrt(array_sum($total3)),6);
      $SqpaC4 = round(sqrt(array_sum($total4)),6);
      $SqpaC5 = round(sqrt(array_sum($total5)),6);
      $SqpaC6 = round(sqrt(array_sum($total6)),6);
      
      // $normalC1 = round($peserta['C1'] / $SqpaC1,6);
      // $normalC2 = round($peserta['C2'] / $SqpaC2,6);
      // $normalC3 = round($peserta['C3'] / $SqpaC3,6);
      // $normalC4 = round($peserta['C4'] / $SqpaC4,6);
      // $normalC5 = round($peserta['C5'] / $SqpaC5,6);
      // $normalC6 = round($peserta['C6'] / $SqpaC6,6);

      // $simpan = mysqli_query($mysqli, "UPDATE normalisasi_matriks SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5, C6=$normalC6 where No_Pendaftaran = '$nomor'");
    
      // $akhir = round(($normalC1 * $bobot[1]) + ($normalC2 * $bobot[2]) + ($normalC3 * $bobot[3]) + ($normalC4 * $bobot[4]) + ($normalC5 * $bobot[5]) + ($normalC6 * $bobot[6]),6);
      // $simpan_nilai = mysqli_query($mysqli, "UPDATE peserta SET Nilai_Akhir = $akhir where No_Pendaftaran = '$nomor'");
    }
    
      // $paC1=0;$paC2=0;$paC3=0;$paC4=0;$paC5=0;$paC6=0;
      // $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
      // while($peserta = mysqli_fetch_array($tampilpeserta))
    // {
    //   $nomor = $peserta['No_Pendaftaran'];
    //   $paC1 = round($paC1+pow($peserta['C1'],2),6);
    //   $paC2 = round($paC2+pow($peserta['C2'],2),6);
    //   $paC3 = round($paC3+pow($peserta['C3'],2),6);
    //   $paC4 = round($paC4+pow($peserta['C4'],2),6);
    //   $paC5 = round($paC5+pow($peserta['C5'],2),6);
    //   $paC6 = round($paC6+pow($peserta['C6'],2),6);
      
    //   // $SqpaC1 = array_sum($peserta['C1']);
    //   // $SqpaC2 = array_sum($peserta['C2']);
    //   // $SqpaC3 = array_sum($peserta['C3']);
    //   // $SqpaC4 = array_sum($peserta['C4']);
    //   // $SqpaC5 = array_sum($peserta['C5']);
    //   // $SqpaC6 = array_sum($peserta['C6']);
     
    //   $normalC1 = round($peserta['C1'] / sqrt($paC1),6);
    //   $normalC2 = round($peserta['C2'] / sqrt($paC2),6);
    //   $normalC3 = round($peserta['C3'] / sqrt($paC3),6);
    //   $normalC4 = round($peserta['C4'] / sqrt($paC4),6);
    //   $normalC5 = round($peserta['C5'] / sqrt($paC5),6);
    //   $normalC6 = round($peserta['C6'] / sqrt($paC6),6);

    //   $simpan = mysqli_query($mysqli, "UPDATE normalisasi_matriks SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5, C6=$normalC6 where No_Pendaftaran = '$nomor'");
    
    //   $akhir = round(($normalC1 * $bobot[1]) + ($normalC2 * $bobot[2]) + ($normalC3 * $bobot[3]) + ($normalC4 * $bobot[4]) + ($normalC5 * $bobot[5]) + ($normalC6 * $bobot[6]),6);
    //   $simpan_nilai = mysqli_query($mysqli, "UPDATE peserta SET Nilai_Akhir = $akhir where No_Pendaftaran = '$nomor'");
    // }

    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <?php 
          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jurusan where Id_Jurusan = $id_jurusan");
          $jurusan = mysqli_fetch_assoc($tampiljurusan);
        ?>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../normalisasi">Normalisasi</a></li>
          <li class="breadcrumb-item active"><?php echo $jurusan['Nama_Jurusan']; ?></li>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Normalisasi <?php echo $jurusan['Nama_Jurusan']; ?></div>
                  <div class="card-body">
                    <h3>Perhitungan SAW</h3>
                    <h3>Nilai Alternatif Kriteria</h3>
                    <table class="table table-responsive-sm table-primary" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['C1']; ?></td>
                          <td><?php echo $peserta['C2']; ?></td>
                          <td><?php echo $peserta['C3']; ?></td>
                          <td><?php echo $peserta['C4']; ?></td>
                          <td><?php echo $peserta['C5']; ?></td>
                          <td><?php echo $peserta['C6']; ?></td>
                        </tr>
                        <?php 
                          }
                        ?>
                      </tbody>
                      </table>
                    <h3>Nilai Normalisasi R</h3>
                    <table class="table table-responsive-sm table-warning" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php  
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['C1']; ?></td>
                          <td><?php echo $peserta['C2']; ?></td>
                          <td><?php echo $peserta['C3']; ?></td>
                          <td><?php echo $peserta['C4']; ?></td>
                          <td><?php echo $peserta['C5']; ?></td>
                          <td><?php echo $peserta['C6']; ?></td>
                        </tr>
                        <?php 
                          }
                        ?>
                        <tr>
                          <td>Akar Hasil Pangkat</td>
                          <td>=====></td>
                          <td><?php echo $SqpaC1; ?></td>
                          <td><?php echo $SqpaC2; ?></td>
                          <td><?php echo $SqpaC3; ?></td>
                          <td><?php echo $SqpaC4; ?></td>
                          <td><?php echo $SqpaC5; ?></td>
                          <td><?php echo $SqpaC6; ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <h3>Perhitungan TOPSIS</h3>
                    <h3>Matriks Ternormalisasi TOPSIS</h3>
                    <table class="table table-responsive-sm table-success" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php  
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo round($peserta['C1']/$SqpaC1,6); ?></td>
                          <td><?php echo round($peserta['C2']/$SqpaC2,6); ?></td>
                          <td><?php echo round($peserta['C3']/$SqpaC3,6); ?></td>
                          <td><?php echo round($peserta['C4']/$SqpaC4,6); ?></td>
                          <td><?php echo round($peserta['C5']/$SqpaC5,6); ?></td>
                          <td><?php echo round($peserta['C6']/$SqpaC6,6); ?></td>
                        </tr>
                        <?php 
                          }
                        ?>
                      </tbody>
                    </table>
                    <h3>Bobot Kriteria</h3>
                    <table class="table table-responsive-sm table-secondary" style="margin-top: 20px">
                      <thead>
                        <tr>
                        <?php
                        if($id_jurusan==1){
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Nama_Kriteria'];?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                        <tr>
                        <?php
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Bobot'];?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                        <tr>
                        <?php
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Keterangan'];?></th>
                          <?php 
                            } 
                          }
                          ?>
                          <?php
                        if($id_jurusan==2){
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria2");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Nama_Kriteria'];?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                        <tr>
                        <?php
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria2");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Bobot'];?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                        <tr>
                        <?php
                          $tampilkriteria = mysqli_query($mysqli, "SELECT * from kriteria2");
                          while($kriteria = mysqli_fetch_array($tampilkriteria))
                          {
                        ?>
                        <th><?php echo$kriteria['Keterangan'];?></th>
                          <?php 
                            } 
                          }
                          ?>
                        </tr>
                      </tbody>
                    </table>
                    <h3>Bobot Ternormalisasi TOPSIS</h3>
                    <table class="table table-responsive-sm table-danger" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php  
                          if ($id_jurusan==1){
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php $nomor=$peserta['No_Pendaftaran'];
                          echo $nomor; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php $normalC1=round($peserta['C1']/$SqpaC1*$bobot['1'],6);
                          echo $normalC1; ?></td>
                          <td><?php $normalC2=round($peserta['C2']/$SqpaC2*$bobot['2'],6);
                          echo $normalC2; ?></td>
                          <td><?php $normalC3=round($peserta['C3']/$SqpaC3*$bobot['3'],6);
                          echo $normalC3; ?></td>
                          <td><?php $normalC4=round($peserta['C4']/$SqpaC4*$bobot['4'],6);
                          echo $normalC4; ?></td>
                          <td><?php $normalC5=round($peserta['C5']/$SqpaC5*$bobot['5'],6);
                          echo $normalC5; ?></td>
                          <td><?php $normalC6=round($peserta['C6']/$SqpaC6*$bobot['6'],6);
                          echo $normalC6; ?></td>
                        </tr>
                        <?php
                         $simpan = mysqli_query($mysqli, "UPDATE normalisasi_matriks SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5, C6=$normalC6 where No_Pendaftaran = '$nomor'");
                        }
                      }
                      ?>
                       <?php  
                          if ($id_jurusan==2){
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria2");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php $nomor=$peserta['No_Pendaftaran'];
                          echo $nomor; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php $normalC1=round($peserta['C1']/$SqpaC1*$bobot2['1'],6);
                          echo $normalC1; ?></td>
                          <td><?php $normalC2=round($peserta['C2']/$SqpaC2*$bobot2['2'],6);
                          echo $normalC2; ?></td>
                          <td><?php $normalC3=round($peserta['C3']/$SqpaC3*$bobot2['3'],6);
                          echo $normalC3; ?></td>
                          <td><?php $normalC4=round($peserta['C4']/$SqpaC4*$bobot2['4'],6);
                          echo $normalC4; ?></td>
                          <td><?php $normalC5=round($peserta['C5']/$SqpaC5*$bobot2['5'],6);
                          echo $normalC5; ?></td>
                          <td><?php $normalC6=round($peserta['C6']/$SqpaC6*$bobot2['6'],6);
                          echo $normalC6; ?></td>
                        </tr>
                        <?php
                        $simpan = mysqli_query($mysqli, "UPDATE normalisasi_matriks SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5, C6=$normalC6 where No_Pendaftaran = '$nomor'");
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                    <h3>Nilai Solusi A(+) dan A(-) TOPSIS</h3>
                    <table class="table table-responsive-sm table-secondary" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Keterangan</th>
                          
                          <?php  
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $tampilmax2 = mysqli_query($mysqli, "SELECT MAX(C1) as maxC1, MAX(C2) as maxC2, MAX(C3) as maxC3, MAX(C4) as maxC4, MAX(C5) as maxC5, MAX(C6) as maxC6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi_matriks n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                       $maksimal2 = mysqli_fetch_assoc($tampilmax2);
                       $tampilmin2 = mysqli_query($mysqli, "SELECT MIN(C1) as minC1, MIN(C2) as minC2, MIN(C3) as minC3, MIN(C4) as minC4, MIN(C5) as minC5, MIN(C6) as minC6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi_matriks n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                       $minimum2 = mysqli_fetch_assoc($tampilmin2);
                          {
                            $nmaxC1 = round($maksimal2['maxC1'],6);
                            $nmaxC2 = round($maksimal2['maxC2'],6);
                            $nmaxC3 = round($maksimal2['maxC3'],6);
                            $nmaxC4 = round($maksimal2['maxC4'],6);
                            $nmaxC5 = round($maksimal2['maxC5'],6);
                            $nmaxC6 = round($maksimal2['maxC6'],6);
                            $nminC1 = round($minimum2['minC1'],6);
                            $nminC2 = round($minimum2['minC2'],6);
                            $nminC3 = round($minimum2['minC3'],6);
                            $nminC4 = round($minimum2['minC4'],6);
                            $nminC5 = round($minimum2['minC5'],6);
                            $nminC6 = round($minimum2['minC6'],6);
                        ?>
                        <?php
                        }
                        ?>
                        <tr>
                          <td>Solusi A(+)</td>
                          <td><?php echo $nmaxC1; ?></td>
                          <td><?php echo $nmaxC2; ?></td>
                          <td><?php echo $nmaxC3; ?></td>
                          <td><?php echo $nmaxC4; ?></td>
                          <td><?php echo $nmaxC5; ?></td>
                          <td><?php echo $nmaxC6; ?></td>
                        </tr>
                        <tr>
                          <td>Solusi A(-)</td>
                          <td><?php echo $nminC1; ?></td>
                          <td><?php echo $nminC2; ?></td>
                          <td><?php echo $nminC3; ?></td>
                          <td><?php echo $nminC4; ?></td>
                          <td><?php echo $nminC5; ?></td>
                          <td><?php echo $nminC6; ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <h3>Solusi D(+) dan D(-) TOPSIS</h3>
                    <table class="table table-responsive-sm table-info" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Jarak Solusi D(+)</th>
                          <th>Jarak Solusi D(-)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi_matriks n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                        {
                         
                          $total1  = round(pow($peserta['C1']-$nmaxC1,2),6);
                          $total2  = round(pow($peserta['C2']-$nmaxC2,2),6);
                          $total3  = round(pow($peserta['C3']-$nmaxC3,2),6);
                          $total4  = round(pow($peserta['C4']-$nmaxC4,2),6);
                          $total5  = round(pow($peserta['C5']-$nmaxC5,2),6);
                          $total6  = round(pow($peserta['C6']-$nmaxC6,2),6);
                          $total7  = round(pow($peserta['C1']-$nminC1,2),6);
                          $total8  = round(pow($peserta['C2']-$nminC2,2),6);
                          $total9  = round(pow($peserta['C3']-$nminC3,2),6);
                          $total10 = round(pow($peserta['C4']-$nminC4,2),6);
                          $total11 = round(pow($peserta['C5']-$nminC5,2),6);
                          $total12 = round(pow($peserta['C6']-$nminC6,2),6);
                          
                          $Sqjrkplus = round(sqrt($total1+$total2+$total3+$total4+$total5+$total6),6);
                          $Sqjrkmin = round(sqrt($total7+$total8+$total9+$total10+$total11+$total12),6);
                        ?>
                        <tr>
                         <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $Sqjrkplus; ?></td>
                          <td><?php echo $Sqjrkmin; ?></td>
                        </tr>
                        <?php 
                          }
                        ?>
                      </tbody>
                      </table>
                      <h3>Vi = Di(-) + Di(+) TOPSIS</h3>
                    <table class="table table-responsive-sm table-secondary" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Vi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5, C6 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi_matriks n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                        {
                          $nomor=$peserta['No_Pendaftaran'];
                          $total1  = round(pow($peserta['C1']-$nmaxC1,2),6);
                          $total2  = round(pow($peserta['C2']-$nmaxC2,2),6);
                          $total3  = round(pow($peserta['C3']-$nmaxC3,2),6);
                          $total4  = round(pow($peserta['C4']-$nmaxC4,2),6);
                          $total5  = round(pow($peserta['C5']-$nmaxC5,2),6);
                          $total6  = round(pow($peserta['C6']-$nmaxC6,2),6);
                          $total7  = round(pow($peserta['C1']-$nminC1,2),6);
                          $total8  = round(pow($peserta['C2']-$nminC2,2),6);
                          $total9  = round(pow($peserta['C3']-$nminC3,2),6);
                          $total10 = round(pow($peserta['C4']-$nminC4,2),6);
                          $total11 = round(pow($peserta['C5']-$nminC5,2),6);
                          $total12 = round(pow($peserta['C6']-$nminC6,2),6);
                          
                          $Sqjrkplus = round(sqrt($total1+$total2+$total3+$total4+$total5+$total6),6);
                          $Sqjrkmin = round(sqrt($total7+$total8+$total9+$total10+$total11+$total12),6);
                        ?>
                        <tr>
                         <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php $tot=$Sqjrkmin+$Sqjrkplus;
                          echo $tot;?></td>
                        </tr>
                        <?php 
                        $akhir = round($Sqjrkmin/$tot,6);
                        $simpan_nilai = mysqli_query($mysqli, "UPDATE peserta SET Nilai_Akhir = $akhir where No_Pendaftaran = '$nomor'");
                        }
                        ?>
                      </tbody>
                      </table>
                    <h3>Nilai Preferensi dan Perangkingan</h3>
                    <div class="col-md-6">
                    <table class="table table-responsive-sm table-success" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Ranking</th>
                          <th>No Pendaftaran</th>
                          <th>Nama</th>
                          <th>Nilai Preferensi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                        $rank = 0;
                        $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan where p.Id_Jurusan = $id_jurusan ORDER BY Nilai_Akhir DESC");
                        while($peserta = mysqli_fetch_array($tampilpeserta))
                        {
                        $rank = $rank + 1;
                        
                        ?>
                        <tr>
                          <td><?php echo $rank; ?></td>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['Nilai_Akhir']; ?></td>
                        </tr>
                        <?php 
                        
                          }
                        ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
          </div>
        </div>
      </main>
<?php
    include "../template/footer.php";
  }
  else
  {
    header("location: ../login/");
  } 
?>
