<?php
include('../baglanti.php');
session_start();
ob_start();

$menuurl=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$id = explode('/', $menuurl);
$id_Son = explode('-', $id[2]);
$menuaktif= $id_Son[0];

$kullanicisor=$db->prepare("SELECT * FROM authme where username=:username and yetki=1");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

if ($say==0) {
  echo "<script>alert('Buraya girebilmek için ana sayfadan giriş yapmalısın.')</script>";
  echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
  exit;
}

if(!isset($_SESSION['user_nick'])){
  echo "<script>alert('Buraya girebilmek için ana sayfadan giriş yapmalısın.')</script>";
  echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
  exit;
}
?>
