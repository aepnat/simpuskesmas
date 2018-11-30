<?php
session_start();
include "config/koneksi.php";



if ($_SESSION[role]=='dev'){

  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");


} elseif ($_SESSION[role]=='admin'){

  $sql=mysql_query("select * from modul where status !='dev' and aktif='Y' order by urutan");


} elseif ($_SESSION[role]=='user'){

	  $sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan");

} else {

  $sql=mysql_query("SELECT * FROM modul a inner join usermenu b on a.id_modul = b.id_modul where a.status='user' and a.aktif='Y'  and b.m_aktif='Y' and b.username='$_SESSION[id_user]' ORDER BY a.urutan"); 

} 

 
while ($r=mysql_fetch_array($sql)){  

//$nt=mysql_query("select count from notice where (status = '1' and id_user2 = '$_SESSION[id_user]') or( status = '3' and id_user2 = '$_SESSION[id_user]')");
//$cjml = mysql_num_rows($nt);  

//if ($cjml == '0') {
//$njml ='';
//} else {
//$njml = '('.$cjml.')';	
//}
	
  if ($r[status_menu] == 'M' and !empty($r[link])) {  
   if ($r[nama_modul] == 'Notice') {
   echo "<a class='menuitem' href='$r[link]'>$r[nama_modul] $njml</a>";
   } else {
    echo "<a class='menuitem' href='$r[link]'>$r[nama_modul]</a>";	    
   }
  
  } else if ($r[status_menu] == 'M' and empty($r[link])) {  	
  echo "<a class='menuitem submenuheader' href='$r[link]'>$r[nama_modul]</a>  ";
  
  if ($_SESSION[role]=='dev' or $_SESSION[role]=='admin') {
   $detil=mysql_query("select * from modul where id_submenu='$r[id_modul]' and status_menu='C' and aktif='Y' order by urutan"); 
  } else {
	$detil=mysql_query("select * from modul where id_submenu='$r[id_modul]' and status_menu='C' and aktif='Y' and (id_role = '5' or id_role	 = '$_SESSION[role]') and (id_group = '1' or id_group = '$_SESSION[group]')order by urutan");   
  }
  echo"
  <div class='submenu'>
	";
	while ($d=mysql_fetch_array($detil)){  
	echo"<ul><li><a href='$d[link]'>$d[nama_modul]</a></li></ul>";
	}
	echo"
 </div>	
  ";
  } else {
  echo"";
  }
  
 
}
?>

