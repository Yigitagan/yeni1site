<?php
include "../baglanti.php";
include "headu.php";
$kullanicisor=$db->prepare("SELECT * FROM authme where id=:id");
$kullanicisor->execute(array('id' => $_GET['id']));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['kkaydet'])) {

  $id=$_POST['id'];
  if ($_POST['sifre'] == null) {

	  $kullanicikaydet=$db->prepare("UPDATE authme SET
	    username=:username,
	    kredi=:kredi,
	    yetki=:yetki
	    WHERE id=:id");

	  $update=$kullanicikaydet->execute(array(
	    'username' => $_POST['kadi'],
	    'kredi' => $_POST['kredi'],
	    'yetki' => $_POST['yetki'],
	    'id' => $id));


	  if ($update) {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirildi')</script>";
	    header("refresh: 0; url=uyeler.php");

	  } else {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirilemedi')</script>";
	    header("refresh: 0; url=uyeler.php");
	  }
  }
  else
  {
  		$pass=md5($_POST['sifre']);
  		$kullanicikaydet=$db->prepare("UPDATE authme SET
	    username=:username,
	    password=:password,
	    kredi=:kredi,
	    yetki=:yetki
	    WHERE id=:id");

	  $update=$kullanicikaydet->execute(array(
	    'username' => $_POST['kadi'],
	    'password' => $pass,
	    'kredi' => $_POST['kredi'],
	    'yetki' => $_POST['yetki'],
	    'id' => $id));


	  if ($update) {
	  	echo "<script>alert('Kullanıcıyı Düzenleme Başarılı')</script>";
	    header("refresh: 0; url=uyeler.php");

	  } else {
	  	echo "<script>alert('Opss! Kullanıcının Düzenlenemedi')</script>";
	    header("refresh: 0; url=uyeler.php");
	  }
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
          <li class="breadcrumb-item active">Üye Düzenle</li>
        </ol>
        
<h2>Üye Düzenle</h2><br>
<center>
<div class="col-md-6">
  <form method="POST">
                <div class="form-group">
                  <label>Kullanıcı adı</label>
                  <input type="text" style="width: 200px" name="kadi" class="form-control" value="<?php echo $kullanicicek['username']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Şifre</label>
                  <input type="password" style="width: 200px" name="sifre" class="form-control">
                </div>

                <div class="form-group">
                  <label>Kredi</label>
                  <input type="number" style="width: 200px" min="0" max="500" name="kredi" class="form-control" value="<?php echo $kullanicicek['kredi']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Yetki</label>
                  <select name="yetki" class="form-control" style="width: 200px">
                    <option value="0" <?php if ($kullanicicek['yetki']=='0') { echo "selected"; } ?>>Üye</option>
                    <option value="1" <?php if ($kullanicicek['yetki']=='1') { echo "selected"; } ?>>Admin</option>
					<option value="1" <?php if ($kullanicicek['yetki']=='2') { echo "selected"; } ?>>Cezalı</option>
					<option value="1" <?php if ($kullanicicek['yetki']=='3') { echo "selected"; } ?>>Onaylı Satıcı</option>
                  </select>
                      
                </div>
                <input type="hidden" name="id" value="<?php echo $kullanicicek['id'] ?>">
                <button type="submit" name="kkaydet" class="btn btn-primary">Kaydet</button>
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
