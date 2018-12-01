
<?php
include 'config/koneksi.php';

$imodule = $_GET['module'];
$imenu = $_GET['menu'];
$isub = $_GET['sub'];

?>


<table cellpadding='0' cellspacing='0' width='100%'>

<tr>
<?php
$SQL = 'SELECT * FROM general_setting ';

        $tampil = mysql_query($SQL);

        $r = mysql_fetch_array($tampil);

        $nm_hotel = $r[hotel_name];
?>
<td width='90%'>
<div id='cssmenu'>

<ul>
	<li class='Aktif' style='font-weight:bold;color:#2969FF'><?php echo ' .: '.$nm_hotel.' :. ' ?> &nbsp</li>

	
   <?php

    $user = $_SESSION['userid'];

            $sql = mysql_query("select * from modul where aktif='Y' order by urutan");

    while ($r = mysql_fetch_array($sql)) {
        if ($r[status_menu] == 'M' and !empty($r[link])) {
            echo "<li class='Aktif'><a href='$r[link]&menu=$r[nama_modul]'>$r[nama_modul]</a>";
        } elseif ($r[status_menu] == 'M' and empty($r[link])) {
            echo "<li class='Aktif'><a href='#'>$r[nama_modul]</a>";
        }

        echo'<ul>';

        $detil = mysql_query("select * from modul where parentid='$r[id_modul]' and status_menu='C' and aktif='Y' order by urutan");

        while ($d = mysql_fetch_array($detil)) {
            if ($d[is_form] == 'Y') {
                echo"<li><a href='form/form_$d[link].php?width=850&height=600&module=$d[link]&imodule=$imodule&imenu=$imenu&isub=$isub&TB_iframe=true' title='$d[nama_modul]' class='thickbox' >$d[nama_modul]</a></li>";
            } else {
                echo"<li><a href='$d[link]&menu=$r[nama_modul]&sub=$d[nama_modul]'>$d[nama_modul]</a></li>";
            }
        }

        echo'</ul>';
    }

    ?>
  
  
  
</li>
</ul>

</div>
</td>

</tr>

</table>