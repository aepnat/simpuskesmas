<?php

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
ob_start("ob_gzhandler");
}
else {
ob_start();
}


include "./../../config/koneksi.php";
//include "./../../config/fungsi_indobulan.php";

function getBulan1($bln1){

				switch ($bln1){

					case 1: 

						return "Januari";

						break;

					case 2:

						return "Februari";

						break;

					case 3:

						return "Maret";

						break;

					case 4:

						return "April";

						break;

					case 5:

						return "Mei";

						break;

					case 6:

						return "Juni";

						break;

					case 7:

						return "Juli";

						break;

					case 8:

						return "Agustus";

						break;

					case 9:

						return "September";

						break;

					case 10:

						return "Oktober";

						break;

					case 11:

						return "November";

						break;

					case 12:

						return "Desember";

						break;

				}

			} 

$report_id = $_GET[report_id];
$tampil=mysql_query("SELECT * FROM modul WHERE id_modul ='".$report_id."'");

            

$r=mysql_fetch_array($tampil);

//module=$module&report_id=$report_id&k_ID=$k_ID

$module   = $_GET['module'];

$imodule  = ucwords($r['nama_modul']);

$nmmodule   = ucwords($r['nama_modul']);

$id       = $r['id_modul'];

$fa_icon    = $r['fa_icon'];


$prd  = $_GET['prd'];

$iprd  = $_GET['prd'].'-01';

$nm_month = DATE('F Y',strtotime($iprd));

$year = DATE('Y',strtotime($iprd));
$month = DATE('m',strtotime($iprd))*1;

$nprd = getBulan1($month).' '.$year;





