    <?php

    error_reporting(0);session_start();

    include './../../config/koneksi.php';

    include './../../config/fungsi_indobulan.php';

    $SQL = 'SELECT* FROM periode ';

    $tampil = mysql_query($SQL);

    $p = mysql_fetch_array($tampil);

    $prd = $_GET['prd'];

    $tampil = mysql_query("SELECT * FROM modul WHERE id_modul ='".$_GET[report_id]."'");

    $r = mysql_fetch_array($tampil);

    $module = $_GET['module'];

    $imodule = ucwords($r['nama_modul']);

    $nmmodule = ucwords($r['nama_modul']);

    $id = $r['id_modul'];

    $fa_icon = $r['fa_icon'];

    // if($r[orientation] == 'P') {

    // 	$orientation = 'portrait';

    // } else {

    // 	$orientation = 'landscape';

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

	font-size : 12px;

	

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

	border-top:1px solid black;

	border-left:1px solid black;

	border-bottom:1px solid black;

	padding:6px;

	text-align: left;



}



.iborder {

	border-top:1px solid black;

	border-bottom:1px solid black;

	padding:6px;

	text-align: left;



}



.lborder {

	border-top:1px solid black;

	border-right:1px solid black;

	border-bottom:1px solid black;

	padding:6px;

	text-align: left;



}



.border {

	padding:6px;

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



<?php


    function Terbilang($x)
    {
        $abil = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];

        if ($x < 12) {
            return ' '.$abil[$x];
        } elseif ($x < 20) {
            return Terbilang($x - 10).'belas';
        } elseif ($x < 100) {
            return Terbilang($x / 10).' puluh'.Terbilang($x % 10);
        } elseif ($x < 200) {
            return ' seratus'.Terbilang($x - 100);
        } elseif ($x < 1000) {
            return Terbilang($x / 100).' ratus'.Terbilang($x % 100);
        } elseif ($x < 2000) {
            return ' seribu'.Terbilang($x - 1000);
        } elseif ($x < 1000000) {
            return Terbilang($x / 1000).' ribu'.Terbilang($x % 1000);
        } elseif ($x < 1000000000) {
            return Terbilang($x / 1000000).' juta'.Terbilang($x % 1000000);
        }
    }

    ?>



</head>



<!--<body onload="icetak()">-->





<body onload="icetak()">



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

$outlet = $_GET['outlet'];

    $gtampil = mysql_query("SELECT * FROM informasi_perusahaan where id_informasi_perusahaan = '1'");

    $g = mysql_fetch_array($gtampil);

if ($g['pict']) {
    $pict = $g['pict'];
} else {
    $pict = '';
}

$company = ucwords($g['company']);

    $otampil = mysql_query("SELECT * FROM  outlet where id_outlet = '$outlet'");

    $o = mysql_fetch_array($otampil);

    ?>



<table width='100%' style="padding-top:10px;">

<!-- <tr>

<td width='10%'>

<img src="../../images/logo/<?php echo $pict; ?>" width='150px'>

</td>

</tr> -->

<tr>

<td style="text-align:center;" width='100%'>

<?php echo "<br><span class='h1'>".$nmmodule.'</span><br>'; ?>
    
    <?php //echo "<span class='h3'>".$g['address']."<br>".$g['city']."</span>";?>

</td>

<td width='10%' >

&nbsp

</td>

</tr>

</table>



<div style="border-bottom: 4px double black;width:100%;">&nbsp</div>

<br>

<?php

    $prd = $_GET['prd'];

    $notrans = $_GET['notrans'];

    $kode = $_GET['kode'];

    $Outlet = $_GET['outlet'];

    $SQL = 'SELECT a.*,b.outlet,c.supplier,d.mata_uang,d.ket as cnote 

	 FROM pemesanan_barang a left join outlet b

     ON a.id_outlet = b.id_outlet

     AND b.aktif = "Y"  

     left join supplier c

     ON a.id_supplier = c.id_supplier

     AND c.aktif = "Y"

     left join mata_uang d

     ON a.id_mata_uang = d.id_mata_uang

     AND d.aktif = "Y"

     WHERE a.prd = "'.$prd.'"

     and a.notrans = "'.$notrans.'"

     and a.kode = "'.$kode.'"

     and a.id_outlet = "'.$outlet.'"

     ';

    $tampil = mysql_query($SQL);

    $r = mysql_fetch_array($tampil);

    $curr = $r['mata_uang'];

    $mata_uang = $r['id_mata_uang'];

    $cnote = $r['cnote'];

    $tgl = date('d/m/Y', strtotime($r['tanggal']));

    if ($r['status'] == '0') {
        $istatus = 'Baru';
    } elseif ($r['status'] == '1') {
        $istatus = 'Disetujui';
    } elseif ($r['status'] == '2') {
        $istatus = 'Ditolak';
    } elseif ($r['status'] == '9') {
        $istatus = 'Posting';
    } else {
        $istatus = 'Dibatalkan';
    }

    ?>



