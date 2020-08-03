<?php
include "../baglanti.php";
include "headu.php";
if (isset($_POST['kekle'])) {

  $pass=md5($_POST['password']);

  $kaydet=$db->prepare("INSERT INTO authme SET username=:username, password=:password, kredi=:kredi, yetki=:yetki");

  $insert=$kaydet->execute(array('username' => $_POST['username'], 'password' => $pass, 'kredi' => $_POST['kredi'], 'yetki' => $_POST['yetki']));


  if ($insert) {
      echo "<script>alert('Kullanıcının eklendi')</script>";
      header("refresh: 0; url=uyeler.php");

  } else {
      echo "<script>alert('Kullanıcının eklenemedi')</script>";
      header("refresh: 0; url=uyeler.php");
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MyCraft - Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">My<b>Craft</b></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Çıkış Yap</a>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="cikis.php" data-toggle="modal">Çıkış Yap</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

 <?php include "sidebar.php"; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Panel</a>
          </li>
          <li class="breadcrumb-item active">Üye Ekle</li>
        </ol>
        
<h2>Üye Ekle</h2><br>
<center>
<form method="POST">
                <div class="form-group">
                  <label>Kullanıcı adı</label>
                  <input type="text" style="width: 200px" name="username" class="form-control" placeholder="Kullanıcı adı giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Şifre</label>
                  <input type="password" style="width: 200px" name="password" class="form-control" placeholder="Şifre giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Kredi</label>
                  <input type="number" style="width: 200px" value="0" min="0" max="500" name="kredi" class="form-control" required="required">
                </div>

                <div class="form-group">
                  <label>Yetki</label>
                  <select name="yetki" class="form-control" style="width: 200px">
                    <option value="0" selected>Üye</option>
                    <option value="1">Admin</option>
					<option value="2">Cezalı</option>
                  </select>
                </div>

                <button type="submit" name="kekle" class="btn btn-primary">Kaydet</button>
              </form>
 </center>



      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> © MyCraft</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