$id_jenis_transaksi  = $_GET['jenis_transaksi'];
$jenis_transaksi  = $_GET['jenis_transaksi'];
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
<title><?php echo $imodule ;?> (<?php echo $nprd;?>)</title>

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
    @page { size: landscape;  margin-top: 10px; margin-bottom: 0px; margin-left: 10px;}
    body { margin-top: 10px; margin-bottom: 0px;margin-left: 10px;}
    .dataTables_wrapper .dt-buttons{display:none}
    .print{display:none}
  }

  th {
    text-align: center;
    font-size : 9px;   
  }

  td {
    font-size : 9px;   
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
        <button class='print pull-right' onclick="window.open('eprint_report_rekap_harian.php?prd=<?=$prd;?>&jenis_transaksi=<?=$id_jenis_transaksi;?>&report_id=<?=$report_id;?>', '_blank')"><i class="fa fa-lg fa-file-excel-o"></i> Excel</button>
      </div>   

      <?

       $gtampil=mysql_query("SELECT * FROM informasi_perusahaan where id_informasi_perusahaan = '1'");

       $g=mysql_fetch_array($gtampil);



      if ($g['pict']) {

        $pict = $g['pict'];

      } else {

        $pict = '';

      }


      $company = ucwords($g['company']);

      $jsql   = mysql_query("SELECT * FROM jenis_transaksi
                            WHERE id_jenis_transaksi = '$jenis_transaksi' 

                           ");



      $j     = mysql_fetch_array($jsql); 

      $jenis_transaksi   = $j['jenis_transaksi'];  


      $sql   = mysql_query("SELECT a.*,b.shift FROM kasir  a LEFT JOIN shift b 
                            ON a.id_shift = b.id_shift
                            WHERE a.id_kasir = '$k_ID' 

                           ");



      $r     = mysql_fetch_array($sql); 


      $penjualan_barang   = $r['id_kasir'];  

      $shift   = $r['shift'];  

      $petugas   = $r['petugas'];  

      $status   = $r['status']; 

      $tanggal   = DATE('d/m/Y',strtotime($r['tanggal']));  

      ?>

      <table width="100%">
      <tr>
      <td style="text-align: center;" colspan="3">
      <h4 ><?=$company;?>
      <br>
      <?=$nmmodule;?>
      <br>
      <?=$jenis_transaksi;?> PER : <?php echo $nprd;?>
      </h4></td>
      </tr>      
      </table>

    

      <table id="itable" class="table table-bordered table-striped table-hover" width="100%">
          <thead>
            <tr>
               <th rowspan="2" >TGL</th>  

               <?

                $htampil=mysql_query("SELECT * FROM penjamin where aktif = 'Y' ORDER BY id_penjamin");

                $hjml = mysql_num_rows($htampil);
          
                while ($h=mysql_fetch_array($htampil)){  

                	echo "<th colspan='2'>".$h['penjamin']."</th>";

                } 	

               ?> 	

               <th colspan ="4" >UMUM</th>  
               <th rowspan="2" >PIC</th>  
               <th rowspan="2" >NO</th>  
               <th rowspan="2" >TGL</th>  
               <th colspan ="3" >REVISI / KOREKSI</th>  
               <th rowspan="2" >JML</th>  
               <th colspan ="2" >TOTAL (RP)</th>  

            </tr> 

            <tr>

               <? 
               	for($j = 1; $j <= $hjml; $j++)  { 

               		echo "<th>JML</th>";  
               		echo "<th>RUPIAH</th>";  


               	 }	
               ?>	


               <th>JML</th>  
               <th>RUPIAH</th>  
               <th>JML</th>  
               <th>CARD</th>  

               <th>KETERANGAN</th>  
               <th>JML</th>  
               <th>RUPIAH</th>

               <th>RUPIAH</th>  
               <th>CARD</th>


            </tr>   
      	</thead>

      	<tbody>

      	  <? for($i = 1; $i <= 31; $i++)  { 

      	  	 echo"<tr>";

             echo"<td style='text-align:center;'>$i</td>"; 

             if (strlen($i) == '1') {
             	$tgl = $prd.'-0'.$i;
             } else {
             	$tgl = $prd.'-'.$i;
             }

             //transaksi asuransi
             $dtampil1=mysql_query("SELECT a.id_penjamin
										,	COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM penjamin a LEFT JOIN kasir b
									ON  b.tanggal = '$tgl'
									AND b.status != '4'
									LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND C.status != '4'
									AND a.id_penjamin = c.id_penjamin
									AND c.id_jenis_pembayaran = '3'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE a.aktif = 'Y'                  
									GROUP BY a.id_penjamin
									ORDER BY a.id_penjamin");

          
             while ($d1=mysql_fetch_array($dtampil1)){  


              	echo "<th>".$d1['jml']."</th>";
              	echo "<th style='text-align:right;'>".number_format($d1['rp'], 0, ".", ",")."</th>";

             } 	

              //transaksi umum tunai
              $dtampil2=mysql_query("SELECT COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND c.id_jenis_pembayaran = '1'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal = '$tgl'
									AND b.status != '4'");
                       
             $d2=mysql_fetch_array($dtampil2);


             echo "<th>".$d2['jml']."</th>";
             echo "<th style='text-align:right;'>".number_format($d2['rp'], 0, ".", ",")."</th>";


              //transaksi umum tunai
              $dtampil3=mysql_query("SELECT COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND c.id_jenis_pembayaran = '2'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal = '$tgl'
									AND b.status != '4'");
                       
             $d3=mysql_fetch_array($dtampil3);


             echo "<th>".$d3['jml']."</th>";
             echo "<th style='text-align:right;'>".number_format($d3['rp'], 0, ".", ",")."</th>";

             echo "<th></th>";          	
             echo "<th></th>";
             echo "<th></th>";

             echo "<th></th>";          	
             echo "<th></th>";
             echo "<th></th>";

             //total jml
              $dtampil4=mysql_query("SELECT COUNT(c.jumlah) as jml 
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal = '$tgl'
									AND b.status != '4'");
                       
             $d4=mysql_fetch_array($dtampil4);


             echo "<th>".$d4['jml']."</th>";

             //total pembayaran
             $dtampil5=mysql_query("SELECT a.groups
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM jenis_pembayaran a LEFT JOIN kasir b
									ON  b.tanggal = '$tgl'
									AND b.status != '4'
									LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND a.id_jenis_pembayaran = c.id_jenis_pembayaran
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									GROUP BY a.groups
									ORDER BY a.groups");
                       
             while ($d5=mysql_fetch_array($dtampil5)){  


              	echo "<th style='text-align:right;'>".number_format($d5['rp'], 0, ".", ",")."</th>";

             } 	




             echo"</tr>";


      	  } ?>

      	</tbody>

      	<? 

      	  	 echo"<tr>";

             echo"<th style='text-align:center;'>TOTAL</th>"; 

      

             //transaksi asuransi
             $dtampil1=mysql_query("SELECT a.id_penjamin
										,	COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM penjamin a LEFT JOIN kasir b
									ON  b.tanggal LIKE '$prd%'
									AND b.status != '4'
									LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND C.status != '4'
									AND a.id_penjamin = c.id_penjamin
									AND c.id_jenis_pembayaran = '3'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE a.aktif = 'Y'
									GROUP BY a.id_penjamin
									ORDER BY a.id_penjamin");
                       
             while ($d1=mysql_fetch_array($dtampil1)){  


              	echo "<th>".$d1['jml']."</th>";
              	echo "<th style='text-align:right;'>".number_format($d1['rp'], 0, ".", ",")."</th>";

             } 	

              //transaksi umum tunai
              $dtampil2=mysql_query("SELECT COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND c.id_jenis_pembayaran = '1'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									AND  b.tanggal LIKE '$prd%'
									AND b.status != '4'");
                       
             $d2=mysql_fetch_array($dtampil2);


             echo "<th>".$d2['jml']."</th>";
             echo "<th style='text-align:right;'>".number_format($d2['rp'], 0, ".", ",")."</th>";


              //transaksi umum tunai
              $dtampil3=mysql_query("SELECT COUNT(c.jumlah) as jml 
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND c.id_jenis_pembayaran = '2'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal LIKE '$prd%'
									AND b.status != '4'");
                       
             $d3=mysql_fetch_array($dtampil3);


             echo "<th>".$d3['jml']."</th>";
             echo "<th style='text-align:right;'>".number_format($d3['rp'], 0, ".", ",")."</th>";

             echo "<th></th>";          	
             echo "<th></th>";
             echo "<th></th>";

             echo "<th></th>";          	
             echo "<th></th>";
             echo "<th></th>";

             //total jml
              $dtampil4=mysql_query("SELECT COUNT(c.jumlah) as jml 
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal LIKE '$prd%'
									AND b.status != '4'");
                       
             $d4=mysql_fetch_array($dtampil4);


             echo "<th>".$d4['jml']."</th>";

             //total pembayaran
             $dtampil5=mysql_query("SELECT a.groups
										,	IFNULL(SUM(c.jumlah),0) as rp  
									FROM jenis_pembayaran a LEFT JOIN kasir b
									ON  b.tanggal LIKE '$prd%'
									AND b.status != '4'
									LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
									AND a.id_jenis_pembayaran = c.id_jenis_pembayaran
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									GROUP BY a.groups
									ORDER BY a.groups");
                       
             while ($d5=mysql_fetch_array($dtampil5)){  


              	echo "<th style='text-align:right;'>".number_format($d5['rp'], 0, ".", ",")."</th>";

             } 	




             echo"</tr>";

             echo"<tr>";

             echo"<th style='text-align:center;' colspan='23'>TOTAL REVENUE</th>"; 

             //total jml
              $dtampil4=mysql_query("SELECT COUNT(c.jumlah) as jml 
									FROM kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal LIKE '$prd%'
									AND b.status != '4'");
                       
             $d4=mysql_fetch_array($dtampil4);


             echo "<th>".$d4['jml']."</th>";

             //total pembayaran
             $dtampil5=mysql_query("SELECT IFNULL(SUM(c.jumlah),0) as rp  
									FROM  kasir b LEFT JOIN kasir_detail c
									ON  b.id_kasir = c.id_kasir
									AND c.status != '4'
                  AND c.id_jenis_transaksi = '$id_jenis_transaksi'
									WHERE b.tanggal LIKE '$prd%'
									AND b.status != '4'");
                       
             $d5=mysql_fetch_array($dtampil5);


              	echo "<th style='text-align:right;' colspan='2'>".number_format($d5['rp'], 0, ".", ",")."</th>";

            	

      	  ?>



    </table> 	

    <? 

    $lastday = DATE('t',strtotime($iprd));

    $year = DATE('Y',strtotime($iprd));

    $month = DATE('m',strtotime($iprd))*1;

    if ($month == '1') {
    	$imonth = 12;
    } else {
    	$imonth = $month-1;
    }

	$nprd = $lastday.' '.getBulan1($imonth).' '.$year;
	?>

    <table width="100%">
    	<tr>
    		<td width="70%">Bekasi, <?=$nprd;?></td>
    		<td width="30%">Mengetahui,</td>
    	</tr>
    	<tr>
    		<td width="70%">Petugas</td>
    		<td width="30%">Penanggung Jawab</td>
    	</tr>
    	<tr>
    		<td width="70%"><br><br></td>
    		<td width="30%"><br></td>
    	</tr>
    	<tr>
    		<td width="70%">Ratih Dwiyanti</td>
    		<td width="30%">dr. Fitriani Susanti</td>
    	</tr>

    </table>



</body>


</html>




<?php  ?>