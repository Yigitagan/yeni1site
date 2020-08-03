<?php
include "../baglanti.php";
include "headu.php";

if (isset($_POST['akaydet'])) {

		$kaydet=$db->prepare("UPDATE ayar SET
	    site_title=:site_title,
	    sunucu_ip=:sunucu_ip,
	    sunucu_isim=:sunucu_isim,
	    sayfalimit=:sayfalimit,
	    batihost_id=:batihost_id,
	    batihost_email=:batihost_email,
	    batihost_token=:batihost_token,
		descri=:descri,
		keyword=:keyword
	    WHERE ayar_id=0");
	    

	  $update=$kaydet->execute(array(
	    'site_title' => $_POST['site_title'],
	    'sunucu_ip' => $_POST['sunucu_ip'],
	    'sunucu_isim' => $_POST['sunucu_isim'],
	    'sayfalimit' => $_POST['sayfalimit'],
	    'batihost_id' => $_POST['batihost_id'],
	    'batihost_email' => $_POST['batihost_email'],
	    'batihost_token' => $_POST['batihost_token'],
		'descri' => $_POST['descri'],
		'keyword' => $_POST['keyword']
		));


	  if ($update) {
	  	echo "<script>alert('Ayarlar değiştirildi')</script>";
	    header("refresh: 0; url=ayarlar.php");

	  } else {
	  	echo "<script>alert('Ayarlar değiştirilemedi')</script>";
	    header("refresh: 0; url=ayarlar.php");
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
          <li class="breadcrumb-item active">Ayarlar</li>
        </ol>
<h2>Ayarlar</h2><br>
<center>
	<form method="POST">

                <div class="form-group">
                  <label>Site Title</label>
                  <input type="text" style="width: 200px" name="site_title" class="form-control" value="<?php echo $ayarcek['site_title']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Sunucu IP (IP adresiniz sayısal ve varsayılan 25565 portunu kullanmıyorsa "sayisalip:port" formatında yazınız.</label>
                  <input type="text" style="width: 200px" name="sunucu_ip" class="form-control" value="<?php echo $ayarcek['sunucu_ip']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Sunucu İsmi</label>
                  <input type="text" style="width: 200px" name="sunucu_isim" class="form-control" value="<?php echo $ayarcek['sunucu_isim']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Sayfa Başı Yazı Limiti (önerilen : 3)</label>
                  <input type="text" style="width: 200px" name="sayfalimit" class="form-control" value="<?php echo $ayarcek['sayfalimit']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Meta Keywords (Google da çıkmanız için anahtar kelimelerdir. "," ile ayırın.</label>
                  <input type="text" style="width: 200px" name="keyword" class="form-control" value="<?php echo $ayarcek['keyword']; ?>" >
                </div>

                <div class="form-group">
                  <label>Meta Description (Google da çıktığınızda gösterilecek site açıklamasıdır.</label>
                  <input type="text" style="width: 200px" name="descri" class="form-control" value="<?php echo $ayarcek['descri']; ?>" >
                </div>
                      
                <div class="form-group">
                  <label>Batihost Müşteri Id</label>
                  <input type="text" style="width: 200px" name="batihost_id" class="form-control" value="<?php echo $ayarcek['batihost_id']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Batihost Mail</label>
                  <input type="text" style="width: 200px" name="batihost_email" class="form-control" value="<?php echo $ayarcek['batihost_email']; ?>" required="required">
                </div>

                <div class="form-group">
                  <input type="hidden" style="width: 200px" name="batihost_token" class="form-control" value="<?php echo $ayarcek['batihost_token']; ?>" required="required">
                </div>

                <button type="submit" name="akaydet" class="btn btn-primary">Kaydet</button>
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
