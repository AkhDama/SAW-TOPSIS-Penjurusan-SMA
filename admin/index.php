<?php 
session_start();
  include "../lib/koneksi.php";
  if(isset($_SESSION['admin']))
  {
    echo "<script>window.location = '../admin/dashboard'; </script>";
  }
  else
  {
    header("location: login/");
  } 
?>