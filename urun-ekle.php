<?php
include "../baglanti.php";
include 'fonks.php';
include "headu.php";

      $urun_isim=$_POST["urun_isim"];
      $sunucu_link=duzelt($_POST["sunucu"]);
      $sunucu=$_POST["sunucu"];
      $urun_fiyat=$_POST["urun_fiyat"]; 
      $urun_komut=$_POST["urun_komut"];
      $urun_komut2=$_POST["urun_komut2"];
      $urun_komut3=$_POST["urun_komut3"];
      $urun_acikla=$_POST["urun_acikla"];

if (isset($_POST['uekle'])) {

 $tabloya_ekle = $db->prepare("INSERT INTO urunler (urun_isim,sunucu,sunucu_link,urun_fiyat,urun_komut,urun_komut2,urun_komut3,urun_acikla) VALUES(?,?,?,?,?,?,?,?)");
        $tabloya_ekle->execute(array($urun_isim,$sunucu,$sunucu_link,$urun_fiyat,$urun_komut,$urun_komut2,$urun_komut3,$urun_acikla));
          echo "<script>alert('Kayıt eklendi.');</script>";
          echo '<meta http-equiv="refresh" content="3;URL=urunler.php">';
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
          <li class="breadcrumb-item active">Ürün Ekle</li>
        </ol>
        <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Bilgi</h4>
                Komutta oyuncu adını yazdırmak istiyorsanız oyuncu adının yazılacağı yere %player% yazmalısınız.
              </div>
<h2>Ürün Ekle</h2><br>
<center>
<div class="col-md-6">
  <form method="POST">
                <div class="form-group">
                  <label>Ürün adı</label>
                  <input type="text" style="width: 200px" name="urun_isim" class="form-control" placeholder="Ürün adı giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Fiyat</label>
                  <input type="number" min="0" max="250" value="0" style="width: 200px" name="urun_fiyat" class="form-control" placeholder="Şifre giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Komut 1</label>
                  <input type="text" style="width: 200px" name="urun_komut" placeholder="Başına / eklemeyin!" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label>Komut 2 (opsiyonel)</label>
                  <input type="text" style="width: 200px" name="urun_komut2" placeholder="Başına / eklemeyin!" class="form-control">
                </div>
                <div class="form-group">
                  <label>Komut 3 (opsiyonel)</label>
                  <input type="text" style="width: 200px" name="urun_komut3" placeholder="Başına / eklemeyin!" class="form-control">
                </div>

                <div class="form-group">
                  <label>Ürünün Ait Olduğu Sunucu (Sunucu eklemediyseniz, "Sunucular" sekmesinden ekleyiniz.)</label>
                  <select class="form-control" name="sunucu">
                    <?php
                    $sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id DESC");
                    $sunucu_cek->execute();   
                    if($sunucu_cek->rowCount() != 0){
                      
                      foreach ($sunucu_cek as $sunucu_oku) {

                    ?>
                    <option name="sunucu" value="<?php echo $sunucu_oku['sunucu'] ?>"><?php echo $sunucu_oku['sunucu'] ?></option>
                    <?php
                    }
                    }else{
                    echo '<option>Sunucu Yok!</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Ürün Açıklaması</label>
                  <textarea type="text" style="width: 200px" name="urun_acikla" class="form-control" placeholder="Ürün özelliklerini vs. giriniz."></textarea>
                </div>

                <button type="submit" name="uekle" class="btn btn-primary">Kaydet</button>
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
