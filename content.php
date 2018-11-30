<?php
include "config/koneksi.php";



  $tampil=mysql_query("SELECT * FROM modul where link !='' ORDER BY urutan");
  
  	
  while ($r=mysql_fetch_array($tampil)){
  $p = strlen($r['link']);
  $mod = substr($r['link'],8,$p);
  
//  echo"$mod<br>";
//  echo"$_GET[module]<br>";
//  echo"modul/mod_$mod.php<br>";
//

	if ($_GET['module']==$mod){
	 //include "modul/mod_$mod.php";
	 include "modul/mod_$mod/$mod.php";
	}
  }	
  


// Apabila modul tidak ditemukan
//else{
//  echo "<p><b>Modul Not Found.</b></p>";
//}

?>