<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0px;padding-top: 0px;">

<tr>

<td rowspan='4' valign="top" width="50%">

<?php echo "<span style='padding-top:4px;font-weight:bold;'>".$g['company'].'</span><br>'; ?>
    
    <?php echo "<span style='padding-top:8px;'>".$g['address'].' '.$g['city'].'</span><br>'; ?>
    
    <?php echo "<span style='padding-top:4px;'>".$g['state'].' - '.$g['zip'].'</span><br>'; ?>
    
    <?php echo "<span style='padding-top:4px;'>Telepon : ".$g['Telepon'].' | Fax : '.$g['fax'].'</span><br>'; ?>
    
    <?php echo "<span style='padding-top:4px;'>NPWP : ".$g['npwp'].'</span><br>'; ?>

<td>

<td style="text-align:right;" width="50%"  >

<?php

        echo"<table width='100%' border=0 cellpadding=0 cellspacing=0>";

        echo'<tr>';

        echo"<td width='72%' style='text-align:right;'>No. Pemesanan</td>";

        echo"<td width='1%'>:</td>";

        echo"<td width='27%' style='text-align:left;'>".$r['kode'].''.$r['notrans'].'</td>';

        echo'</tr>';

        echo'</table>';

    ?>	

</td>

<tr>

<td style="text-align:right;" width="50%" colspan="2">

 <?php

        echo"<table width='100%' border=0 cellpadding=0 cellspacing=0>";

        echo'<tr>';

        echo"<td width='72%' style='text-align:right;'>Tanggal</td>";

        echo"<td width='1%'>:</td>";

        echo"<td width='27%' style='text-align:left;'>".$tgl.'</td>';

        echo'</tr>';

        echo'</table>';

    ?>	

</td>

</tr>



<tr>

<td style="text-align:right;" width="50%" colspan="2">

<?php

        echo"<table width='100%' border=0 cellpadding=0 cellspacing=0>";

        echo'<tr>';

        echo"<td width='72%' style='text-align:right;'>Term</td>";

        echo"<td width='1%'>:</td>";

        echo"<td width='27%' style='text-align:left;'>".$r['term'].' Hari</td>';

        echo'</tr>';

        echo'</table>';

    ?>	

</td>

</tr>

</table>



<br>



<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0px;padding-top: 0px;">

<tr>

<td valign="top" width="50%" style="border-top:1px black solid;border-left:1px black solid;border-bottom:1px black solid;">

<?php

    $sSQL = 'SELECT c.*

	 FROM pemesanan_barang a left join outlet b

     ON a.id_outlet = b.id_outlet

     AND b.aktif = "Y"  

     left join supplier c

     ON a.id_supplier = c.id_supplier

     AND c.aktif = "Y"

     left join mata_uang d

     ON a.id_mata_uang = d.id_mata_uang

     AND d.aktif = "Y"

     WHERE a.prd = "'.$prd.'"

     and a.notrans = "'.$notrans.'"

     and a.kode = "'.$kode.'"

     and a.id_outlet = "'.$outlet.'"

     ';

    $stampil = mysql_query($sSQL);

    $s = mysql_fetch_array($stampil);

    ?>

 <table width="100%" cellpadding='0' cellspacing='0' border="0">

        <tr><td width="30%">Supplier</td><td width="1%">:</td><td><?php echo $s['supplier']?></td></tr>

        <tr><td>Alamat</td><td>:</td><td><?php echo $s['address'].'<br>'.$s['city'].'<br>'.$s['state'].' - '.$s['zip']?> 

        </td>        

        </tr>

        <tr><td width="30%">Telepon</td><td width="1%">:</td><td><?php echo $s['phone']; ?></td></tr>

</table>        

</td>

<td style="text-align:right;border:1px black solid;" width="50%" >

