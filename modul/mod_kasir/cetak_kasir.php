    <?php

    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
        ob_start('ob_gzhandler');
    } else {
        ob_start();
    }

    include './../../config/koneksi.php';

    $report_id = $_GET[report_id];
    $tampil = mysql_query("SELECT * FROM modul WHERE id_modul ='".$report_id."'");

    $r = mysql_fetch_array($tampil);

    //module=$module&report_id=$report_id&k_ID=$k_ID

    $module = $_GET['module'];

    $imodule = ucwords($r['nama_modul']);

    $nmmodule = ucwords($r['nama_modul']);

    $id = $r['id_modul'];

    $fa_icon = $r['fa_icon'];

    $k_ID = $_GET['k_ID'];

    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
<title><?php echo $imodule; ?> (<?php echo $ifdate; ?> - <?php echo $ildate; ?>)</title>

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
    @page { size: portrait;  margin-top: 10px; margin-bottom: 0px; margin-left: 10px;}
    body { margin-top: 10px; margin-bottom: 0px;margin-left: 10px;}
    .dataTables_wrapper .dt-buttons{display:none}
    .print{display:none}
  }

  th {
    text-align: center;
    font-size : 13px;   
  }

  td {
    font-size : 13px;   
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
        <button class='print pull-right' onclick="window.open('ecetak_kasir.php?k_ID=<?=$k_ID; ?>&report_id=<?=$report_id; ?>', '_blank')"><i class="fa fa-lg fa-file-excel-o"></i> Excel</button>
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

      <table width="100%">
      <tr>
      <td style="text-align: center;" colspan="3"><h3 ><?=$company; ?><br><?=$nmmodule; ?></h3></td>
      </tr>
       <tr><td>&nbsp</td></tr>
       <tr>
        <td width="20%" style="font-size: 11px;">Tanggal : <?=$tanggal; ?></td>
        <td width="2%">&nbsp&nbsp</td>
        <td style="font-size: 11px;">Shift : <?=$shift; ?></td>
        </tr>
        <tr><td>&nbsp</td></tr>
      </table>

    

      <table id="itable" class="table table-bordered table-striped table-hover" width="100%">
          <thead>
            <tr>
               <th rowspan="2" width="1%">No.</th>  
               <th rowspan="2">No.Kwitansi</th>  
               <th rowspan="2">Nama Pasien</th> 
               <th colspan="6">Nilai Transaksi</th>                     
               <th colspan="2">Jenis Pembayaran</th> 
               <th rowspan="2">Keterangan</th> 
            </tr> 

            <tr>
               <?php

                $itampil = mysql_query("SELECT * FROM jenis_transaksi where aktif = 'Y' ORDER BY id_jenis_transaksi");

                while ($i = mysql_fetch_array($itampil)) {
                    echo "<th>$i[jenis_transaksi]</th>";
                }
                ?>

               <?php

                $itampil = mysql_query("SELECT * FROM jenis_pembayaran where aktif = 'Y' ORDER BY id_jenis_pembayaran");

                while ($i = mysql_fetch_array($itampil)) {
                    echo "<th>$i[jenis_pembayaran]</th>";
                }
                ?>


            </tr> 


          </thead>

           

          <tbody>
            <?php

                $dSQL = "SELECT a.notrans, a.pasien , a.id_jenis_pembayaran, c.penjamin,d.jenis_pembayaran , sum(a.jumlah) as jumlah 

                     FROM kasir_detail a LEFT JOIN jenis_transaksi b

                     ON a.id_jenis_transaksi = b.id_jenis_transaksi

                     left join penjamin c

                     ON a.id_penjamin = c.id_penjamin

                     left join jenis_pembayaran d

                     ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                     WHERE a.id_kasir = '$k_ID'

                     AND a.status <> '4'

                     group by a.notrans, a.pasien , a.id_jenis_pembayaran, c.penjamin,d.jenis_pembayaran

                     ";

                $dtampil = mysql_query($dSQL);

                $no = 1;

                while ($d = mysql_fetch_array($dtampil)) {
                    $d_id = $d['id_kasir_detail'];

                    $ijumlah = number_format($d['jumlah'], 0, '.', ',');

                    $jumlah = number_format($d['jumlah'], 0, '.', '');

                    $total = $total + $d['jumlah'];

                    $itotal = number_format($total, 0, '.', ',');

                    echo'<tr>';

                    echo' <td>';

                    echo $no;

                    echo'</td>';

                    echo' <td>';

                    echo $d['notrans'];

                    echo'</td>';

                    echo' <td>';

                    echo $d['pasien'];

                    echo'</td>';

                    $itampil = mysql_query("SELECT * FROM jenis_transaksi where aktif = 'Y' ORDER BY id_jenis_transaksi");

                    while ($i = mysql_fetch_array($itampil)) {
                        $jtampil = mysql_query("SELECT b.jumlah FROM kasir a INNER JOIN kasir_detail b 
                                         ON a.id_kasir = b.id_kasir 
                                         where a.tanggal = '$r[tanggal]'
                                         AND a.id_shift  = '$r[id_shift]'
                                         AND b.notrans  = '$d[notrans]'
                                         AND b.id_jenis_transaksi  = '$i[id_jenis_transaksi]'
                                         AND b.status <> '4'
                                         ");

                        $j = mysql_fetch_array($jtampil);

                        if ($j[jumlah]) {
                            $jml = number_format($j['jumlah'], 0, '.', ',');
                        } else {
                            $jml = 0;
                        }

                        echo "<td  style='text-align:right;'>$jml</td>";
                    }

                    $itampil = mysql_query("SELECT * FROM jenis_pembayaran where aktif = 'Y' ORDER BY id_jenis_pembayaran");

                    while ($i = mysql_fetch_array($itampil)) {
                        $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                         FROM kasir_detail a LEFT JOIN jenis_transaksi b

                         ON a.id_jenis_transaksi = b.id_jenis_transaksi

                         left join penjamin c

                         ON a.id_penjamin = c.id_penjamin

                         left join jenis_pembayaran d

                         ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                         LEFT JOIN kasir k 

                         ON a.id_kasir = k.id_kasir

                         where k.tanggal = '$r[tanggal]'
                                         
                         AND k.id_shift  = '$r[id_shift]'
                                         
                         AND a.notrans  = '$d[notrans]'

                         AND a.id_jenis_pembayaran = '$i[id_jenis_pembayaran]'

                         AND a.status <> '4'

                         ";

                        $ptampil = mysql_query($pSQL);

                        $p = mysql_fetch_array($ptampil);

                        if ($p[jumlah]) {
                            $jml = number_format($p['jumlah'], 0, '.', ',');
                        } else {
                            $jml = 0;
                        }

                        echo"<td  style='text-align:right;'>$jml </td>";
                    }

                    echo' <td>';

                    $jtampil = mysql_query("SELECT b.ket  FROM kasir a INNER JOIN kasir_detail b 
                                         ON a.id_kasir = b.id_kasir 
                                         where a.tanggal = '$r[tanggal]'
                                         AND a.id_shift  = '$r[id_shift]'
                                         AND b.notrans  = '$d[notrans]'
                                         ");

                    $j = mysql_fetch_array($jtampil);

                    echo $j[ket];

                    if ($d['penjamin']) {
                        echo'<br>'.'('.$d['penjamin'].')';
                    }

                    echo'</td>';

                    echo '</tr>';

                    $no++;
                }
                ?>
             </tbody> 

             <tfoot>
          

            <tr>
               <th></th>  
               <th>Total</th>  
               <th></th> 

               <?php

                            $itampil = mysql_query("SELECT * FROM jenis_transaksi where aktif = 'Y' ORDER BY id_jenis_transaksi");

                            while ($i = mysql_fetch_array($itampil)) {
                                $jtampil = mysql_query("SELECT sum(b.jumlah) as jumlah FROM kasir a INNER JOIN kasir_detail b 
                                                     ON a.id_kasir = b.id_kasir 
                                                     where a.tanggal = '$r[tanggal]'
                                                     AND a.id_shift  = '$r[id_shift]'
                                                     AND b.id_jenis_transaksi  = '$i[id_jenis_transaksi]'
                                                     AND b.status <> '4'
                                                     ");

                                $j = mysql_fetch_array($jtampil);

                                if ($j[jumlah]) {
                                    $jml = number_format($j['jumlah'], 0, '.', ',');
                                } else {
                                    $jml = 0;
                                }

                                echo "<th  style='text-align:right;'>$jml</th>";
                            }

                ?>        

                 <?php
                    $itampil = mysql_query("SELECT * FROM jenis_pembayaran where aktif = 'Y' ORDER BY id_jenis_pembayaran");

                    while ($i = mysql_fetch_array($itampil)) {
                        $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'
                                           
                           AND k.id_shift  = '$r[id_shift]'
                                           
                           AND a.id_jenis_pembayaran = '$i[id_jenis_pembayaran]'

                           AND a.status <> '4'

                           ";

                        $ptampil = mysql_query($pSQL);

                        $p = mysql_fetch_array($ptampil);

                        if ($p[jumlah]) {
                            $jml = number_format($p['jumlah'], 0, '.', ',');
                        } else {
                            $jml = 0;
                        }

                        echo"<th  style='text-align:right;'>$jml </th>";
                    }

                ?> 
       
               <th></th> 

            </tr> 

            <tr><td colspan="12">&nbsp</td></tr>  

            <?php 

                    if ($r[id_shift] == '1') {
                        $id_shift = '1';
                    } else {
                        $id_shift = '%';
                    }

                    $itampil = mysql_query("SELECT * FROM shift where aktif = 'Y' and id_shift LIKE '$id_shift' ORDER BY id_shift");

                    while ($i = mysql_fetch_array($itampil)) {
                        $shift = $i['shift']; ?>       

                    <tr>
                    <th></th>
                    <th></th>
                    <th colspan="3" style="text-align: left;">Total Seluruh Omzet 
                    <span style='text-transform: capitalize;'><?php echo ucfirst(strtolower(($shift))); ?></span></th>
                    <th style="text-align: left;">Cash</th>
                    <?php


                        $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'
                                           
                           AND k.id_shift  = '$i[id_shift]'

                           AND a.id_jenis_pembayaran = '1'
                                           
                           AND a.status <> '4'

                           ";

                        $ptampil = mysql_query($pSQL);

                        $p = mysql_fetch_array($ptampil);

                        if ($p[jumlah]) {
                            $cash = number_format($p['jumlah'], 0, '.', ',');
                        } else {
                            $cash = 0;
                        } ?>
                    <th style="text-align: right;"><?=$cash; ?></th>
                    <th style="text-align: left;">Credit</th>

                    <?php


                    $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'
                                           
                           AND k.id_shift  = '$i[id_shift]'

                           AND a.id_jenis_pembayaran = '3'
                                           
                           AND a.status <> '4'

                           ";

                        $ptampil = mysql_query($pSQL);

                        $p = mysql_fetch_array($ptampil);

                        if ($p[jumlah]) {
                            $credit = number_format($p['jumlah'], 0, '.', ',');
                        } else {
                            $credit = 0;
                        } ?>

                    <th style="text-align: right;"><?=$credit; ?></th>
                    <th colspan="4"></th>
                    </tr> 


               <?php
                    }

                ?> 

               <?php if ($id_shift == '%') {
                    ?>
               <tr>
                    <th></th>
                    <th></th>
                    <th colspan="3" style="text-align: left;">Total Omzet Tgl. <?=$tanggal; ?>  </th>
                    <th style="text-align: left;">Cash</th>
                    <?php


                        $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'
                                           

                           AND a.id_jenis_pembayaran = '1'
                                           
                           AND a.status <> '4'

                           ";

                    $ptampil = mysql_query($pSQL);

                    $p = mysql_fetch_array($ptampil);

                    if ($p[jumlah]) {
                        $cash = number_format($p['jumlah'], 0, '.', ',');
                    } else {
                        $cash = 0;
                    } ?>
                    <th style="text-align: right;"><?=$cash; ?></th>
                    <th style="text-align: left;">Credit</th>

                    <?php


                    $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'
                                           
                           AND a.id_jenis_pembayaran = '3'
                                           
                           AND a.status <> '4'

                           ";

                    $ptampil = mysql_query($pSQL);

                    $p = mysql_fetch_array($ptampil);

                    if ($p[jumlah]) {
                        $credit = number_format($p['jumlah'], 0, '.', ',');
                    } else {
                        $credit = 0;
                    } ?>

                    <th style="text-align: right;"><?=$credit; ?></th>
                    <th colspan="4"></th>
                    </tr> 

                <?php
                } ?>

                 <tr><td colspan="12">&nbsp</td></tr>  

                <tr>
                    <th style="border:none;">&nbsp</th>
                    <th colspan="5" style="text-align: left;">Pelunasan Piutang Dibayar Tunai Via Kasir</th>
                    <th  style="text-align: right;">Rp-</th>  
                     <th style="" colspan="6">&nbsp</th>  
                </tr>   

                <tr>
                     <th style="border:none;">&nbsp</th>
                     <th colspan="5" style="text-align: left;">Biaya Operasional Dikeluarkan Via Kasir</th>
                    <th  style="text-align: right;">Rp-</th>  
                     <th style="" colspan="6">&nbsp</th>  
                </tr>   

                <?php


                        $pSQL = "SELECT  sum(a.jumlah) as jumlah 

                           FROM kasir_detail a LEFT JOIN jenis_transaksi b

                           ON a.id_jenis_transaksi = b.id_jenis_transaksi

                           left join penjamin c

                           ON a.id_penjamin = c.id_penjamin

                           left join jenis_pembayaran d

                           ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

                           LEFT JOIN kasir k 

                           ON a.id_kasir = k.id_kasir

                           where k.tanggal = '$r[tanggal]'

                           AND k.id_shift like '$id_shift'
                                           
                           AND a.status <> '4'

                           ";

                        $ptampil = mysql_query($pSQL);

                        $p = mysql_fetch_array($ptampil);

                                if ($p[jumlah]) {
                                    $total = number_format($p['jumlah'], 0, '.', ',');
                                } else {
                                    $total = 0;
                                }

                ?>


                <tr>
                    <th style="border:none;">&nbsp</th>
                    <th colspan="5" style="text-align: left;">Disetorkan Ke Bendahara</th>
                    <th style="text-align: right;">Rp.<?=$total; ?></th>  
                    <th style="" colspan="6">&nbsp</th>  
                </tr>    

                     

          </tfoot>

        </table>

        <table width="100%">

         <tr>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="text-align: center;">Petugas Kasir</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="text-align: center;">Bendahara</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th colspan="2" style="text-align: center;">Mengetahui,</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
        </tr>    

        <tr>
                    <th style="border:none;" colspan="12"><br><br></th>
        </tr>    


        <tr>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="text-align: center;">(<?=$petugas; ?>)</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th style="text-align: center;">
                    (Endah)
                    </th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
                    <th colspan="2" style="text-align: center;">
                      (dr. Fitriani Susanti)                     
                    </th>
                    <th style="border:none;">&nbsp</th>
                    <th style="border:none;">&nbsp</th>
        </tr>    

        </table>


</body>


</html>




<?php  ?>