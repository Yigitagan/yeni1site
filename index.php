<?php
include "../baglanti.php";
include "headu.php";
include "../Websend.php";
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
          <li class="breadcrumb-item active">Genel Bakış</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-basket"></i>
                </div>

                <div class="mr-5"><?php
                    $kayit = $db->prepare("SELECT count(*) FROM alinanurun");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?> alınan ürün</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="urunler.php">
                <span class="float-left">Göster</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-coins"></i>
                </div>
                <div class="mr-5"> <?php
                    $kayit = $db->prepare("SELECT sum(miktar) FROM krediler");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?> alınan kredi</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="uyeler.php">
                <span class="float-left">Göster</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5"><?php
                    $kayit = $db->prepare("SELECT count(*) FROM authme");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?> kayıtlı üye</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="uyeler.php">
                <span class="float-left">Göster</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?php
                    $kayit = $db->prepare("SELECT count(*) FROM tickets");
                    $kayit->execute();
                    $say = $kayit->fetchColumn();
                    
                    if($say > 0){
                      echo $say;
                    }
                    else{
                      echo "0";
                    }
                    ?> destek bildirimi</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="destekler.php">
                <span class="float-left">Göster</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        	<center><br>
	<div class="card card-body" style=" font-family: Arial Black; font-size: 22px; "><br>SUNUCUYA KOMUT GÖNDER<br>

<?php
if(isset($_POST["komut-gonder"])){
	if ($_POST['sunucu'] != "Sunucu Yok!") {
	$sunucu = $_POST["sunucu"];
	$komut  = $_POST["komut"];
	
	$sec = $db->prepare("SELECT * FROM Sunucular WHERE sunucu = ?");
	$sec->execute(array($sunucu));
	$oku = $sec->fetch();
	
	$ws = new Websend("".$oku["ip"]."");
	$ws->password = "".$oku["sunucu_sifre"]."";
	$ws->port = "".$oku["port"]."";
				    
	if($ws->connect()){
				$ws->doCommandAsConsole($komut);
				echo '<div class="alert bg-success" role="alert">Komut başarıyla gönderildi!</div>';
			}else{
echo '<div class="alert bg-danger" role="alert">Sunucuya bağlanılamadı!</div>';
			}
		} else {
			echo '<div class="alert bg-danger" role="alert"> Bir sunucu seçmediniz!</div>';
		}
	}
		
?>
<br>
		<form action="" method="post">
				<div class="form-group">
									<select class="form-control" name="sunucu" style="width: 100%; height: 45px;">
										<?php
										$sunucu_cek = $db->query("SELECT * FROM Sunucular ORDER BY id");
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
				<input type="text" required name="komut" style="width: 100%; height: 45px;" class="form-control" placeholder="Sunucuyu seçin ve göndermek istediğiniz komutu '/' olmadan yazın!" />
				<button name="komut-gonder" class="btn btn-success" style="width: 25%; margin-top: 8px; height: 45px; float: right;">Komut Gönder</button>
				</form>
				<br>
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
