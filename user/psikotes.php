<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$username = $_SESSION['user'];
$uri = explode('/',  $_SERVER['PHP_SELF']);
if (isset($_SESSION['have_minat'])) {
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

<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="page-header">
            <h4>Silahkan masukkan profil siswa!</h4>
        </div>
<?php
            $status = (isset($_GET['status']) ? $_GET['status'] : '');
        ?>
                                <table>
                                    <tr>
                                        <td width="40px" align="right" >&nbsp;</td>
                                        <td class="style4">Menurut hasil psikotes yang telah Anda ikuti, <br/>
                                        <?php
                                                include("connect_spk.php");
                                                $strquery = "select C4 from nilai where No_Pendaftaran='$username'";
                                                $query = mysql_query($strquery);
                                                $hsl   = mysql_fetch_assoc($query);
                                                mysql_close($conn);
                                        ?>
                                        <br/>
                                        Nilai Psikotes anda :
                                    <ul>
                                        <table>
                                            <tr><td class="style4"><li>PSIKOTES</li></td><td>:</td><td class="style4"><?php echo $hsl['C4'];?></td></tr>
                                        </table>
                                    </ul>
                                    <br/>
                                    Klik next untuk melanjutkan.<br/><br/>
                                    <p align="center">
                                    <form action="minat.php" method="post">
                                            <input type="hidden" name="username">
                                            <input type="submit" name="next" value="next">
                                    </form></p>
                                    </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
