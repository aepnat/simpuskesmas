<?php
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.:: Halaman Login ::.</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fw/css/font-awesome.min.css">
</head>
<body>

<?php
if ($_GET['userid']) {
    $userid = $_GET['userid'];
    $module = $_GET['module'];
} else {
    $userid = '';
    $module = 'home';
}

?>
	<section class="login-content">
	<div class="header-title">
		<h3>PUSKESMAS KELURAHAN PULAU PANGGANG</h3>
	</div>
	<div style='text-align:center;'>
		<img src='images/logo/logo.png' height='100' style='margin-top:20px;margin-bottom:-50px;'>	
	</div>	
		<form method="post" action="cek_login.php" accept-charset="utf-8">
		
		<label id="username">
			<input type="text" name="userid" value='<?php echo $userid; ?>' <?php if (!$userid) {
    echo 'autofocus';
} ?> placeholder="Pengguna" required autofocus onKeyUp="" >
		</label>
			<br>
		<label id="password">	
			<input type="password" name="password" <?php if ($userid) {
    echo 'autofocus';
} ?> placeholder="Sandi" required>
		</label>	
			<br><br>
			<button name="login"><i class="fa fa-sign-in"></i>&nbsp;Masuk	</button>
			<br>
			<input type="hidden"  name="module" value='<?php echo $module?>'><br>
		</form>
	</section><br>
	<footer>
	<br><br><br>
	<?php
    $SQL = "SELECT* FROM versi WHERE status = 'A' ";
    $tampil = mysql_query($SQL);
    $p = mysql_fetch_array($tampil);

    $app = $p['aplikasi'];

    $versi = $p['versi'];
    ?>
                
	<div class="wifi" style="font-size: 33px;"><?php echo $app; ?></div>
		<!-- <p class="copyright">Version : <?php echo $versi;?></p> -->
	</footer>
</body>
</html>