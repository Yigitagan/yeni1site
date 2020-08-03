<?php
include "../baglanti.php";
include '../ayar.php';
include 'fonks.php';
include "headu.php";
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
          <li class="breadcrumb-item active">Sunucu Ekle</li>
        </ol>
<h2>Sunucu Ekle</h2><br>
<?php
            
            $sunucu_link=duzelt($_POST["sunucu"]);
            $sunucu=$_POST["sunucu"];
            $sunucu_ip=$_POST["ip"];
            $port=$_POST["port"];
            $sunucu_resim=$_POST["resim"];
            $sunucu_sifre=$_POST["sifre"];  
            
            if(isset($_POST['sunucu-ekle'])){
                $tabloya_ekle = $db->prepare("INSERT INTO Sunucular (ip,sunucu_link,sunucu,port,sunucu_resim,sunucu_sifre) VALUES(?,?,?,?,?,?)");
                $tabloya_ekle->execute(array($sunucu_ip,$sunucu_link,$sunucu,$port,$sunucu_resim,$sunucu_sifre));
                    echo '<div class="alert bg-success" role="alert"> Sunucu başarıyla eklenmiştir! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
                    echo '<meta http-equiv="refresh" content="3;URL=sunucular.php">';
            }
                
            ?>
      <form action="" method="post">
                            <table class="ekle">
                                <tr>
                                    <td>Sunucu İsmi:</td>
                                    <td><input required name="sunucu" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Sunucu Sayısal IP Adresi:</td>
                                    <td><input required name="ip" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Port:</td>
                                    <td><input required name="port" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>WebSend Şifre:</td>
                                    <td><input required name="sifre" placeholder="" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Sunucu Resim URL:</td>
                                    <td>
                        <input required name="resim" placeholder="" type="text" placehoder="http://resim.com/1.jpg" class="form-control">
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button src="/index.php" name="sunucu-ekle" type="submit" style="float: right; width: 100px;" class="btn btn-success">Ekle</button></td>
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