<?php

    $cSQL = 'SELECT b.*

	 FROM pemesanan_barang a left join outlet b

     ON a.id_outlet = b.id_outlet

     AND b.aktif = "Y"  

     left join supplier c

     ON a.id_supplier = c.id_supplier

     AND c.aktif = "Y"

     left join mata_uang d

     ON a.id_mata_uang = d.id_mata_uang

     AND d.aktif = "Y"

     WHERE a.prd = "'.$prd.'"

     and a.notrans = "'.$notrans.'"

     and a.kode = "'.$kode.'"

     and a.id_outlet = "'.$outlet.'"

     ';

    $ctampil = mysql_query($cSQL);

    $c = mysql_fetch_array($ctampil);

    ?>

 <table width="100%" cellpadding='0' cellspacing='0'>

        <tr><td width="40%" style="text-align:left;">Tujuan Pengiriman </td>

        <td width="1%">:</td>

        <td style="text-align:left;"><?php echo $c['outlet']?></td></tr>

        <tr><td style="text-align:left;">Alamat</td>

        <td>:</td>

        <td style="text-align:left;"><?php echo $c['address'].'<br>'.$c['city'].'<br>'.$c['zip'].' - '.$c['zip']?>         	

        </td></tr>

        <tr><td width="40%" style="text-align:left;">Telepon </td>

        <td width="1%">:</td>

        <td style="text-align:left;"><?php echo $c['phone']?></td></tr>

</table> 

</td>

</tr>

</table>



<br>



<table cellpadding="0" width='100%' cellspacing="0" border="0" >

<tr><td colspan="7" style="text-align:right;"> Mata Uang : <?php echo $curr?></td></tr>

 <tr>

     <th  width='2%' class="fborder" style="text-align: center">No.</th> 

     <th class="iborder">Barang</th> 

     <th width='10%'  class="iborder" style="text-align: right">Qty</th> 

     <th width='10%'  class="iborder">Satuan</th>                  

     <th width='15%'  class="iborder" style="text-align: right">Harga</th> 

     <?php if ($mata_uang == '1') {
        ?> 

     <th width='15%'  class="lborder" style="text-align: right">Total</th>

     <?php
    } else {
        ?>

     <th width='10%'  class="iborder" style="text-align: right">Total (<?php echo $curr; ?>)</th>

     <th width='10%'  class="lborder" style="text-align: right">Total (IDR)</th>

     <?} ?> 



 </tr>



