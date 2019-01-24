<?php

error_reporting(0);session_start();

include './../../config/koneksi.php';
include './../../config/fungsi_indobulan.php';

$tampil = mysql_query("SELECT * FROM modul WHERE id_modul ='".$_GET[report_id]."'");

$r = mysql_fetch_array($tampil);

$module = $_GET['module'];

$imodule = ucwords($r['nama_modul']);

$nmmodule = ucwords($r['nama_modul']);

$id = $r['id_modul'];

$fa_icon = $r['fa_icon'];

// if($r[orientation] == 'P') {

//  $orientation = 'portrait';

// } else {

//  $orientation = 'landscape';

// }

$orientation = 'portrait';

$status = $_GET['status'];

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">

<title></title>



<link href='../config/css/style.css' source='text/css' rel='stylesheet'>



<style type="text/css">



@font-face{ font-family: 'code39r'; src: url('./../../font/code39r-webfont.eot'); src: url('./../../font/code39r-webfont.eot?iefix') format('eot'), url('./../../font/code39r-webfont.woff') format('woff'), url('./../../font/code39r-webfont.ttf') format('truetype'), url('./../../font/code39r-webfont.svg#code39r-webfont') format('svg'); }







.icon {

font-size: 30px;

color : #006699;



}



@page { 

size: <?php echo $orientation?>;    

margin-top: 10px;
margin-bottom: 0px;


}



body {

font-family:tahoma;

font-size : 12.5px;



}



.h1{



font-size: 22px;

font-weight: bold;

padding:4px;

}



.h2{



font-size:20px;

font-weight: bold;

padding:0px;

}



.h3{



font-size:15px;

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

border-top:1px dashed black;

border-left:1px dashed black;

border-bottom:1px dashed black;

padding:6px;

text-align: left;



}



.iborder {

border-top:1px dashed black;

border-bottom:1px dashed black;

padding:6px;

text-align: left;



}



.ijborder {

border-bottom:1px dashed black;

padding:6px;

text-align: left;



}



.lborder {

border-top:1px dashed black;

border-right:1px dashed black;

border-bottom:1px dashed black;

padding:6px;

text-align: left;



}



.border {

padding:6px;

border-bottom:1px dashed black;



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



<!--<body onload="icetak()">-->





<body>



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

$time = time() - (1 * 1 * 60 * 60);

$datetime = date('d/m/Y G:i:s', $time);

$tgl = tgl_indo(date('Y-m-d', $time));

$id_rujukan = $_GET['id_rujukan'];

$gtampil = mysql_query("SELECT * FROM informasi_perusahaan where id_informasi_perusahaan = '1'");

$g = mysql_fetch_array($gtampil);

if ($g['pict']) {
$pict = $g['pict'];
} else {
$pict = '';
}

$company = ucwords($g['company']);

?>

<div style='border:1px solid black;'>


<table width='100%' style="padding-top:5px;" border='0'>

<tr>

<td width='100%' valign="top" style='text-align:center;border-bottom:1px solid black;'>
<span style="font-weight: bold;">KARTU RUJUKAN PASIEN</span><br>    
<span style="font-weight: bold;"><?=$g['company']?></span><br>
<span><?php echo $g['address'].' '.$g['city'].' '.$g['state'].', '.$g['prov'].' '.$g['zip']?></span>

</td>
</tr>


<?php
// $tampil = mysql_query("SELECT a.*,b.agama,c.kategori
//             FROM pasien a left join agama b 
//              ON a.id_agama = b.id_agama
//              left join kategori c
//              ON a.id_kategori = c.id_kategori
//             WHERE a.id_pasien = '$id_pasien' ");
$tampil = mysql_query("SELECT a.*,b.nama,b.gender,b.tgl_lahir,b.ktp,c.poli,d.kategori,b.bpjs
,e.rujukan as rujukan_rs
,f.rujukan as rujukan_lab
FROM kunjungan_berobat a left join pasien b 
ON a.id_pasien = b.id_pasien
left join poli c 
ON a.id_poli = c.id_poli
left join kategori d
ON b.id_kategori = d.id_kategori
left join rujukan e
ON a.id_rujukan_rs = e.id_rujukan
left join rujukan f
ON a.id_rujukan_lab = f.id_rujukan    
WHERE a.rujukan = 'Y'
AND a.id_kunjungan_berobat = '$id_rujukan'
ORDER BY a.tanggal,a.id_poli,a.no_urut ASC");

$r = mysql_fetch_array($tampil);
$tgl_lahir = date('d/m/Y', strtotime($r['tgl_lahir']));
$tgl = date('d/m/Y', strtotime($r['tanggal']));

if ($r['gender'] == 'L') {
$gender = 'Laki-laki';
} else {
$gender = 'Perempuan';
}
?>
<table>

<table width='100%' border='0'>
<tr>
<td width='30%'>Tanggal</td>
<td width='1%'>:</td>
<td><?php echo $tgl; ?></td>
</tr>
<tr>
<td width='30%'>Nama</td>
<td width='1%'>:</td>
<td><?php echo $r['nama']; ?></td>
</tr>    
<tr>
<td width='30%'>Jenis Kelamin</td>
<td width='1%'>:</td>
<td><?php echo $gender; ?></td>
</tr>
<tr>
<td width='30%'>Kategori Pasien</td>
<td width='1%'>:</td>
<td><?=$r['kategori']; ?></td>
</tr>
<?php if (strtolower($r['kategori']) == 'bpjs'):?>
<tr>
<td width='30%'>No. BPJS</td>
<td width='1%'>:</td>
<td><?php echo ($r['bpjs'] != '') ? $r['bpjs'] : '-'; ?></td>
</tr>
<?php endif; ?>
<tr>
<td width='30%'>Rujukan RS</td>
<td width='1%'>:</td>
<td><?php echo $r['rujukan_rs']; ?></td>
</tr>
<tr>
<td width='30%'>Rujukan Lab.</td>
<td width='1%'>:</td>
<td><?php echo $r['rujukan_lab']; ?></td>
</tr>
</table>    

</div>
</body></html>



