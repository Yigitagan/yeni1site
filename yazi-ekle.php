<?php
include "../baglanti.php";
include "headu.php";
include '../ayar.php';
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
  <!-- include summernote css/js -->

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
          <li class="breadcrumb-item active">Yazı Ekle</li>
        </ol>
<h2>Yazı Ekle</h2><br>
 <?php
      
      $baslik=$_POST["baslik"];
      $yazar=$_POST["yazar"];
      $yazi=$_POST["icerik"];
      $kategori=$_POST["kategori"];
      $tarih = date('H:i - d.m.Y');
      
      if(isset($_POST['yazi-ekle'])){
        $tabloya_ekle = $db->prepare("INSERT INTO yazilar SET yazar=?,baslik=?,yazi=?,tarih=?,kategori=?");
        $insert=$tabloya_ekle->execute(array($yazar,$baslik,$yazi,$tarih,$kategori));

        if ($insert) {
          echo '<div class="alert bg-success" role="alert"> Duyuru yazısı başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
          echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
        }else{
          echo '<div class="alert bg-warning" role="alert"> Duyuru yazısı eklenemedi! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
          echo '<meta http-equiv="refresh" content="3;URL=yazilar.php">';
        }
      }
        
      ?>
      <form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Başlık:</td>
                                    <td><input required name="baslik" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Kategori:</td>
                                    <td><select required name="kategori" class="form-control">
                        <option value="Duyuru">Duyuru</option>
                        <option value="Bilgi">Bilgi</option>
                        <option value="Uyarı">Uyarı</option>
                        <option value="Güncelleme">Güncelleme</option>
                    </select></td>
                                </tr>
                                <tr>
                                    <td>Yazar:</td>
                                    <td><input required name="yazar" value="<?=$kullanicicek['username']?>" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>İçerik:</td>
                                    <td>
                        <textarea required name='icerik' id="editor1" rows="5" type="text" class="form-control"></textarea>                                        
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button src="/yazilar.php" name="yazi-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
                                </tr>
              </table>
              <input type="hidden" name="token" value="<? echo $_SESSION['token'] ?>" />
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
