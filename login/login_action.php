<?php 
    include "../lib/koneksi.php"; 
    $user = $_POST['NISN'];
    $pass = $_POST['password'];

    if (!ctype_alnum($pass)) {
        echo "<center>LOGIN GAGAL! <br> 
            email atau Password Anda tidak benar.<br>
            Atau account Anda sedang diblokir.<br>";
        echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
    } else {
        $sql = mysqli_query($mysqli,"SELECT * FROM peserta WHERE NISN = '$user' AND Password = '$pass'");
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);
        if($cek >= 1)
        {
            session_start();
            @$_SESSION['user'] = $data['No_Pendaftaran'];
            header("location:../user/");
        }
        else
        {
            echo "<script>alert('Login gagal!'); window.location = 'index.php'; </script>";
        }
    }
?>