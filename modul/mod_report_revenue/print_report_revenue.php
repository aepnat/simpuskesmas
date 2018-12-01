<?php

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}

include './../../config/koneksi.php';
//include "./../../config/fungsi_indobulan.php";

function getBulan1($bln1)
{
    switch ($bln1) {

                    case 1:

                        return 'Januari';

                        break;

                    case 2:

                        return 'Februari';

                        break;

                    case 3:

                        return 'Maret';

                        break;

                    case 4:

                        return 'April';

                        break;

                    case 5:

                        return 'Mei';

                        break;

                    case 6:

                        return 'Juni';

                        break;

                    case 7:

                        return 'Juli';

                        break;

                    case 8:

                        return 'Agustus';

                        break;

                    case 9:

                        return 'September';

                        break;

                    case 10:

                        return 'Oktober';

                        break;

                    case 11:

                        return 'November';

                        break;

                    case 12:

                        return 'Desember';

                        break;

                }
}

$report_id = $_GET[report_id];
$tampil = mysql_query("SELECT * FROM modul WHERE id_modul ='".$report_id."'");

$r = mysql_fetch_array($tampil);

//module=$module&report_id=$report_id&k_ID=$k_ID

$module = $_GET['module'];

$imodule = ucwords($r['nama_modul']);

$nmmodule = ucwords($r['nama_modul']);

$id = $r['id_modul'];

$fa_icon = $r['fa_icon'];

$prd = $_GET['prd'];

$tipe = $_GET['tipe'];

$iprd = $_GET['prd'].'-01';

$nm_month = date('F Y', strtotime($iprd));

$year = date('Y', strtotime($iprd));
$month = date('m', strtotime($iprd)) * 1;

$nprd = getBulan1($month).' '.$year;

$jenis_transaksi = $_GET['jenis_transaksi'];

