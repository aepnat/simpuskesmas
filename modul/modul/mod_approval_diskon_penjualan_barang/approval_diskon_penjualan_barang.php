

<script type="text/javascript" src="config/js/jquery.min.js"></script>



<script type="text/javascript">

<?php for ($i = 1; $i<=100; $i++) {
    ?>  

function Getstatus<?php echo $i; ?>(str) {

    document.getElementById("p_status<?php echo $i; ?>").value = str;

}

<?php
} ?>



</script>





<?php for ($i = 1; $i<=100; $i++) {
        ?>  

<script>



function mask<?php echo $i?>() {



 var nilai   = document.getElementById("ijumlah_realisasi<?php echo $i?>").value; 

 document.getElementById("jumlah_realisasi<?php echo $i?>").value = nilai;



var inilai = nilai.toString();

document.getElementById("ijumlah_realisasi<?php echo $i?>").value = number_format(nilai, 0,',','.'); 



}

</script> 



<script>



function mask_clear<?php echo $i?>() {



var nilai   = document.getElementById("jumlah_realisasi<?php echo $i?>").value; 

var inilai = nilai.toString();

document.getElementById("ijumlah_realisasi<?php echo $i?>").value = nilai; 

document.getElementById("jumlah_realisasi<?php echo $i?>").value = nilai ;



}

</script>  

<?php
    } ?>





<?php

