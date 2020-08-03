<?php
include "../baglanti.php";
include "headu.php";

if (isset($_POST['usil'])) {

  $sil=$db->prepare("DELETE from urunler where urun_id=:id");
  $kontrol=$sil->execute(array('id' => $_POST['uid']));
  if ($kontrol) {
    header("refresh: 0; url=urunler.php");
  } else {
    echo "<script>alert('Ürün silinemedi')</script>";
    header("refresh: 0; url=urunler.php");
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
          <a class="dropdown-item" href="cikis.">Çıkış Yap</a>
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
          <li class="breadcrumb-item active">Ürünler</li>
        </ol>


  <?php
                    $sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id DESC");
                    $sunucu_cek->execute();   
                    if($sunucu_cek->rowCount() != 0){ 
                      ?>
  <h2>Ürünler</h2><br><a href="urun-ekle.php"><button type="submit" name="kekle" class="btn btn-success pull-right">Ekle +</button></a><br><br>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Ürün Adı</th>
                    <th>Fiyat</th>
                    <th>Komut 1</th>
                    <th>Komut 2</th>
                    <th>Komut 3</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Ürün Adı</th>
                    <th>Fiyat</th>
                    <th>Komut 1</th>
                    <th>Komut 2</th>
                    <th>Komut 3</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                $urunsor=$db->prepare("SELECT * FROM urunler order by urun_isim DESC");
                $urunsor->execute();
                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><?php echo $uruncek['urun_isim']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_fiyat']; ?></center></td>
                  <td><?php echo $uruncek['urun_komut']; ?></td>
                  <td><?php echo $uruncek['urun_komut2']; ?></td>
                  <td><?php echo $uruncek['urun_komut3']; ?></td>
                  <td><center><?php echo $uruncek['urun_acikla']; ?></center></td>
                  <td><form method="POST"><a href="urun-duzenle.php?id=<?php echo $uruncek['urun_id']; ?>"><button type="button" class="btn btn-xs btn-primary"><li class="fa fa-pen"></button></a>
          
            <input type="hidden" name="uid" value="<?php echo $uruncek['urun_id']; ?>">
            <button type="submit" name="usil" class="btn btn-xs btn-danger" onclick="return ShowConfirm();"><li class="fa fa-trash"></button>
                    </form>
                  </td>
                </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else {
            echo "<h2 style=\"color: red;\">Ürün eklemeden önce, ürünün çalışacağı bir sunucu eklemelisiniz.</h2>";
          } ?>
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