if ($tipe == 'R') {
    $kertas = 'portrait';
} else {
    $kertas = 'landscape';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
<title><?php echo $imodule; ?> (<?php echo $nprd; ?>)</title>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Bootstrap 3.3.6 -->
<script src="../../js/bootstrap.min.js"></script>

<!-- jQuery -->
<script src="../../js/jquery.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables/buttons.flash.min.js"></script>
<script src="../../plugins/datatables/jszip.min.js"></script>
<script src="../../plugins/datatables/pdfmake.min.js"></script>
<script src="../../plugins/datatables/vfs_fonts.js"></script>
<script src="../../plugins/datatables/buttons.html5.min.js"></script>
<script src="../../plugins/datatables/buttons.print.min.js"></script>


<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../fonts/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="../../css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../css/AdminLTE.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" href="../../plugins/datatables/buttons.dataTables.min.css">

<style type="text/css">

/*  @page { 
    size: <?=$orientation?>;  
  }*/

  @media print {
    @page { size: <?=$kertas; ?> ; margin-top: 10px; margin-bottom: 0px; margin-left: 10px;}
    body { margin-top: 10px; margin-bottom: 0px;margin-left: 10px;}
    .dataTables_wrapper .dt-buttons{display:none}
    .print{display:none}
  }

  th {
    text-align: center;
    /*font-size : 9px;   */
  }

  td {
    /*font-size : 9px;   */
  }

  .dataTables_wrapper .dt-buttons {
    /*float:none;  */
    text-align:right;*/
    padding-bottom: 14px;
  }

  .print {
    text-align: right;
    margin: 10px; 
    /*margin-left: 220px;*/
    /*position: absolute;*/
    
    height: 33px;
    padding   : 5px;  
  }

  @media print{

.noprint{display:none}

}


</style>

<script language="javascript" type="text/javascript">
function cetak(){
    window.print();
  /*window.close();*/
}

function icetak(){
    window.print();
  //setTimeout(function(){window.close();}, 1);
}

function idownload(){
  setTimeout(function(){window.close();}, 1);
}
</script>

</head>

<!-- <body onload="icetak()"> -->
<body>


      <div class="noprint"  >
        <button class='print pull-right' onclick="javascript:window.close()"><i class="fa fa-lg fa-close"></i> Close</button>
        <button class='print pull-right' onclick="icetak()"><i class="fa fa-lg fa-print"></i> Print</button>
        <button class='print pull-right' onclick="window.open('eprint_report_revenue.php?prd=<?=$prd; ?>&report_id=<?=$report_id; ?>&tipe=<?=$tipe; ?>', '_blank')"><i class="fa fa-lg fa-file-excel-o"></i> Excel</button>
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

        $jsql = mysql_query("SELECT * FROM jenis_transaksi
                            WHERE id_jenis_transaksi = '$jenis_transaksi' 
								

                           ");

        $j = mysql_fetch_array($jsql);

        $jenis_transaksi = $j['jenis_transaksi'];

        $sql = mysql_query("SELECT a.*,b.shift FROM kasir  a LEFT JOIN shift b 
                            ON a.id_shift = b.id_shift
                            WHERE a.id_kasir = '$k_ID' 

                           ");

        $r = mysql_fetch_array($sql);

        $penjualan_barang = $r['id_kasir'];

        $shift = $r['shift'];

        $petugas = $r['petugas'];

        $status = $r['status'];

        $tanggal = date('d/m/Y', strtotime($r['tanggal']));

        ?>

      <?php if ($tipe == 'R') {
            ?>


        <table width="100%">
          <tr>
          <td style="text-align: center;" colspan="3">
          <h4 >REVENUE <?=$company; ?>         
          <BR>
          PER : <?php echo $nprd; ?>
          </h4></td>
          </tr>      
        </table>

        <table id="itable" class="table table-bordered table-striped table-hover" width="100%">
            <thead>
              <tr>
                <th>POLY</th>  
                <th>TOTAL KUNJUNGAN</th>  
                <th>REVENUE</th>  
              </tr>  
            </thead>

            <tbody>

            <?php
            $htampil = mysql_query("SELECT * FROM jenis_transaksi where aktif = 'Y' AND id_jenis_transaksi != '6' ORDER BY id_jenis_transaksi");

            $hjml = mysql_num_rows($htampil);

            while ($h = mysql_fetch_array($htampil)) {
                echo '<tr>';
                echo '<td>'.$h['jenis_transaksi'].'</td>';

                //transaksi umum tunai
                $dtampil = mysql_query("SELECT COUNT(c.jumlah) as jml 
                            , IFNULL(SUM(c.jumlah),0) as rp  
                          FROM kasir b LEFT JOIN kasir_detail c
                          ON  b.id_kasir = c.id_kasir
                          AND c.status != '4'                          
                          WHERE b.tanggal like '$prd%'
                          AND c.id_jenis_transaksi = '".$h['id_jenis_transaksi']."'
                          AND b.status != '4'");

                $d = mysql_fetch_array($dtampil);

                echo '<th>'.$d['jml'].'</th>';
                echo "<th style='text-align:right;'>".number_format($d['rp'], 0, '.', ',').'</th>';

                echo '</tr>';
            } ?>        

            </tbody>

             <tr>
                <th>TOTAL</th>  
                 <?php
                    $dtampil = mysql_query("SELECT COUNT(c.jumlah) as jml 
                                  , IFNULL(SUM(c.jumlah),0) as rp  
                                FROM kasir b LEFT JOIN kasir_detail c
                                ON  b.id_kasir = c.id_kasir
                                AND c.status != '4'                          
                                WHERE b.tanggal like '$prd%'
                                AND b.status != '4'");

            $d = mysql_fetch_array($dtampil);

            echo '<th>'.$d['jml'].'</th>';
            echo "<th style='text-align:right;'>".number_format($d['rp'], 0, '.', ',').'</th>'; ?>        

              </tr>  


        </table>    

        <table width="100%">

          <tr>
            <td width="70%" style="padding-left: 50px;">Disiapkan oleh,</td>
            <td width="30%">Mengetahui,<br>Koordinator Klinik</td>
          </tr>
          <tr>
            <td width="70%"><br><br></td>
            <td width="30%"><br></td>
          </tr>
          <tr>
            <td width="70%" style="padding-left: 50px;">Ratih Dwiyanti</td>
            <td width="30%">dr. Fitriani Susanti</td>
          </tr>

        </table>




      <?php
        } else {
            ?>

          <table width="100%">
          <tr>
          <td style="text-align: center;" colspan="3">
          <h4 >REVENUE <?=$company; ?>         
          <BR>
          PER : <?php echo $nprd; ?>
          </h4></td>
          </tr>      
        </table>

          <table id="itable" class="table table-bordered table-striped table-hover" width="100%">
              <thead>
                <tr>
                   <th rowspan="3" >POLY</th>  

                   <?php

                    $htampil = mysql_query("SELECT * FROM penjamin where aktif = 'Y' ORDER BY id_penjamin");

            $hjml = mysql_num_rows($htampil);

            while ($h = mysql_fetch_array($htampil)) {
                echo "<th colspan='2' rowspan='2'>".$h['penjamin'].'</th>';
            } ?> 	
                 
                   <th colspan ="4" >UMUM</th>  
                   <th colspan ="2" rowspan='2'>TOTAL</th>  

                </tr> 

                <tr>
                <th colspan="2">CASH</th>  
                <th colspan="2">CARD</th>
                </tr>

                <tr>



                   <?php 
                        for ($j = 1; $j <= $hjml; $j++) {
                            echo '<th>KUNJ</th>';
                            echo '<th>REV</th>';
                        } ?>	


                   <th>KUNJ</th>  
                   <th>REV</th>
                   <th>KUNJ</th>  
                   <th>REV</th>
                   <th>KUNJ</th>  
                   <th>REV</th>


                </tr>   
          	</thead>

          	<tbody>

              <?php 

                $htampil = mysql_query("SELECT * FROM jenis_transaksi where aktif = 'Y' ORDER BY id_jenis_transaksi");

            $hjml = mysql_num_rows($htampil);

            while ($h = mysql_fetch_array($htampil)) {
                echo'<tr>';

                echo'<td>'.$h['jenis_transaksi'].'</td>';

                //transaksi asuransi
                $dtampil1 = mysql_query("SELECT a.id_penjamin
                          , COUNT(c.jumlah) as jml 
                          , IFNULL(SUM(c.jumlah),0) as rp  
                        FROM penjamin a LEFT JOIN kasir b
                        ON  b.tanggal LIKE '$prd%'
                        AND b.status != '4'
                        LEFT JOIN kasir_detail c
                        ON  b.id_kasir = c.id_kasir
                        AND C.status != '4'
                        AND a.id_penjamin = c.id_penjamin
                        AND c.id_jenis_pembayaran = '3'
                        AND c.id_jenis_transaksi = '".$h['id_jenis_transaksi']."'
                        WHERE a.aktif = 'Y'
                        GROUP BY a.id_penjamin
                        ORDER BY a.id_penjamin");

                while ($d1 = mysql_fetch_array($dtampil1)) {
                    echo "<td style='text-align:center;'>".$d1['jml'].'</td>';
                    echo "<td style='text-align:right;'>".number_format($d1['rp'], 0, '.', ',').'</td>';
                }

                $dtampil2 = mysql_query("SELECT COUNT(c.jumlah) as jml 
                                            ,   IFNULL(SUM(c.jumlah),0) as rp  
                                        FROM kasir b LEFT JOIN kasir_detail c
                                        ON  b.id_kasir = c.id_kasir
                                        AND c.status != '4'
                                        AND c.id_jenis_pembayaran = '1'
                                        WHERE b.tanggal LIKE '$prd%'
                      AND c.id_jenis_transaksi = '".$h['id_jenis_transaksi']."'
                                        AND b.status != '4'");

                $d2 = mysql_fetch_array($dtampil2);

                echo "<td style='text-align:center;'>".$d2['jml'].'</td>';
                echo "<td style='text-align:right;'>".number_format($d2['rp'], 0, '.', ',').'</td>';

                $dtampil3 = mysql_query("SELECT COUNT(c.jumlah) as jml 
                        , IFNULL(SUM(c.jumlah),0) as rp  
                      FROM kasir b LEFT JOIN kasir_detail c
                      ON  b.id_kasir = c.id_kasir
                      AND c.status != '4'
                      AND c.id_jenis_pembayaran = '2'
                      WHERE b.tanggal LIKE '$prd%'
                      AND c.id_jenis_transaksi = '".$h['id_jenis_transaksi']."'
                      AND b.status != '4'");

                $d3 = mysql_fetch_array($dtampil3);

                echo "<td style='text-align:center;'>".$d3['jml'].'</td>';
                echo "<td style='text-align:right;'>".number_format($d3['rp'], 0, '.', ',').'</td>';

                $dtampil = mysql_query("SELECT COUNT(c.jumlah) as jml 
                            , IFNULL(SUM(c.jumlah),0) as rp  
                          FROM kasir b LEFT JOIN kasir_detail c
                          ON  b.id_kasir = c.id_kasir
                          AND c.status != '4'                          
                          WHERE b.tanggal like '$prd%'
                          AND c.id_jenis_transaksi = '".$h['id_jenis_transaksi']."'
                          AND b.status != '4'");

                $d = mysql_fetch_array($dtampil);

                echo "<td style='text-align:center;'>".$d['jml'].'</td>';
                echo "<td style='text-align:right;'>".number_format($d['rp'], 0, '.', ',').'</td>';

                echo'</tr>';
            } ?>

            </tbody>



              <?php 

                    echo'<tr>';

            echo'<th>TOTAL</th>';

            //transaksi asuransi
            $dtampil1 = mysql_query("SELECT a.id_penjamin
                          , COUNT(c.jumlah) as jml 
                          , IFNULL(SUM(c.jumlah),0) as rp  
                        FROM penjamin a LEFT JOIN kasir b
                        ON  b.tanggal LIKE '$prd%'
                        AND b.status != '4'
                        LEFT JOIN kasir_detail c
                        ON  b.id_kasir = c.id_kasir
                        AND C.status != '4'
                        AND a.id_penjamin = c.id_penjamin
                        AND c.id_jenis_pembayaran = '3'
                        WHERE a.aktif = 'Y'
                        GROUP BY a.id_penjamin
                        ORDER BY a.id_penjamin");

            while ($d1 = mysql_fetch_array($dtampil1)) {
                echo '<th>'.$d1['jml'].'</th>';
                echo "<th style='text-align:right;'>".number_format($d1['rp'], 0, '.', ',').'</th>';
            }

            $dtampil2 = mysql_query("SELECT COUNT(c.jumlah) as jml 
                                            ,   IFNULL(SUM(c.jumlah),0) as rp  
                                        FROM kasir b LEFT JOIN kasir_detail c
                                        ON  b.id_kasir = c.id_kasir
                                        AND c.status != '4'
                                        AND c.id_jenis_pembayaran = '1'
                                        WHERE b.tanggal LIKE '$prd%'
                                        AND b.status != '4'");

            $d2 = mysql_fetch_array($dtampil2);

            echo '<th>'.$d2['jml'].'</th>';
            echo "<th style='text-align:right;'>".number_format($d2['rp'], 0, '.', ',').'</th>';

            $dtampil3 = mysql_query("SELECT COUNT(c.jumlah) as jml 
                        , IFNULL(SUM(c.jumlah),0) as rp  
                      FROM kasir b LEFT JOIN kasir_detail c
                      ON  b.id_kasir = c.id_kasir
                      AND c.status != '4'
                      AND c.id_jenis_pembayaran = '2'
                      WHERE b.tanggal LIKE '$prd%'
                      AND b.status != '4'");

            $d3 = mysql_fetch_array($dtampil3);

            echo '<th>'.$d3['jml'].'</th>';
            echo "<th style='text-align:right;'>".number_format($d3['rp'], 0, '.', ',').'</th>';

            $dtampil = mysql_query("SELECT COUNT(c.jumlah) as jml 
                            , IFNULL(SUM(c.jumlah),0) as rp  
                          FROM kasir b LEFT JOIN kasir_detail c
                          ON  b.id_kasir = c.id_kasir
                          AND c.status != '4'                          
                          WHERE b.tanggal like '$prd%'
                          AND b.status != '4'");

            $d = mysql_fetch_array($dtampil);

            echo '<th>'.$d['jml'].'</th>';
            echo "<th style='text-align:right;'>".number_format($d['rp'], 0, '.', ',').'</th>';

            echo'</tr>'; ?>

      

          



        </table> 	

        <?php 

        $lastday = date('t', strtotime($iprd));

            $year = date('Y', strtotime($iprd));

            $month = date('m', strtotime($iprd)) * 1;

            if ($month == '1') {
                $imonth = 12;
            } else {
                $imonth = $month - 1;
            }

            $nprd = $lastday.' '.getBulan1($imonth).' '.$year; ?>

      <table width="100%">

          <tr>
            <td width="70%" style="padding-left: 50px;">Disiapkan oleh,</td>
            <td width="30%">Mengetahui,<br>Koordinator Klinik</td>
          </tr>
          <tr>
            <td width="70%"><br><br></td>
            <td width="30%"><br></td>
          </tr>
          <tr>
            <td width="70%" style="padding-left: 50px;">Ratih Dwiyanti</td>
            <td width="30%">dr. Fitriani Susanti</td>
          </tr>

        </table>


       

    <?php
        } ?>

</body>


</html>




<?php  ?>