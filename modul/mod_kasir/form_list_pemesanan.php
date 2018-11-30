<?

session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['password'])){

  echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";

} else{

include "./../../config/koneksi.php";

include "./../../config/fungsi_thumb.php";

$idate    = date("Y-m-d");

?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Untitled Document</title>



  <script language="javascript">

       function selectPR(no_pr,id_permintaan_barang_detail,ibarang,id_barang,merk,unit_barang,iqty,qty,harga){

         window.parent.selectPR(no_pr,id_permintaan_barang_detail,ibarang,id_barang,merk,unit_barang,iqty,qty,harga);

         window.parent.tb_remove();

       }

      </script>





  <script src="../../js/jquery.min.js"></script>

  <link href='../../config/css/style.css' type='text/css' rel='stylesheet'>





    <link href="../../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery.min.js"></script>

    <script src="../../js/fileinput.js" type="text/javascript"></script>

    

    <link href="../../css/bootstrap.min.css" rel="stylesheet">



    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">

    <link href="../../css/animate.min.css" rel="stylesheet">



    <!-- Custom styling plus plugins -->

    <link href="../../css/custom.css" rel="stylesheet">

    <link href="../../css/icheck/flat/green.css" rel="stylesheet">

    <!-- editor -->

    

    <link href="../../css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">

    <link href="../../css/editor/index.css" rel="stylesheet">

    <!-- select2 -->

    <link href="../../css/select/select2.min.css" rel="stylesheet">

    <!-- switchery -->

    <link rel="stylesheet" href="../../css/switchery/switchery.min.css" />



    





  <style>



        .iavatar {

         /* position:fixed;

          right: 20px;*/

          text-align: center;

        }  



        .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {

          margin: 0;

          padding: 0;

          border: none;

          box-shadow: none;

          text-align: center;

        }

        .kv-avatar .file-input {

          display: table-cell;

          max-width: 220px;

        }





    </style>







</head>



<body style='background-color:#fff;'>

<?

$imodule = $_GET['imodule'];

$modul = $_GET['module'];

$title = $_GET['title'];



$role   = $_SESSION['role'];



$id_module = $_GET['id_module']; 



$prd = $_GET['prd']; 

$tanggal = $_GET['tanggal'];

$outlet = $_GET['outlet'];

$notrans = $_GET['notrans'];

  

?>





<div class="ix_panel">



 <div class="form-group pull-right">

   <button type="button" onClick="parent.tb_remove()" class="btn btn-danger">Tutup</button>

 </div>  <br><br>



 <div id="tablewrapper">



   <div id="tableheader">



       <div class="search">  <select id="columns" onchange="sorter.search('query')"></select>

           <input type="text" id="query" onkeyup="sorter.search('query');" value="Search By ...."  onclick="this.value=''"/>

       </div>

       <span class="details">

          <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>

           <!--<div><a href="javascript:sorter.reset()">reset</a></div>-->

       </span>

   </div> <div>





<table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >

       <thead>

           <tr>   

            <th class='nosort' width="5px" style='text-align:center;'>

                <h3 style='font-size:12px;'></h3>

              </th>  

             <th><h3 style='font-size:12px;'>Tanggal</h3></th>   

             <th><h3 style='font-size:12px;'>No. Permintaan</h3></th>  

             <th width="100px;"><h3 style='font-size:12px;'>Kode Barang</h3></th> 

             <th><h3 style='font-size:12px;'>Barang</h3></th>               

             <th class='nosort' ><h3 style='font-size:12px;text-align: right;'>Qty Permintaan</h3></th>  

             <th class='nosort' ><h3 style='font-size:12px;text-align: right;'>Qty Pemesanan</h3></th>  

             <th class='nosort' ><h3 style='font-size:12px;text-align: right;'>Sisa Qty </h3></th>        

             <th class='nosort' ><h3 style='font-size:12px;text-align: right;'>Stok </h3></th>        

             <th><h3 style='font-size:12px;'>Satuan</h3></th>                           

          </tr>

       </thead>

       <tbody>

           

        <?

       

      $SQL= "SELECT p.tanggal,a.*,c.id_unit_barang,c.unit_barang,b.kode as kode_bar,b.barang

                  ,a.qty-a.qty_ps as iqty, b.id_merk, b.id_barang
                  ,ifnull((SELECT sum(saldo_akhir)
                                FROM stok
                                WHERE id_outlet = '$outlet'
                                and id_barang = b.id_barang
                                and prd = '$prd'
                                ) ,0) 
                    as stok
                 FROM permintaan_barang p inner join permintaan_barang_detail a 

                  on  p.prd      = a.prd

                  and p.notrans  = a.notrans

                  and p.kode    =  a.kode

                  and p.id_outlet = a.id_outlet 

                  and p.status = '1'

                  inner join barang b

                 ON a.id_barang = b.id_barang

                 INNER JOIN unit_barang c

                 ON b.id_unit_barang = c.id_unit_barang 

                 LEFT JOIN pemesanan_barang_detail d

                ON d.notrans = '$notrans'

                AND d.status <> '4'

                AND d.id_outlet = '$outlet'

                AND d.id_permintaan_barang_detail = a.id_permintaan_barang_detail

                 WHERE a.status = '1'

                 and a.qty-a.qty_ps > 0

                 AND a.id_outlet = '$outlet'

                 and p.tanggal <= '$tanggal'

                 AND ifnull(d.id_pemesanan_barang_detail,0) = '0'

                 ORDER BY a.notrans,a.seqno";   



        $tampil=mysql_query($SQL);

         

         $no = 1;

         

         while ($r=mysql_fetch_array($tampil)){  

          //selectPR(no_pr,id_permintaan_barang_detail,ibarang,id_barang,unit_barang,iqty,qty)


          $hsql  = mysql_query("SELECT harga as last_price 
                                FROM pemesanan_barang_detail
                                WHERE id_outlet = '$outlet'
                                and id_barang = '$r[id_barang]'
                                and status in ('1','2','3')                                
                                ORDER BY id_pemesanan_barang_detail 
                                DESC limit 0,1

                              ");



             $h         = mysql_fetch_array($hsql);

              

             if ($h['last_price']) {
              $last_price  = $h['last_price'];
             } else {
              $last_price  = 0;  
             }



          $tgl = date("d/m/Y", strtotime($r['tanggal']));

          $barang = $r['kode_bar'].' - '.$r['barang'];

          $no_pr = $r['kode'].''.$r['notrans'];




         echo"<tr>";

        ?>

        <td style='text-align:center;'> 

            <a href="javascript:selectPR('<?php echo trim($no_pr)."','".trim($r['id_permintaan_barang_detail'])."','".trim($barang)."','".trim($r['id_barang'])."','".trim($r['id_merk'])."','".trim($r['id_unit_barang'])."','".number_format($r['iqty'], 2, ".", ",")."','".$r['iqty']."','".$last_price ?>')">

            <span class='icon'><i class='fa fa-check'></i></span>

            </a>

          </td>



        <?

        echo"<td>".$tgl."</td>";

        echo"<td>".$r['kode']."".$r['notrans']."</td>";

        echo"<td>".$r['kode_bar']."</td>";

        echo"<td>".$r['barang']."</td>";

        echo"<td style='text-align:right;'>".number_format($r['qty'], 2, ".", ",")."</td>";  

        echo"<td style='text-align:right;'>".number_format($r['qty_ps'], 2, ".", ",")."</td>";  

        echo"<td style='text-align:right;'>".number_format($r['iqty'], 2, ".", ",")."</td>";  

         echo"<td style='text-align:right;'>".number_format($r['stok'], 2, ".", ",")."</td>";  

        echo"<td>".$r['unit_barang']."</td>";              

         echo"</tr>";

         $no++;

            

         }

         ?>

        </tbody>

   </table>

      

      </div>

       <div id="tablefooter">

          <div id="tablenav">

    <div>

       <span class="glyphicon glyphicon-fast-backward" onclick="sorter.move(-1,true)" /></span>

                                <span class="glyphicon glyphicon-step-backward" onclick="sorter.move(-1)" /></span>

                                <span class="glyphicon glyphicon-step-forward" onclick="sorter.move(1)" /></span>

                                 <span  class="glyphicon glyphicon-fast-forward" onclick="sorter.move(1,true)" /></span>

    </div>

    <div>

        <select id="pagedropdown" style="width:40px;"></select>

    </div>

       <!-- <div>

            <a href="javascript:sorter.showall()">view all</a>

        </div> -->

    </div>

               

    <div id="tablelocation" >

        <div>

            <select onChange="sorter.size(this.value)" style="width:50px;">

              

    <?php if ($size == '10') { ?>

    <option value="10" selected="selected">10</option>

    <?php } else { ?>

    <option value="10">10</option>

    <?php  } ?>



     <?php if ($size == '15') { ?>

    <option value="15" selected="selected">15</option>

    <?php } else { ?>

    <option value="15">15</option>

    <?php  } ?>



    <?php if ($size == '20') { ?>

    <option value="20" selected="selected">20</option>

    <?php } else { ?>

    <option value="20">20</option>

    <?php  } ?>



    <?php if ($size == '50') { ?>

    <option value="50" selected="selected">20</option>

    <?php } else { ?>

    <option value="50">50</option>

               <?php  } ?>



    <?php if ($size == '100') { ?>

    <option value="100" selected="selected">100</option>

    <?php } else { ?>

    <option value="100">100</option>

     <?php  } ?>

              

            </select>

              <span>Arsip Perhalaman</span> </div> <div>| Halaman <span id="currentpage"></span> dari <span id="totalpages"></span> | &nbsp  </div>

    </div>

            </div>

        </div>



</div>



<script src="../../js/bootstrap.min.js"></script>







        <script type="text/javascript" src="../../config/js/script.js"></script>

    <script type="text/javascript">

    var sorter = new TINY.table.sorter('sorter','table',{

        headclass:'head',

        ascclass:'asc',

        descclass:'desc',

        evenclass:'evenrow',

        oddclass:'oddrow',

        evenselclass:'evenselected',

        oddselclass:'oddselected',

        paginate:true,

        size:10,

        colddid:'columns',

        currentid:'currentpage',

        totalid:'totalpages',

        startingrecid:'startrecord',

        endingrecid:'endrecord',

        totalrecid:'totalrecords',

        hoverid:'selectedrow',

        pageddid:'pagedropdown',

        navid:'tablenav',

        <!--sortcolumn:1,-->

        sortdir:1,

        /*sum:[8],

        avg:[6,7,8,9],

        columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],*/

        init:true

    });

  </script>

         



</body>

</html>

<?

}

?>