switch ($_GET[act]) {

    default:

    if ($_SESSION['outlet']=='0') {
        $d_outlet = '%';
    } else {
        $d_outlet = $_SESSION['outlet'];
    }

    if ($_GET['ioutlet']) {
        $outlet = $_GET['ioutlet'];
    } else {
        if ($_SESSION['outlet']=='0') {
            $outlet = '1';
        } else {
            $outlet = $_SESSION['outlet'];
        }
    }

    $query = mysql_query('SELECT * FROM periode ');

    if ($query && mysql_num_rows($query)==1) {
        $data = mysql_fetch_object($query);
    }

    $iprd = $data->periode;

    if ($_GET['prd']) {
        $prd = $_GET['prd'];
    } else {
        $prd = $prd;
    }

    if ($_GET['istatus']) {
        $status = $_GET['istatus'];
    } else {
        $status = '0';
    }

        ?>



 <div class="">

  

                <div class="row">



       <div class="col-md-12 col-sm-12 col-xs-12">

           <div class="x_panel">



    <div class="col-md-6 col-sm-12 col-xs-12">  

    <h2><?php echo $nmmodule; ?></h2>

    </div>



    <div class="col-md-6 col-sm-12 col-xs-12">



     <form method=get action='<?php echo $_SERVER[PHP_SELF]?>' name='myform'>

    <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

    <input type="hidden" name="module" value="<?php echo $module?>" /> 

    <input type="hidden" name="kode" value="<?php echo $kode?>" /> 



    <div class="col-md-6 col-sm-12 col-xs-12">

      <input type="month" name="prd" id="prd" value="<?php echo $prd; ?>" onChange="document.myform.submit();" class="form-control"  required>

    </div>



    <div class="col-md-3 col-sm-6 col-xs-6">

      <select name="ioutlet" class="form-control" onChange="document.myform.submit();">

       <?php

                $query = mysql_query("SELECT * FROM outlet where id_outlet like '$d_outlet' ORDER BY id_outlet");

                if ($query && mysql_num_rows($query)>0) {
                    while ($row = mysql_fetch_object($query)) {
                        echo '<option value="'.$row->id_outlet.'"';

                        if ($row->id_outlet==$outlet) {
                            echo ' selected';
                        }

                        echo '>'.$row->outlet.'</option>';
                    }
                }

            ?>  

       </select>        

    </div>



     <div class="col-md-3 col-sm-6 col-xs-6">

     <select name="istatus" class="form-control" onChange="document.myform.submit();">

        <?php

                $query = mysql_query('SELECT * FROM status ORDER BY id_status');

                if ($query && mysql_num_rows($query)>0) {
                    while ($row = mysql_fetch_object($query)) {
                        echo '<option value="'.$row->id_status.'"';

                        if ($row->id_status==$status) {
                            echo ' selected';
                        }

                        echo '>'.$row->status.'</option>';
                    }
                }

            ?>  

        </select>        

    </div>



    </form>



    </div>





  <div class="x_content">

   <hr>



   <div class="table-responsive">

  <div id="tablewrapper">



   <div id="tableheader">



       <div class="search">  <select id="columns" onchange="sorter.search('query')"></select>

           <input type="text" id="query" onkeyup="sorter.search('query');" value="Pencarian berdasarkan ...."  onclick="this.value=''"/>

       </div>

       <span class="details">

          <div>Arsip <span id="startrecord"></span>-<span id="endrecord"></span> dari <span id="totalrecords"></span></div>

           <!--<div><a href="javascript:sorter.reset()">reset</a></div>-->

       </span>

   </div> <div>



   <?php


            $pjSQL = mysql_query("SELECT * FROM penjualan_barang_detail 

                          WHERE status_diskon = '$status' and prd = '$prd' and disc1 > 0

                          and id_outlet_barang = '$outlet'

                          ");

        $pj = mysql_num_rows($pjSQL);

        if ($iprd==$prd) {
            $disabled = '';
        } else {
            $disabled = 'disabled';
        }

        if ($pj==0) {
            $disabled1 = 'disabled';
        } else {
            $disabled1 = '';
        }

        ?>



    <form action="<?php echo"modul/mod_$module/aksi_$module.php?module=$module&act=approve"; ?>" method="post" name="formData" enctype="multipart/form-data"  >  



    <input type="hidden" name="module" value="<?php echo $module?>" /> 

    <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

    <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

    <input type="hidden" name="prd" value="<?php echo $prd?>" /> 



                



       <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >

       <thead>

           <tr>

              <th><h3 style='font-size:12px;'>Tanggal</h3></th>            

              <th><h3 style='font-size:12px;'>No.Transaksi</h3></th>

              <th><h3 style='font-size:12px;'>Customer</h3></th>  

              <th><h3 style='font-size:12px;'>Barang</h3></th> 

               <th><h3 style='font-size:12px;;text-align: right;'>Total</h3></th> 

               <th><h3 style='font-size:12px;;text-align: right;'>Diskon</h3></th> 

               <th><h3 style='font-size:12px;' width='10%'>Status</h3></th> 

               <th><h3 style='font-size:12px;text-align: center;'>

                  <button type="submit"   class="btn btn-success btn-sm   "

                  <?php echo $disabled?>
        
                <?php echo $disabled1?>

                  >

                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>

                  </button>



               </h3></th> 

     

           </tr>

       </thead>

       <tbody>



           

        <?php


                $tampil = mysql_query("SELECT b.*,c.customer,a.tanggal 

                                , case when b.id_barang = '0' then e.paket else d.barang end as barang 

                              from penjualan_barang a inner join penjualan_barang_detail b 

                              on  a.prd     = b.prd

                              and a.notrans = b.notrans

                              and a.kode    = b.kode

                              and a.id_outlet= b.id_outlet

                              inner join customer c

                              ON a.id_customer = c.id_customer

                              LEFT join barang d

                              ON b.id_barang = d.id_barang

                              LEFT JOIN promosi e

                              ON b.id_promosi = e.id_promosi                              

                              where a.prd = '$prd'

                              AND a.status = '0'

                              and b.status = '0'

                              and b.status_diskon ='$status'

                              and b.disc1 > 0

                              and b.id_outlet_barang = '$outlet'

                              ORDER BY a.tanggal,a.notrans

                              ");

                $no = 1;

                while ($r = mysql_fetch_array($tampil)) {
                    $tgl = date('d/m/y', strtotime($r['tanggal']));

                    echo'<tr>';

                    echo"<td>$tgl </td>";

                    echo"<td>$r[notrans]</td>";

                    echo"<td>$r[customer]</td>";

                    echo"<td>$r[barang]</td>";

                    echo"<td  style='text-align:right;'>".number_format($r[total], '0', '.', ',').'</td>';

                    echo"<td  style='text-align:right;'>".number_format($r[disc1], '2', '.', ',').' % | Rp. '.number_format($r[disc_value1], '0', '.', ',').'</td>';

                    echo'<td>'; ?>

         <select name="status<?php echo $no; ?>" class="form-control" onchange="Getstatus<?php echo $no; ?>(this.value)">

        <?php

                $query = mysql_query('SELECT * FROM status ORDER BY id_status');

                    if ($query && mysql_num_rows($query)>0) {
                        while ($row = mysql_fetch_object($query)) {
                            echo '<option value="'.$row->id_status.'"';

                            if ($row->id_status==$r[status_diskon]) {
                                echo ' selected';
                            }

                            echo '>'.$row->status.'</option>';
                        }
                    } ?>  

        </select>        





         <?php

                echo'</td>';

                    echo"<td style='text-align:center;'>";

                    echo"<input type='hidden' name='id".$no."' value = '$r[id_penjualan_barang_detail]'>";

                    echo"<input type='hidden' name='prd".$no."' value = '$r[prd]'>";

                    echo"<input type='hidden' name='notrans".$no."' value = '$r[notrans]'>";

                    echo"<input type='hidden' name='outlet".$no."' value = '$r[id_outlet]'>";

                    echo"<input type='hidden' name='p_status".$no."' id='p_status".$no."' value = '$status'>";

                    // echo"<a class='btn btn-default btn-sm' href='?module=$module&id_module=$id_module&id_pemesanan_barang=$r[id_pemesanan_barang]&prd=$prd&outlet=$outlet&act=detail' title='Detail Penarikan Simpanan'><span class='icon'><i class='fa fa-pencil-square-o'></i></span></a>";

                    echo'</td>';

                    echo'</tr>';

                    $no++;
                }

                ?>



        </tbody>

   </table>

    <input type='hidden' name='jum' value='<?php echo $no; ?>' />

    <input type='hidden' name='istatus' value='<?php echo $status; ?>' />

   </form>

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

               <span>Arsip Per Halaman</span> </div> <div>| Halaman <span id="currentpage"></span> dari <span id="totalpages"></span> | &nbsp  </div>

       </div>  

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



    <?php

        break;

}

?>