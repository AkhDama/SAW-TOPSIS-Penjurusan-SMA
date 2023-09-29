<?php 
    include "../../lib/koneksi.php"; 
    $admin = $_POST['username'];
    $pass = $_POST['password'];

    if (!ctype_alnum($admin) OR !ctype_alnum($pass)) {
        echo "<center>LOGIN GAGAL! <br> 
            Username atau Password Anda tidak benar.<br>
            Atau account Anda sedang diblokir.<br>";
        echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
    } else {
        $sql = mysqli_query($mysqli,"SELECT * FROM admin WHERE username = '$admin' AND password = '$pass'");
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);
        if($cek >= 1)
        {
            session_start();
            @$_SESSION['admin'] = $data['Id_Admin'];
            header("location:../../admin/dashboard");
        }
        else
        {
            echo "<script>alert('Login gagal!'); window.location = 'index.php'; </script>";
        }
    }
?>