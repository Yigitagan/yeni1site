<?php
include "../baglanti.php";
include "headu.php";

if (isset($_POST['dsil'])) {

  $sil=$db->prepare("DELETE from destekler where id=:id");
  $kontrol=$sil->execute(array('id' => $_POST['uid']));
  if ($kontrol) {
    header("refresh: 0; url=destekler.php");
  } else {
    echo "<script>alert('Destek silinemedi')</script>";
    header("refresh: 0; url=destekler.php");
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
          <li class="breadcrumb-item active">Destek Bildirimleri</li>
        </ol>
<h2>Destek Talepleri</h2><br>
             <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Tarih</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Kullanıcı Adı</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Tarih</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Kullanıcı Adı</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                  </tr>
                  <?php
                $tickets_cek = $db->query("SELECT * FROM tickets ORDER BY son_guncelleme DESC");
                $tickets_cek->execute();    
                if($tickets_cek->rowCount() != 0){
                  
                  foreach ($tickets_cek as $tickets_oku) {


                              $saat= substr($tickets_oku['son_guncelleme'], 8, 2);
                              $dk= substr($tickets_oku['son_guncelleme'], 10, 2);
                              $gun= substr($tickets_oku['son_guncelleme'], 6, 2);
                              $ay= substr($tickets_oku['son_guncelleme'], 4, 2);
                              $yil= substr($tickets_oku['son_guncelleme'], 0, 4);

                ?>
                </tfoot>
                <tbody>
                  <tr>
                    <td><?php echo ''.$gun.'.'.$ay.'.'.$yil.' '.$saat.':'.$dk.'' ?></td>
                    <td><?php echo $tickets_oku['baslik'] ?></td>
                    <td><?php echo $tickets_oku['kategori'] ?></td>
                    <td><?php echo $tickets_oku['nick'] ?></td>
                    <td><?php 
                  if ($tickets_oku['durum'] == '0'){
                  echo '<strong>Açık</strong>';
                  }
                  if ($tickets_oku['durum'] == '1'){
                  echo '<strong>Yanıtlandı</strong>';
                  }
                  if ($tickets_oku['durum'] == '2'){
                  echo '<strong>Kullanıcı Yanıtı</strong>';
                  }
                  if ($tickets_oku['durum'] == '3'){
                  echo '<strong>Kapatıldı</strong>';
                  }
                  ?></td>
                    <td><a href="destek-goster.php?id=<?php echo $tickets_oku['id']; ?>"><button class="btn btn-success pull-right">Göster</button></a></td>
                  </tr>
                  <?php
                }
                }
                ?>
                </tbody>
              </table>
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
