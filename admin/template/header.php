<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.5
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>SPK-Penjurusan SMA IDAMAN</title>
    <!-- Icons-->
    <link href="../asset/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="../asset/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../asset/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="../asset/css/style.css" rel="stylesheet">
    <link href="../asset/css/custom.css" rel="stylesheet">
    <link href="../asset/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="../asset/img/brand/logo.png" width="60" height="50" alt="LogoSMA">
        <img class="navbar-brand-minimized" src="../asset/img/brand/logo.png" width="50" height="50" alt="LogoSMA">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav ml-auto">
        <?php  
          $tampiladmin = mysqli_query($mysqli, "SELECT * FROM admin WHERE Id_Admin = '$session_admin'");
          $adm = mysqli_fetch_assoc($tampiladmin);
        ?>
        <li class="nav-item d-md-down-none nama_admin">
          Halo, <?php echo $adm['Nama']; ?>
        </li>
        <li class="nav-item dropdown" style="margin-right: 25px">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="../asset/img/avatars/no-profile-picture.png" alt="admin@bootstrapmaster.com">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Account</strong>
            </div>
            <a class="dropdown-item" href="../akun/edit_akun.php">
              <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="../logout_admin.php">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="../dashboard">
                <i class="nav-icon icon-speedometer"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../pengguna">
                <i class="nav-icon icon-user"></i> Data Pengguna
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jurusan">
                <i class="nav-icon icon-graduation"></i> Data Jurusan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jadwal">
                <i class="nav-icon icon-calendar"></i> Jadwal Tes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../kriteria">
                <i class="nav-icon icon-list"></i> Data Kriteria IPA
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../kriteria2">
                <i class="nav-icon icon-list"></i> Data Kriteria IPS
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../peserta">
                <i class="nav-icon icon-people"></i> Data Peserta
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../nilai">
                <i class="nav-icon icon-pencil"></i> Data Nilai
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../normalisasi">
                <i class="nav-icon icon-calculator"></i> Normalisasi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../laporan">
                <i class="nav-icon icon-doc"></i> Laporan
              </a>
            </li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>