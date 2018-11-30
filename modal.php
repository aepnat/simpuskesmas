<?
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

   <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <!-- editor -->
    
    <link href="css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="css/editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="css/select/select2.min.css" rel="stylesheet">
    <!-- switchery -->
    <link rel="stylesheet" href="css/switchery/switchery.min.css" />

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="config/css/tiny_table.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
         <?// start grid ?>


         <?


        // $module = $_GET['module'];
        // $id_module = $_GET['id_module'];
        // $title = $_GET['title'];

        $prd    = '2016-01';//$_GET['prd']; 
        $kode    = 'PJ';//$_GET['kode']; 

        $id_outlet  = '1';//$_GET['id_outlet'];
        $outlet  = '';//$_GET['outlet'];
        $tanggal = 'A44-1601-0002';//$_GET['tanggal'];
        $notrans = '2016-09-04';//$_GET['notrans'];
        $customer = '3';//$_GET['customer'];

        if ($_GET['ioutlet']) {
          $outlet = $_GET['ioutlet'];   
        } else {
          $outlet = '1';   
        }

        if ($_GET['itipe_barang']) {
          $tipe_barang = $_GET['itipe_barang'];   
        } else {
          $tipe_barang = '1';   
        }

        ?>


        <div  class="table-responsive">
                   
                <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2></h2>
                                        
                                     
                                         <form method=get action='<?php echo $_SERVER[PHP_SELF]?>' name='myform'>
                                         <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                         <input type="hidden" name="module" value="<?php echo $module?>" /> 
                                         <input type="hidden" name="prd" value="<?php echo $prd?>" /> 

                                          <input type="hidden" name="kode" id="kode" value="<?php echo $kode;?>">
                                          <input type="hidden" name="id_outlet" id="id_outlet" value="<?php echo $id_outlet;?>">
                                          <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>">
                                          <input type="hidden" name="customer" id="customer" value="<?php echo $customer;?>">
                                          <input type="hidden" name="notrans" id="notrans" value="<?php echo $notrans;?>">
                                                                  
                                         <p class="pull-right">
                                         <select name="itipe_barang" class="form-control" onChange="document.myform.submit();">
                                            <?
                                              $query = mysql_query('SELECT * FROM tipe_barang ORDER BY id_tipe_barang');
                                               if($query && mysql_num_rows($query) > 0){
                                                  while($row = mysql_fetch_object($query)){
                                                  echo '<option value="'.$row->id_tipe_barang.'"';
                                                  if($row->id_tipe_barang == $tipe_barang) echo ' selected';
                                                  echo '>'.$row->tipe_barang.'</option>';
                                                  }
                                               }        
                                            ?>  
                                            </select>        
                                        </p>

                                         <p class="pull-right">
                                         <select name="ioutlet" class="form-control" onChange="document.myform.submit();">
                                            <?
                                              $query = mysql_query('SELECT * FROM outlet ORDER BY id_outlet');
                                               if($query && mysql_num_rows($query) > 0){
                                                  while($row = mysql_fetch_object($query)){
                                                  echo '<option value="'.$row->id_outlet.'"';
                                                  if($row->id_outlet == $outlet) echo ' selected';
                                                  echo '>'.$row->outlet.'</option>';
                                                  }
                                               }        
                                            ?>  
                                            </select>        
                                        </p>


                                         </form>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
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
                                <th ><h3 style='font-size:12px;' width='20px'></h3></th>  
                                <th><h3 style='font-size:12px;'>Jenis Barang</h3></th>
                                <th width="150px;"><h3 style='font-size:12px;'>Kode Barang</h3></th>                               
                                <th><h3 style='font-size:12px;'>Barang</h3></th>                              
                                <th><h3 style='font-size:12px;'>Satuan</h3></th>  
                                <th class='nosort' ><h3 style='font-size:12px;text-align: right;'>Harga</h3></th>    
                            </tr>
                        </thead>
                        <tbody>
                            
                         <?
                      
                          $SQL= "SELECT b.jenis_barang
                                    ,c.unit_barang
                                    ,a.kode as kode_barang
                                     ,a.id_barang
                                    ,a.barang   
                                    ,d.harga_jual   
                                    ,sum(saldo_akhir) as stok  
                                        FROM barang a INNER JOIN jenis_barang b
                                        ON a.id_jenis_barang = b.id_jenis_barang 
                                        AND b.aktif = 'Y'
                                        INNER JOIN unit_barang c 
                                        ON a.id_unit_barang = c.id_unit_barang  
                                        AND c.aktif = 'Y'
                                        LEFT JOIN harga_barang d
                                        ON a.id_barang = d.id_barang
                                        AND d.status = '0'
                                        AND d.id_outlet = '$outlet'
                                        LEFT JOIN stok e
                                        ON  '$prd' = e.prd
                                        AND a.id_barang = e.id_barang
                                        and '$outlet'   = e.id_outlet
                                        WHERE a.aktif = 'Y'
                                        AND a.id_tipe_barang = '$tipe_barang'     
                                        and d.harga_jual > 0  
                                        and e.saldo_akhir > 0
                                        group by b.jenis_barang
                                        ,c.unit_barang
                                         ,a.id_barang
                                         ,a.kode
                                        ,a.barang   
                                        ,d.harga_jual
                                      ORDER BY a.id_jenis_barang,a.kode";   


                             $tampil=mysql_query($SQL);

                                                          
                             $no = 1;
                             
                             while($r=mysql_fetch_array($tampil)){

                                $id_barang = $r['id_barang'];
                                $kode_barang = $r['kode_barang'];

                                $dsql   = mysql_query("SELECT sum(qty) as reserve
                                                      FROM stok_reserved
                                                      WHERE id_barang_promosi = '$id_barang'
                                                      AND id_outlet = '$outlet'
                                                      AND tipe = 'B'
                                                       and prd = '$prd'
                                                      "); 

                                 $d     = mysql_fetch_array($dsql); 

                                if ($d['reserve']) {
                                  $reserve = $d['reserve'];
                                 } else {
                                  $reserve = 0;
                                 }

                                  $sisa_stok   = $r['stok']-$reserve;

                                  if ($sisa_stok == '0') {

                                    echo "";
                                  } else {



                                    echo"<tr>";
                                    echo" <td  style='text-align:center;'>";
                                    echo"<a href='../../modul/mod_$module/aksi_$module.php?module=$module&act=add&barcode=$kode_barang&prd=$prd&notrans=$notrans&kode=$kode&tanggal=$tanggal&customer=$customer&outlet=$outlet&id_outlet=$id_outlet&id_module=$id_module&look=1'  title=''><span class='icon'><i class='fa fa-check'></i></span></a>";
                                    
                                    echo"</td>";   
                                     echo"<td>".$r['jenis_barang']."</td>";
                                     echo"<td>".$r['kode_barang']."</td>";
                                     echo"<td>".$r['barang']."</td>";
                                     echo"<td>".$r['unit_barang']."</td>";
                                     echo"<td style='text-align:right;'>".number_format($r['harga_jual'], 0, ".", ",")."</td>";
                                                                                
                                    echo"</tr>";

                                  }

                                 
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
                       
                        <div id="tablelocation">
                            <div>
                                <select onchange="sorter.size(this.value)" style="width:50px;">
                                <option value="5">5</option>
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>Entries Per Page</span> </div> <div>| Page <span id="currentpage"></span> of <span id="totalpages"></span> | &nbsp  </div>
                        </div>  
                    </div>
                </div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />
               </div>
        </div>

         <?//end frif ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>



           <script type="text/javascript" src="config/js/script.js"></script>
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
        size:1,
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
