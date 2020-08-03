<?php
function curlCall($strURL)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $strURL);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $rsData = curl_exec($ch);
  curl_close($ch);
  return $rsData;
}
 ?>
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Yönetim Paneli</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="uyeler.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Üyeler</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sunucular.php">
          <i class="fas fa-fw fa-code"></i>
          <span>Sunucular</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="urunler.php">
          <i class="fas fa-fw fa-shopping-basket"></i>
          <span>Ürünler</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="destekler.php">
          <i class="fas fa-fw fa-code"></i>
          <span>Destek Talepleri</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="yazilar.php">
          <i class="fas fa-fw fa-code"></i>
          <span>Yazılar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kuponlar.php">
          <i class="fas fa-fw fa-code"></i>
          <span>Kuponlar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ayarlar.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Ayarlar</span></a>
      </li>
<?php
$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
$lastversion = curlCall('https://mycraftupdate.netlify.com/lastversion.txt');
$currentversion = file_get_contents('version.ver');
if ($lastversion != $currentversion)
{
?>
<li class="nav-item">
        <a class="nav-link" href="guncelle.php">
          <i class="fas fa-fw fa-sync"></i>
          <span>Yeni bir sürüm mevcut!</span></a>
      </li>
      <?php } ?>
    </ul>
