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

$tipe = $_GET['tipe'];

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
<span class='h1'><?=$nmmodule; ?></span>
    <?php echo "<span class='h2'>".$g['company'].'</span><br>'; ?>
</td>
<td width='10%'>
&nbsp
</td>
</tr>
</table>

<br>


     <table border="1" id="table" width="100%" class="table table-striped responsive-utilities jambo_table" >

                       <thead>
                            <tr>                               
                                <th><h3 style='font-size:12px;'>Nama Pasien</h3></th>
                                <th><h3 style='font-size:12px;'>No KTP</h3></th>
                                <th><h3 style='font-size:12px;'>No BPJS</h3></th>
                                <th><h3 style='font-size:12px;'>Tanggal Lahir</h3></th>
                                <th><h3 style='font-size:12px;'>Jenis Kelamin</h3></th>
                                <th><h3 style='font-size:12px;'>Agama</h3></th>
                                <th><h3 style='font-size:12px;'>Kategori</h3></th>
                                <th><h3 style='font-size:12px;'>Telepon</h3></th>
                                <th><h3 style='font-size:12px;'>Alamat</h3></th>   
                                <th class='nosort' width="100px" style='text-align:center;'>
                                    <h3 style='font-size:12px;'>Aksi</h3>
                                </th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                         <?php


                            $tampil = mysql_query('SELECT a.*,b.agama,c.kategori
                                                FROM pasien a left join agama b 
                                                 ON a.id_agama = b.id_agama
                                                 left join kategori c
                                                 ON a.id_kategori = c.id_kategori
                                                 ORDER BY a.nama ');

                            $no = 1;

                            while ($r = mysql_fetch_array($tampil)) {
                                $tgl_lahir = date('d/m/Y', strtotime($r[tgl_lahir]));

                                if ($r['gender'] == 'L') {
                                    $gender = 'Laki-laki';
                                } else {
                                    $gender = 'Perempuan';
                                }

                                $ktp = ($r['ktp'] != "") ? $r['ktp'] : '-';
                                $bpjs = ($r['bpjs'] != "") ? $r['bpjs'] : '-';

                                echo'<tr>';
                                echo"<td>$r[nama]</td>";
                                echo"<td>$ktp</td>";
                                echo"<td>$bpjs</td>";
                                echo"<td>$tgl_lahir</td>";
                                echo"<td>$gender</td>";
                                echo"<td>$r[agama]</td>";
                                echo"<td>$r[kategori]</td>";
                                echo"<td>$r[telp]</td>";
                                echo"<td>$r[alamat]</td>";
                                echo"<td style='text-align:center;'>$r[aktif]</td>";

                                echo'</tr>';

                                $no++;
                            }

                                ?>

                         </tbody>

                    </table>


</body></html>

