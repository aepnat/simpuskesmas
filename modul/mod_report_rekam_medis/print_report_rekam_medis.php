<?php
include './../../config/koneksi.php';
include './../../config/fungsi_indobulan.php';

$tampil = mysql_query("SELECT * FROM modul WHERE id_modul ='".$_GET[report_id]."'");

$r = mysql_fetch_array($tampil);

$module = $_GET['module'];
$imodule = ucwords($r['nama_modul']);
$nmmodule = ucwords($r['nama_modul']);
$id = $r['id_modul'];
$fa_icon = $r['fa_icon'];

if ($r[orientation] == 'P') {
    $orientation = 'portrait';
} else {
    $orientation = 'landscape';
}

$pasien = $_GET['pasien'];
$ldate = $_GET['ldate'];
$ldate = $_GET['ldate'];

$ftgl = date('d/m/Y', strtotime($_GET['fdate']));
$ltgl = date('d/m/Y', strtotime($_GET['ldate']));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
<title></title>

<link href='../config/css/style.css' source='text/css' rel='stylesheet'>

<style type="text/css">

.icon {
  font-size: 30px;
  color : #006699;

}

@page { 
  size: <?=$orientation?>;  
  }

body {
  font-family:tahoma;
  font-size : 11px;
  
}

.h1{

  font-size: 17px;
  font-weight: bold;
  padding:4px;
}

.h2{

  font-size:14px;
  font-weight: bold;
  padding:0px;
}

.h3{

  font-size:12px;
  font-weight: bold;
  padding:2px;
}


.h4{

  font-size: 11px;
  font-weight: bold;
  padding:4px;
}
td{
  vertical-align: top;
  padding: 3px;
}
@media print{
.noprint{display:none}
}
.style1 {
  font-size: large;
  font-weight: bold;
}

.fborder {
  border-top:1px solid black;
  border-left:1px solid black;
  border-bottom:1px solid black;
  padding:6px;

}

.iborder {
  border-top:1px solid black;
  border-bottom:1px solid black;
  padding:6px;

}

.lborder {
  border-top:1px solid black;
  border-right:1px solid black;
  border-bottom:1px solid black;
  padding:6px;

}

.border {
  padding:4px;
  border-bottom:1px solid black;

}

</style>
<script language="javascript" type="text/javascript">
function cetak(){
    window.print();
  /*window.close();*/
}
function icetak(){
    window.print();
  setTimeout(function(){window.close();}, 1);
}
</script>

<link href='./../../config/css/font-awesome.min.css' type='text/css' rel='stylesheet'>

</head>

<!--<body onload="cetakspk()">-->

<?php if ($_GET['printto'] == '2') {
    ?>
<body onload="icetak()">
<?php
} else {
        ?>
<body>
<?php
    } ?>


   <div class="noprint themeborderleft themeborderright themebordertop themeborderbottom"  >
    <table width="100%" >
    <tr>
    <td width="100%"align="right">
    <a href="" onclick="javascript:cetak()" title='Print'><span class='icon'><i class='fa fa-print'></i></span></a>
  &nbsp&nbsp&nbsp&nbsp  
  <a href="javascript:window.close()" title='Close'><span class='icon'><i class='fa fa-close'></i></span></a>
</td>
    </tr>
    </table>
 
</div>


<?php
$gtampil = mysql_query("SELECT * FROM informasi_perusahaan where id_informasi_perusahaan = '1'");
 $g = mysql_fetch_array($gtampil);

if ($g['pict']) {
    $pict = $g['pict'];
} else {
    $pict = '';
}

$company = ucwords($g['company']);
?>

 <table width='100%' style="padding-top:10px;">
<tr>
<td width='10%'>
<!-- <img src="../../images/logo/<?=$pict; ?>" width=100px> -->
</td>
<td style="text-align:center;" width='80%'>
<span class='h1'><?=$nmmodule; ?></span><br>
<?php echo "<span class='h2'>".$g['company'].'</span><br>'; ?>
<br>Periode : <?=$ftgl; ?> - <?=$ltgl; ?>
</td>
<td width='10%'>
&nbsp
</td>
</tr>
</table>
<hr>

<?php
 $tampil = mysql_query("SELECT a.*,b.agama,c.kategori
          FROM pasien a left join agama b 
           ON a.id_agama = b.id_agama
           left join kategori c
           ON a.id_kategori = c.id_kategori
           WHERE a.id_pasien = '$pasien' ");

$r = mysql_fetch_array($tampil);

$tgl_lahir = date('d/m/Y', strtotime($r[tgl_lahir]));

if ($r['gender'] == 'L') {
    $gender = 'Laki-laki';
} else {
    $gender = 'Perempuan';
}
?>      

<table style="width: 100%;">
<tr><td style="width: 20%;">NIP</td><td style="width: 1%;">:</td><td><?=$r[ktp]; ?></td></tr>
<tr><td style="width: 20%;">Nama Pasien</td><td style="width: 1%;">:</td><td><?=$r[nama]; ?></td></tr>
<tr><td style="width: 20%;">Jenis Kelamin</td><td style="width: 1%;">:</td><td><?=$gender; ?></td></tr>
<tr><td style="width: 20%;">Tanggal Lahir</td><td style="width: 1%;">:</td><td><?=$tgl_lahir; ?></td></tr>
</table> 
<br>
<table style="width: 100%;" border='1'>
  <tr>
    <td style="width: 10%;">Tgl.Periksa</td>
    <td>Keluhan</td>
    <td>Diagnosa</td>
    <td>Pemeriksaan</td>
    <td>Tindakan</td>
  </tr>

    <?php

$tampil = mysql_query("SELECT a.*,b.nama,b.tgl_lahir,b.ktp,c.poli,d.kategori          
        FROM kunjungan_berobat a left join pasien b 
         ON a.id_pasien = b.id_pasien
         left join poli c 
         ON a.id_poli = c.id_poli
         left join kategori d
         ON b.id_kategori = d.id_kategori        
         WHERE a.id_pasien = '$pasien'");

while ($r = mysql_fetch_array($tampil)) {
    $tgl = date('d/m/Y', strtotime($r[tanggal]));

    echo'<tr>';
    echo"<td>$tgl</td>";
    echo"<td>$r[keluhan]</td>";
    echo"<td>$r[diagnosa]</td>";
    echo"<td>$r[pemeriksaan]</td>";
    echo"<td>$r[tindakan]</td>";

    echo'</td>';
    echo'</tr>';
}
?>

 
    
</table> 

</body></html>

