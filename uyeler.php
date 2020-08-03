<?php
include "../baglanti.php";
include "headu.php";
if (isset($_POST['ksil'])) {

  $sil=$db->prepare("DELETE from authme where id=:id");
  $kontrol=$sil->execute(array('id' => $_POST['kid']));
  if ($kontrol) {
    header("refresh: 0; url=uyeler.php");
  } else {
    echo "<script>alert('Kullanıcı silinemedi')</script>";
    header("refresh: 0; url=uyeler.php");
  }
}
if ($_GET['yetkid']=="ok") {

  
  $duzenle=$db->prepare("UPDATE authme SET yetki=:yetki WHERE id=:id");
  $update=$duzenle->execute(array('yetki' => $_GET['yetki'], 'id' => $_GET['id']));

  if ($update) {
    echo "<script>alert('Kullanıcının başarıyla yetkisi değiştirildi')</script>";
    header("refresh: 0; url=uyeler.php");
  } else {
    echo "<script>alert('Kullanıcının yetkisi değiştirilemedi')</script>";
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
          <li class="breadcrumb-item active">Üyeler</li>
        </ol>
<h2>Üyeler</h2><br><a href="uye-ekle.php"><button type="submit" name="uekle" class="btn btn-success pull-right">Ekle +</button></a><br><br>

<div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kullanıcı Adı</th>
                    <th>Kredi</th>
                    <th>Yetki</th>
                    <th>İşlemler</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Kullanıcı Adı</th>
                    <th>Kredi</th>
                    <th>Yetki</th>
                    <th>İşlemler</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                $kullanicisor=$db->prepare("SELECT * FROM authme order by yetki DESC");
        $kullanicisor->execute();
        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kullanicicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kullanicicek['username']; ?></center></td>
                  <td><center><?php echo $kullanicicek['kredi']; ?></center></td>
                  <td><center><?php if ($kullanicicek['yetki']) { echo "Admin"; }else{ echo "Üye"; } ?></center></td>
                  <td>
                    <a href="uye-duzenle.php?id=<?php echo $kullanicicek['id']; ?>"><button type="button" class="btn btn-xs btn-primary">Düzenle</button></a>
                    <?php if ($kullanicicek['yetki']) {?>

                    <a href="uyeler.php?id=<?php echo $kullanicicek['id'] ?>&yetki=0&yetkid=ok"><button class="btn btn-xs btn-warning">Üye yap</button></a>

                    <?php }else{ ?>

          <a href="uyeler.php?id=<?php echo $kullanicicek['id'] ?>&yetki=1&yetkid=ok"><button class="btn btn-xs btn-success">Admin yap</button></a>

          <?php } ?>
          <form method="POST">
            <input type="hidden" name="kid" value="<?php echo $kullanicicek['id']; ?>">
            <button type="submit" name="ksil" class="btn btn-xs btn-danger" onclick="return ShowConfirm();">Sil</button>
                    </form>
                  </td>
                </tr>

              <?php } ?>

                </tbody>
              </table>
 </div>
          </div>
 



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
