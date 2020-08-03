<?php
include "../baglanti.php";
include '../ayar.php';
include "headu.php";

if (isset($_POST['ksil'])) {

  $sil=$db->prepare("DELETE from yazilar where id=:id");
  $kontrol=$sil->execute(array('id' => $_POST['kid']));
  if ($kontrol) {
    header("refresh: 0; url=yazilar.php");
  } else {
    echo "<script>alert('Yazi silinemedi')</script>";
    header("refresh: 0; url=yazilar.php");
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
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
          <li class="breadcrumb-item active">Yazı Düzenle</li>
        </ol>
<h2>Yazı Düzenle</h2><br>
<?php
      
      $baslik=$_POST["baslik"];
      $yazar=$_POST["yazar"];
      $yazi=$_POST["icerik"];
      $kategori=$_POST["kategori"];
      $yazi_duzenle = $db->prepare("SELECT * FROM yazilar WHERE id = ?");
      $yazi_duzenle->execute(array($_GET['id']));
      $oku = $yazi_duzenle->fetch();
      
      if(isset($_POST['yazi-duzenle'])){
        $yazi_query = $db->prepare("UPDATE yazilar SET baslik = ?, yazar = ?, yazi = ?, kategori = ? WHERE id = ?");
        $update = $yazi_query->execute(array($baslik,$yazar,$yazi,$kategori,$_GET['id']));
        echo '<div class="alert bg-success" role="alert"> Duyuru yazısı başarıyla düzenlendi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
        echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
      }
        
        
      ?>
      <form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Başlık:</td>
                                    <td><input required name="baslik" value="<?php echo $oku['baslik']; ?>" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Kategori:</td>
                                    <td><select required name="kategori" value="<?php echo $oku['kategori']; ?>" class="form-control">
                        <option value="Duyuru">Duyuru</option>
                        <option value="Bilgi">Bilgi</option>
                        <option value="Uyarı">Uyarı</option>
                        <option value="Güncelleme">Güncelleme</option>
                    </select></td>
                                </tr>
                                <tr>
                                    <td>Yazar:</td>
                                    <td><input required name="yazar" value="<?php echo $oku['yazar']; ?>" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>İçerik:</td>
                                    <td>
                        <textarea required name='icerik' id="editor1" rows="5" type="text" class="form-control"><?php echo $oku['yazi']; ?></textarea></td>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button src="/yazilar.php" name="yazi-duzenle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Düzenle</button></td>
                                </tr>
              </table>
              </form> 



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