<?php


    $dSQL = "SELECT a.*,c.unit_barang,b.kode as kode_bar,b.barang

         FROM pemesanan_barang_detail a inner join barang b

         ON a.id_barang = b.id_barang

         INNER JOIN unit_barang c

         ON b.id_unit_barang = c.id_unit_barang 

         WHERE a.prd = '$prd' and a.notrans = '$notrans'

         and a.status != '4' and a.kode = '$kode'

         and a.id_outlet = '$outlet'

         ORDER BY a.seqno

         ";

        $dtampil = mysql_query($dSQL);

        $no = 1;

        while ($d = mysql_fetch_array($dtampil)) {
            $d_id = $d['id_pemesanan_barang_detail'];

            $ibarang = $d['kode_bar'].'&nbsp&nbsp&nbsp&nbsp'.$d['barang'];

            $iqty = number_format($d['qty'], 2, '.', ',');

            $qty = number_format($d['qty'], 2, '.', '');

            $harga = number_format($d['harga'], 0, '.', ',');

            $total = number_format($d['total'], 0, '.', ',');

            $ctotal = number_format($d['ctotal'], 2, '.', ',');

            echo'<tr>';

            echo" <td class='border' style='text-align: center;'>";

            echo $no.'.';

            echo'</td>';

            echo" <td class='border'>";

            echo $ibarang;

            echo'</td>';

            echo" <td  class='border' style='text-align:right;'>";

            echo $iqty;

            echo'</td>';

            echo" <td class='border'>";

            echo $d['unit_barang'];

            echo'</td>';

            echo" <td  class='border' style='text-align:right;'>";

            echo $harga;

            echo'</td>';

            if ($mata_uang == '1') {
                echo" <td  class='border' style='text-align:right;'>";

                echo $total;

                echo'</td>';
            } else {
                echo" <td  class='border' style='text-align:right;'>";

                echo $ctotal;

                echo'</td>';

                echo" <td  class='border' style='text-align:right;'>";

                echo $total;

                echo'</td>';
            }

            $no++;
        }

        if ($no < 10) {
            while ($no < 10) {
                echo '<tr>';

                echo'<td colspan=4>&nbsp</td>';

                echo'</tr>';

                $no++;
            }
        }

        $sql = mysql_query("SELECT * FROM pemesanan_barang 

                        WHERE prd = '$prd' and notrans = '$notrans' and kode = '$kode'

                        and id_outlet = '$outlet'

                        ");

        $r = mysql_fetch_array($sql);

        $total = number_format($r['total'], 0, '.', ',');

        $ppn = number_format($r['totaltax'], 0, '.', ',');

        $gtotal = number_format($r['gtotal'], 0, '.', ',');

        $igtotal = $r['gtotal'];

        $ctotal = number_format($r['ctotal'], 2, '.', ',');

        $cppn = number_format($r['ctotaltax'], 2, '.', ',');

        $cgtotal = number_format($r['cgtotal'], 2, '.', ',');

        $icgtotal = $r['cgtotal'];

        if ($mata_uang == '1') {
            $rterbilang = ucwords(Terbilang($igtotal)).' Rupiah';
        } else {
            $rterbilang = ucwords(Terbilang($icgtotal)).' '.$cnote;
        }

        echo'<tr>';

        echo"<td colspan='3' rowspan='3' style='border:1px black solid;padding-left:10px;'><br>#".$rterbilang.' #</td>'; ?>





<td></td>

<td style="text-align:left;border-bottom:1px black solid;">

TOTAL

</td>

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $ctotal; ?>



</td>

<?php if ($mata_uang != '1') {
            ?> 

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $total; ?>

</td>

<?php
        } ?> 	

</tr>



<tr>

<td></td>

<td style="text-align:left;border-bottom:1px black solid;">

<?php

    $pg_sql = mysql_query('SELECT * FROM pg_lainnya');

        $pg = mysql_fetch_array($pg_sql);

        $ippn = $pg['ppn']; ?>

PPN <?php echo $ippn; ?> %

</td>

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $cppn; ?>

</td>

<?php if ($mata_uang != '1') {
            ?> 

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $ppn; ?>

</td>

<?php
        } ?> 

</tr>



<tr>

<td></td>

<td style="text-align:left;border-bottom:1px black solid;">

GRAND TOTAL

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $cgtotal; ?>

</td>

<?php if ($mata_uang != '1') {
            ?> 

<td style="text-align:right;border-bottom:1px black solid;">

<?php echo $gtotal; ?>

</td>

<?php
        } ?> 

</tr>



<tr><td colspan="6"><br>Catatan : <?php echo $r['note']; ?></td></tr>

</table>

<br>

 <table width="100%">

	<?php


        $tanda_tangan = mysql_query("SELECT a.judul,a.penanda_tangan FROM tanda_tangan a LEFT JOIN kode_transaksi b 

							ON a.id_kode_transaksi = b.id_kode_transaksi

							WHERE b.kode = '$kode' AND a.aktif = 'Y'");

        $jml = mysql_num_rows($tanda_tangan);

        $cp = $jml + 1;

        $ps = 100 / $cp;

        $user = $_SESSION['userid']; ?> 

    

    <tr>

    <td colspan="<?php echo $cp?>">&nbsp</td>

    </tr>

    

    <tr>

    <td align="center" width="<?php echo $ps?>%">Dibuat Oleh,</td>

    

    <?php while ($s = mysql_fetch_array($tanda_tangan)) {
            ?>

    <td align="center" width="<?php echo $ps?>%" valign="bottom"><?php echo $s['judul']?></td>

     <?php
        } ?>

    

    </tr>

   

    

    <tr>

    <td align="center" width="<?php echo $ps?>%" style="padding-top:60px;">(<span style="padding-left:10px; padding-right:10px;";><?php echo $user?></span>)</td>

    <?php

        $tanda_tangan = mysql_query("SELECT a.judul,a.penanda_tangan FROM tanda_tangan a LEFT JOIN kode_transaksi b 

							ON a.id_kode_transaksi = b.id_kode_transaksi

							WHERE b.kode = '$kode' AND a.aktif = 'Y'"); ?>    

    <?php while ($s = mysql_fetch_array($tanda_tangan)) {
            ?>

    <td align="center" width="<?php echo $ps?>%" valign="bottom" style="padding-top:60px;">(<span style="padding-left:10px; padding-right:10px;";><?php echo $s['penanda_tangan']?></span>)</td>

    <?php
        } ?>

    </tr>

    

    </table>

    

    <br><br><br>

    <div>Status Dokumen : <?php echo $istatus; ?></div>



</body></html>

<?php
    }
