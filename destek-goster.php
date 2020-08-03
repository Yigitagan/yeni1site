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
          <li class="breadcrumb-item active">Destek Göster</li>
        </ol>
<h2>Destek Göster</h2><br>

<?php
      
      $id = @$_GET["id"];
      $cevap = $_POST["cevap"]; 
      $durum = "1";
      $guncelleme = date('YmdHis');

      $ticket_cevapla = $db->prepare("SELECT * FROM tickets WHERE id = ?");
      $ticket_cevapla->execute(array($_GET['id']));
      $ticket_oku = $ticket_cevapla->fetch();
      
      if(isset($_POST['cevapla'])){

        if(($ticket_oku["durum"] == "1") or ($ticket_oku["durum"] == "2")){


        $ticket_son_id = $db->prepare("SELECT * FROM tickets_sc WHERE ticket_id = ? ORDER BY id DESC LIMIT 1");
        $ticket_son_id->execute(array($_GET["id"]));
        $ticket_son_id_oku = $ticket_son_id->fetch();

        $ticket_query = $db->prepare("UPDATE tickets_sc SET cevap = ? WHERE ticket_id = ? and id = ?");
        $update = $ticket_query->execute(array($cevap,$_GET['id'],$ticket_son_id_oku["id"]));

        $ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

        echo 'Destek talebi başarıyla cevaplandı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';

        }if($ticket_oku["durum"] == 0){

        $ticket_query = $db->prepare("UPDATE tickets SET cevap = ?, durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($cevap,$durum,$guncelleme,$_GET['id']));
        echo 'Destek talebi başarıyla cevaplandı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
    }
      
      if(isset($_POST['sil'])){
        $query = $db->prepare("DELETE FROM tickets WHERE id = :id");
        $delete = $query->execute(array(
           "id" => $_GET['id']
        ));
        echo 'Destek talebi başarıyla silindi!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
      if(isset($_POST['ticket-kapat'])){
        $durum = "3";
        $ticket_query = $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE id = ?");
        $update = $ticket_query->execute(array($durum,$guncelleme,$_GET['id']));

        echo 'Destek talebi başarıyla kapatıldı!';
        echo '<meta http-equiv="refresh" content="2;URL=destekler.php">';
      }
        
      ?>
      <?php
    
            $ticket_kontrol = $db->prepare("SELECT * FROM tickets WHERE id = ? and nick = ?");
            $ticket_kontrol->execute(array($_GET["id"],$_SESSION['user_nick']));  
            $ticket_oku = $ticket_kontrol->fetch(); 
              if($ticket_kontrol->rowCount() != 0){
          ?>
                <h2>Kullanıcı:</h2>
                <p><?php echo $ticket_oku["mesaj"]; ?></p>
                <br>
                <?php
              if($ticket_oku["cevap"] != NULL){
            ?>
            <h2>Siz:</h2>
          <p><?php echo $ticket_oku["cevap"]; ?></p>
              <?php } ?>
              <?php
              $tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE nick = ? and ticket_id = ?");
              $tickets_sc->execute(array($_SESSION['user_nick'],$_GET["id"]));

              if($tickets_sc->rowCount() != 0){

                foreach ($tickets_sc as $tickets_sc_oku) {

                  if($tickets_sc_oku["soru"] != NULL){
            ?>
          <h2>Kullanıcı:</h2>
                <p><?php echo $tickets_sc_oku["soru"]; ?></p>
                <br>
                <?php 
                
                }
              if($tickets_sc_oku["cevap"] != NULL){
            ?>
            <h2>Siz:</h2>
            <p><?php echo $tickets_sc_oku["cevap"]; ?></p>
          <?php } ?>

          <?php
                }
              }
            }

            ?>
            <?php

if($ticket_oku["durum"] != 3){

if(isset($_POST['soru_gonder'])){
$soru     = strip_tags($_POST['soru']);
$durum    = "2";
$guncelleme = date('YmdHis');

if($_POST["soru"] == ""){
  echo '
             <h2 style="color:red">Boş alan bırakmayın!</h2>
  ';
}
else{
    $cevap_gonder = $db->prepare("INSERT INTO tickets_sc (nick,ticket_id,soru) VALUES(?,?,?)");
    $cevap_gonder->execute(array($_SESSION['user_nick'],$_GET["id"],$soru));

    $durum_guncelle =  $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE nick = ? and id = ?");
    $durum_guncelle->execute(array($durum,$guncelleme,$_SESSION['user_nick'],$_GET["id"]));

    echo '<meta http-equiv="refresh" content="0;URL=dst-goster.php">';
}
}
}
?>
<form action="" method="post">
<textarea class="form-control"  name="cevap" placeholder="Kullanıcıya gönderilecek mesajı yazınız." rows="5"></textarea>
<br>
<button name="cevapla" type="submit" class="btn btn-success">Cevapla</button>
<button name="ticket-kapat" type="submit" class="btn btn-warning">Talebi Kapat</button>
<button name="sil" type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button>
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
