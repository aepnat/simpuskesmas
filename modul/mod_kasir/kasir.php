<?php
if ($_GET['prd']) {
    $prd = $_GET['prd'];
} else {
    $prd = date('Y-m');
}

?>



<script>



function cektgl() {



  var prd = document.getElementById("prd").value;

  var tgl = document.getElementById("tanggal").value

  var shift = document.getElementById("shift").value

  var iprd = tgl.substring(0,7);



  if(prd != iprd) {

    document.getElementById("tanggal").focus(); 

    alert('Peringatan : Tanggal tidak sesuai periode aktif.'); 

    return false;     

  } else  if(shift == '0') {

    document.getElementById("shift").focus(); 

    alert('Peringatan : shift harus dipilih.'); 

    return false;     


  }  else {

     document.formData.submit();

  }



}

</script> 






<script>



  function mask_jumlah() {



   var jumlah   = document.getElementById("ijumlah").value; 

   document.getElementById("jumlah").value = jumlah;



  var ijumlah = jumlah.toString();

  document.getElementById("ijumlah").value = number_format(jumlah, 0,'.',','); 



   var total  = document.getElementById("qty").value*document.getElementById("jumlah").value;

  var itotal = total.toString();

  document.getElementById("itotal").value = number_format(itotal, 0,'.',','); 

  document.getElementById("total").value = total; 



  }

  </script> 



  <script>



  function mask_clear_jumlah() {



  var jumlah   = document.getElementById("jumlah").value;  

  var ijumlah = jumlah.toString();

  document.getElementById("ijumlah").value = jumlah; 

  document.getElementById("jumlah").value = jumlah ;



  }

  </script>  



<script>



  function mask_rate() {



   var rate   = document.getElementById("irate").value; 

   document.getElementById("rate").value = rate;



  var irate = rate.toString();

  document.getElementById("irate").value = number_format(rate, 0,'.',','); 





  }

  </script> 



  <script>



  function mask_clear_rate() {



  var rate   = document.getElementById("rate").value;  

  var irate = rate.toString();

  document.getElementById("irate").value = rate; 

  document.getElementById("rate").value = rate ;



  }

  </script>  



<?php

switch (isset($_GET['act']) && $_GET['act']):

    default:

      ?>



 <div class="">

  

   <div class="row">



       <div class="col-md-12 col-sm-12 col-xs-12">

           <div class="x_panel">

  <div class="x_title">

  <h2>List <?php echo $nmmodule; ?></h2>



     <p class="pull-right">

    <a href='<?php echo"?module=$module&id_module=$id_module&prd=$prd&outlet=$outlet&kode=$kode&act=baru"; ?>' title='Form <?php echo $nmmodule; ?>' class='btn btn-sm btn-success'><i class="fa fa-plus"></i> Baru</a>

    </p>



     <p class="pull-right">

    &nbsp&nbsp&nbsp

    </p>



    <form method=get action='<?php echo $_SERVER[PHP_SELF]?>' name='myform'>

    <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

    <input type="hidden" name="module" value="<?php echo $module?>" /> 

    <input type="hidden" name="kode" value="<?php echo $kode?>" /> 


    <p class="pull-right">

    <input type="month" name="prd" id="prd" value="<?php echo $prd; ?>" onChange="document.myform.submit();" class="form-control"  required>

    </p>



     <p class="pull-right">

     <label class="control-label"  style="padding-top:8px;">Periode &nbsp&nbsp</label>

    </p>



    </form>

   





   <div class="clearfix"></div>

  </div>

  <div class="x_content">

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

       <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >

       <thead>

           <tr>

  <th><h3 style='font-size:12px;'>Tanggal</h3></th>            

  <th><h3 style='font-size:12px;'>Shift</h3></th>

  <th><h3 style='font-size:12px;'>Petugas</h3></th>  

  <th><h3 style='font-size:12px;'>Catatan</h3></th> 

<!--   <th><h3 style='font-size:12px;'>Status</h3></th>  -->

  <th><h3 style='font-size:12px;text-align: center;'>Aksi</h3></th> 

     

           </tr>

       </thead>

       <tbody>

           

        <?php


            $tampil = mysql_query("SELECT a.*,b.shift

                             FROM kasir a left join shift b

                             ON a.id_shift = b.id_shift

                             AND b.aktif = 'Y'

                             WHERE a.tanggal LIKE '$prd%'

                             AND a.status != '4'

                            ORDER BY a.tanggal");

            $no = 1;

            while ($r = mysql_fetch_array($tampil)) {
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

                $ID = $r[id_kasir];

                echo'<tr>';

                echo"<td>$tgl </td>";

                echo"<td>$r[shift]</td>";

                echo"<td>$r[petugas]</td>";

                echo"<td>$r[note]</td>";

                // echo"<td>$istatus</td>";

                echo"<td style='text-align:center;'>";

                if ($r_edit == 'Y') {
                    echo"<a href='?module=$module&id_module=$id&act=save&ID=$ID' title='Update'><span class='icon'><i class='fa fa-pencil'></i></span></a>";
                }

                if ($r_delete == 'Y' and $r['status'] == '0') {
                    echo"<a href='modul/mod_$module/aksi_$module.php?module=$module&act=hapus&id=$ID&id_module=$id&id_module=$id' onClick=\"return confirm('Hapus Data ?')\" title='Hapus $nmmodule'><span class='icon'><i class='fa fa-trash'></i></span></a>";
                } else {
                    echo"<i class='fa fa-trash'></i></span>";
                }

                echo'</td>';

                echo'</tr>';

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

  <span>Arsip Per Halaman</span> </div> <div>| Halaman <span id="currentpage"></span> dari <span id="totalpages"></span> | &nbsp  </div>

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

    case 'baru':

    $hour = time() + (30 * 25 * 60 * 60);

    $idate = date('Y-m-d');

    $idate = $idate;

    ?>



<div class="row" >



 <form action="<?php echo"modul/mod_$module/aksi_$module.php?module=$module&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 



       <div class="col-md-12 col-sm-12 col-xs-12 form-group" >

          <div class="x_panel" >

<div class="x_title">

  <h2>Form <?php echo $nmmodule?></h2>

        <div class="pull-right">

   

          <button type="submit" class="btn btn-primary">Simpan</button>



          <button  type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&act=ubah&prd=$prd&notrans=$notrans&kode=$kode&outlet=$outlet"; ?>'" 

          class="btn btn-success" <?php if ($status != '0') {
        echo 'disabled';
    } ?>>Ubah</button>



           <?php if ($status == '0') {
        ?>

            <?php

            echo"<a href='modul/mod_$module/aksi_$module.php?module=$module&act=batal&id=$ID&id_module=$id&notrans=$notrans&prd=$prd&kode=$kodee&outlet=$outlet' onClick=\"return confirm('Hapus transaksi ?')\" title='Hapus $nmmodule'><span class='btn btn-danger'><span style='color:white;'>Hapus</span></a>"; ?>

        <?php
    } else {
        ?>

            <button type="button" class="btn btn-danger" disabled>Hapus</button>

           <?php
    } ?>  



                 

           <button type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&prd=$prd&ioutlet=$outlet&kode=$kode"; ?>'" class="btn btn-warning">Kembali Ke List</button>

        </div>



  

<div class="clearfix"></div>

</div>

<?php // heaeder?>

<div class="x_content">

  

  <input type="hidden" name="module" value="<?php echo $module?>" /> 

  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

  <input type="hidden" name="prd" id="prd" value="<?php echo $prd?>" /> 

  <input type="hidden" name="outlet" id="outlet" value="<?php echo $outlet; ?>">

  <input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>">


 


  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Tanggal</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

     <input type="date" name="tanggal" id="tanggal" value="<?php echo $idate; ?>" autofocus class="form-control"  required>  

  </div> 



 <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Shift</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

    <select name="shift" id="shift" class="form-control" required>

 <?php

    $query = mysql_query('SELECT * FROM shift WHERE  aktif = "Y" ORDER BY id_shift');

    if ($query && mysql_num_rows($query) > 0) {
        while ($row = mysql_fetch_object($query)) {
            echo '<option value="'.$row->id_shift.'"';

            if ($row->id_shift == $shift) {
                echo ' selected';
            }

            echo '>'.$row->shift.'</option>';
        }
    }

    ?>  

 </select>         

  </div> 

  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Petugas</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

      <input type="text" name="petugas" id="petugas" value="" required class="form-control" >  

  </div> 


</div>




<?php // detail?>



<div class="x_content" >







    <table cellpadding="0" width='100%' cellspacing="0" border="0" class="table table-striped responsive-utilities jambo_table" >

 <tr>

     <th width='10%'><h5 style='font-size:12px;'>No. Permintaan</h5></th>  

     <th><h5 style='font-size:12px;'>Barang</h5></th> 

     <th><h5 style='font-size:12px;'>jenis_transaksi</h5></th> 

     <th width='5%'><h5 style='font-size:12px;text-align: right;'>Qty</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Satuan</h5></th> 

     <th><h5 style='font-size:12px;text-align: right;'>jumlah</h5></th> 

     <th><h5 style='font-size:12px;text-align: right;'>Total</h5></th> 

      <th width='5%'><h3 style='font-size:12px;text-align:center;' >Aksi</h3></th>                  

 </tr>





 </table> 





</div>


 

</div>



 </form>



<?php // end row?>

</div>

</div>

<?php

    break;

    case 'save':

    $k_ID = $_GET['ID'];

    $sql = mysql_query("SELECT * FROM kasir 

                        WHERE id_kasir = '$k_ID' 

                        ");

    $r = mysql_fetch_array($sql);

    $penjualan_barang = $r['id_kasir'];

    $shift = $r['id_shift'];

    $petugas = $r['petugas'];

    $status = $r['status'];

    $tanggal = $r['tanggal'];

    //$ID   = $r['id_kasir'];

    ?>



<div class="row" >





       <div class="col-md-12 col-sm-12 col-xs-12 form-group" >

          <div class="x_panel" >

<div class="x_title">

  <h2>Form <?php echo $nmmodule?></h2>

        <div class="pull-right">



   

          <button type="button" onclick="cektgl()" class="btn btn-primary" disabled>Simpan</button>



          <button  type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&act=ubah&k_ID=$k_ID"; ?>'" 

          class="btn btn-success" <?php if ($status != '0') {
        echo 'disabled';
    } ?>>Ubah</button>





           <button type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&prd=$prd&ioutlet=$outlet&kode=$kode"; ?>'" class="btn btn-warning">Kembali Ke List</button>



                 <a href='#' title='Cetak' onclick="window.open('./modul/mod_<?php echo $module; ?>/cetak_kasir.php?k_ID=<?php echo $k_ID; ?>&report_id=<?php echo $_GET[id_module]; ?>', '', 'height=650,width=800,resizable=1,scrollbars=1,addressbars=0,directories=no,location=no')">

              <span class='btn btn-success' style='color:white;'><i class='fa fa-print'></i> Cetak</span>

              </a>
  

        </div>



  

<div class="clearfix"></div>

</div>
`
<?php // heaeder?>

<div class="x_content">

  




  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Tanggal</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

     <input type="date" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" class="form-control"  readonly required>  

  </div> 



 <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Shift</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

    <select name="shift" id="shift" class="form-control" disabled>


 <?php

    $query = mysql_query('SELECT * FROM shift WHERE aktif = "Y" ORDER BY shift');

    if ($query && mysql_num_rows($query) > 0) {
        while ($row = mysql_fetch_object($query)) {
            echo '<option value="'.$row->id_shift.'"';

            if ($row->id_shift == $shift) {
                echo ' selected';
            }

            echo '>'.$row->shift.'</option>';
        }
    }

    ?>  

 </select>         

  </div> 

  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Petugas</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

      <input type="text" name="petugas" id="petugas" value="<?php echo $petugas?>" 

      readonly class="form-control" >  


  </div> 




</div>

<?php // detail?>



<div class="x_content" >



    <table cellpadding="0" width='100%' cellspacing="0" border="0" class="table table-striped responsive-utilities jambo_table" >

 <tr>

     <th width='10%'><h5 style='font-size:12px;'>No.Kwitansi</h5></th>  

     <th width='10%'><h5 style='font-size:12px;'>Nama Pasien</h5></th> 

     <th width='15%'><h5 style='font-size:12px;'>Jenis Transaksi</h5></th>      

     <th width='10%'><h5 style='font-size:12px;text-align: right;'>Jumlah</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Jenis Pembayaran</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Penjamin</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Keterangan</h5></th> 

     <th width='7%'><h3 style='font-size:12px;text-align:center;' >Aksi</h3></th>                  

 </tr>



 <?php //if ($status == '0' && $penjualan_barang == 0) {?>



 <form action="<?php echo"modul/mod_$module/aksi_$module.php?module=$module&act=add"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 



  <input type="hidden" name="module" value="<?php echo $module?>" /> 

  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

  <input type="hidden" name="k_ID" value="<?php echo $k_ID?>" /> 

 <tr>

 <td>

 <input type="text" name="notrans" id="notrans" value="" autofocus required="required"  class="form-control">

 </td>

 <td>

 <input type="text" name="pasien" id="pasien" value="" class="form-control">


 </td>

 <td>

  <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">


     <?php

        $query = mysql_query('SELECT * FROM jenis_transaksi WHERE aktif = "Y" ORDER BY id_jenis_transaksi');

        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_jenis_transaksi.'"';

                if ($row->id_jenis_transaksi == @$data->id_jenis_transaksi) {
                    echo ' selected';
                }

                echo '>'.$row->jenis_transaksi.'</option>';
            }
        }

        ?>

     </select>

 </td>



  <td>

 <input type="text" name='ijumlah' id='ijumlah' min='1'  value="0" style='text-align:right;' required="required" class="form-control col-md-7 col-xs-12"

onBlur="mask_jumlah()"

onFocus="mask_clear_jumlah()" 

>

<input type="hidden" name='jumlah' id='jumlah' value="0" style='text-align:right;' required="required" class="form-control col-md-7 col-xs-12"> 

 </td>



 <td>

  <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" >

  
     <?php

        $query = mysql_query('SELECT * FROM jenis_pembayaran WHERE aktif = "Y" ORDER BY id_jenis_pembayaran');

        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_jenis_pembayaran.'"';

                if ($row->id_jenis_pembayaran == @$data->id_jenis_pembayaran) {
                    echo ' selected';
                }

                echo '>'.$row->jenis_pembayaran.'</option>';
            }
        }

        ?>

     </select>

 </td>

<td>

  <select name="penjamin" id="penjamin" class="form-control" >
  <option value='0'></option>
  
     <?php

        $query = mysql_query('SELECT * FROM penjamin WHERE aktif = "Y" ORDER BY id_penjamin');

        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_penjamin.'"';

                if ($row->id_penjamin == @$data->id_penjamin) {
                    echo ' selected';
                }

                echo '>'.$row->penjamin.'</option>';
            }
        }

        ?>

     </select>

 </td>

  <td>

  <textarea  name="ket" id="ket" col=1></textarea>

 </td>


 <td>

 <button type="submit" class="btn btn-primary btn-xs" title='Simpan'>

      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>

     </button>

 </td>

 </tr>  





</form>



<?php //}?>
    


 <?php


    $dSQL = "SELECT a.*,b.jenis_transaksi,c.penjamin,d.jenis_pembayaran


         FROM kasir_detail a LEFT JOIN jenis_transaksi b

         ON a.id_jenis_transaksi = b.id_jenis_transaksi

         left join penjamin c

         ON a.id_penjamin = c.id_penjamin

         left join jenis_pembayaran d

         ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

         WHERE a.id_kasir = '$k_ID'

         AND a.status <> '4'

         ORDER BY a.seqno

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

        echo $d['notrans'];

        echo'</td>';

        echo' <td>';

        echo $d['pasien'];

        echo'</td>';

        echo' <td>';

        echo $d['jenis_transaksi'];

        echo'</td>';

        echo" <td  style='text-align:right;'>";

        echo $ijumlah;

        echo'</td>';

        echo' <td>';

        echo $d['jenis_pembayaran'];

        echo'</td>';

        echo' <td>';

        echo $d['penjamin'];

        echo'</td>';

        echo' <td>';

        echo $d['ket'];

        echo'</td>';

        echo" <td  style='text-align:center;'>";

        if ($r_edit == 'Y') {
            echo"<a href='?module=$module&id_module=$_GET[id_module]&act=edit&k_ID=$k_ID&d_id=$d_id' title='Update'><span class='btn btn-success btn-xs'><i class='fa fa-pencil'></i></span></a>";
        }

        if ($r_delete == 'Y') {
            echo"<a href='modul/mod_$module/aksi_$module.php?module=$module&id_module=$_GET[id_module]&act=dhapus&id=$d_id&k_ID=$k_ID' onClick=\"return confirm('Hapus Data ?')\" title='Hapus $nmmodule'><span class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></span></a>";
        }

        echo'</td>';

        echo'</tr>';
    }

    ?>


 <tr>

     <th width='10%' colspan="3"><h5 style='font-size:12px;'>Total</h5></th>  
     <th width='10%'><h5 style='font-size:12px;text-align: right;'><?=$itotal; ?></h5></th> 

     <th  width='10%' colspan="3"><h5 style='font-size:12px;'></h5></th> 

     <th width='5%'><h3 style='font-size:12px;text-align:center;' ></h3></th>                  

 </tr>

</table>  



</div>


  

</div>









<?php // end row?>

</div>

</div>

<?php

break;

    case 'ubah':

    $k_ID = $_GET['k_ID'];

    $sql = mysql_query("SELECT * FROM kasir 

                        WHERE id_kasir = '$k_ID' 

                        ");

    $r = mysql_fetch_array($sql);

    $ID = $r['id_kasir'];

    $shift = $r['id_shift'];

    $petugas = $r['petugas'];

    $status = $r['status'];

    $tanggal = $r['tanggal'];

    $dsql = mysql_query("SELECT * FROM kasir_detail 

                        WHERE id_kasir = '$k_ID' ");

    $jml = mysql_num_rows($dsql);

    if ($jml > 0) {

        // $readonly = 'readonly';

        // $disabled = 'disabled';

        $readonly = '';

        $disabled = '';
    } else {
        $readonly = '';

        $disabled = '';
    }

    ?>



<div class="row" >



   <form action="<?php echo"modul/mod_$module/aksi_$module.php?module=$module&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 



       <div class="col-md-12 col-sm-12 col-xs-12 form-group" >

          <div class="x_panel" >

<div class="x_title">

  <h2>Form <?php echo $nmmodule?></h2>

        <div class="pull-right">



   

          <button type="submit"  class="btn btn-primary">Simpan</button>



          <button type="button"  class="btn btn-success" disabled>Ubah</button>



          <button type="button" class="btn btn-danger" disabled>Hapus</button>



  

            <button type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&act=save&ID=$k_ID"; ?>'" class="btn btn-warning">Batal</button>



             <button type="button" disabled class="btn btn-success disabeld"><i class='fa fa-print'></i> Cetak</button>



        </div>



  

<div class="clearfix"></div>

</div>

<?php // heaeder?>

<div class="x_content">

  

  <input type="hidden" name="module" value="<?php echo $module?>" /> 

  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 

  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

 <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">

 <input type="hidden" name="k_ID" id="k_ID" value="<?php echo $k_ID; ?>">

 <input type="hidden" name="jml" id="jml" value="<?php echo $jml; ?>">


 


  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Tanggal</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

     <input type="date" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" <?php echo $readonly; ?> class="form-control" required>  

  </div> 



 <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">shift</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

    <select name="shift" id="shift" class="form-control" >


 <?php

        $query = mysql_query('SELECT * FROM shift WHERE aktif = "Y" ORDER BY shift');

        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_shift.'"';

                if ($row->id_shift == $shift) {
                    echo ' selected';
                }

                echo '>'.$row->shift.'</option>';
            }
        }

        ?>  

 </select>         

  </div> 

  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Petugas</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

      <input type="text" name="petugas" id="petugas" value="<?php echo $petugas?>" class="form-control" >  


  </div> 



</div>

<?php // detail?>



<div class="x_content" >


<table cellpadding="0" width='100%' cellspacing="0" border="0" class="table table-striped responsive-utilities jambo_table" >

 <tr>

     <th width='10%'><h5 style='font-size:12px;'>No.Kwitansi</h5></th>  

     <th width='10%'><h5 style='font-size:12px;'>Nama Pasien</h5></th> 

     <th width='15%'><h5 style='font-size:12px;'>Jenis Transaksi</h5></th>      

     <th width='10%'><h5 style='font-size:12px;text-align: right;'>Jumlah</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Jenis Pembayaran</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Penjamin</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Keterangan</h5></th> 
              

 </tr>




 <?php


        $dSQL = "SELECT a.*,b.jenis_transaksi,c.penjamin,d.jenis_pembayaran


         FROM kasir_detail a LEFT JOIN jenis_transaksi b

         ON a.id_jenis_transaksi = b.id_jenis_transaksi

         left join penjamin c

         ON a.id_penjamin = c.id_penjamin

         left join jenis_pembayaran d

         ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

         WHERE a.id_kasir = '$k_ID'

         AND a.status <> '4'

         ORDER BY a.seqno

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

            echo $d['notrans'];

            echo'</td>';

            echo' <td>';

            echo $d['pasien'];

            echo'</td>';

            echo' <td>';

            echo $d['jenis_transaksi'];

            echo'</td>';

            echo" <td  style='text-align:right;'>";

            echo $ijumlah;

            echo'</td>';

            echo' <td>';

            echo $d['jenis_pembayaran'];

            echo'</td>';

            echo' <td>';

            echo $d['penjamin'];

            echo'</td>';

            echo' <td>';

            echo $d['ket'];

            echo'</td>';

            echo'</tr>';
        }

        ?>


</table> 



</div>








<?php // end row?>

</div>

</div>

<?php

        break;

    case 'edit':

    $k_ID = $_GET['k_ID'];

    $sql = mysql_query("SELECT * FROM kasir 

                        WHERE id_kasir = '$k_ID' 

                        ");

    $r = mysql_fetch_array($sql);

    $penjualan_barang = $r['id_kasir'];

    $shift = $r['id_shift'];

    $petugas = $r['petugas'];

    $status = $r['status'];

    $tanggal = $r['tanggal'];

    //$ID   = $r['id_kasir'];

    ?>



<div class="row" >





       <div class="col-md-12 col-sm-12 col-xs-12 form-group" >

          <div class="x_panel" >

<div class="x_title">

  <h2>Form <?php echo $nmmodule?></h2>

        <div class="pull-right">

   

          <button type="submit" class="btn btn-primary" disabled>Simpan</button>



          <button  type="button" disabled class="btn btn-success" >Ubah</button>



          <button type="button" class="btn btn-danger" disabled>Hapus</button>

        

            <button type="button" onClick="location.href='<?php echo"?module=$module&id_module=$id_module&act=save&ID=$k_ID"; ?>'" class="btn btn-warning">Batal</button>



           <button type="button" disabled class="btn btn-success disabeld"><i class='fa fa-print'></i> Cetak</button>



        </div>



  

<div class="clearfix"></div>

</div>

<?php // heaeder?>

<div class="x_content">

  




  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Tanggal</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

     <input type="date" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" class="form-control"  readonly required>  

  </div> 



 <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Shift</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

    <select name="shift" id="shift" class="form-control" disabled>


 <?php

    $query = mysql_query('SELECT * FROM shift WHERE aktif = "Y" ORDER BY shift');

    if ($query && mysql_num_rows($query) > 0) {
        while ($row = mysql_fetch_object($query)) {
            echo '<option value="'.$row->id_shift.'"';

            if ($row->id_shift == $shift) {
                echo ' selected';
            }

            echo '>'.$row->shift.'</option>';
        }
    }

    ?>  

 </select>         

  </div> 

  <div class="col-md-1 col-sm-1 col-xs-6 form-group">

      <label class="control-label"  style="padding-top:8px;">Petugas</label>

  </div>  

  <div class="col-md-3 col-sm-3 col-xs-6 form-group">

      <input type="text" name="petugas" id="petugas" value="<?php echo $petugas?>" 

      readonly class="form-control" >  


  </div> 




</div>



<?php // detail?>



<div class="x_content" >





 <table cellpadding="0" width='100%' cellspacing="0" border="0" class="table table-striped responsive-utilities jambo_table" >

 <tr>

      <th width='10%'><h5 style='font-size:12px;'>No.Kwitansi</h5></th>  

     <th width='10%'><h5 style='font-size:12px;'>Nama Pasien</h5></th> 

     <th width='15%'><h5 style='font-size:12px;'>Jenis Transaksi</h5></th>      

     <th width='10%'><h5 style='font-size:12px;text-align: right;'>Jumlah</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Jenis Pembayaran</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Penjamin</h5></th> 

     <th  width='10%'><h5 style='font-size:12px;'>Keterangan</h5></th> 

     <th width='7%'><h3 style='font-size:12px;text-align:center;' >Aksi</h3></th>                  


 </tr>



 <?php

    $d_id = $_GET['d_id'];

$dSQL = "SELECT a.*,b.jenis_transaksi,c.penjamin,d.jenis_pembayaran


         FROM kasir_detail a LEFT JOIN jenis_transaksi b

         ON a.id_jenis_transaksi = b.id_jenis_transaksi

         left join penjamin c

         ON a.id_penjamin = c.id_penjamin

         left join jenis_pembayaran d

         ON a.id_jenis_pembayaran = d.id_jenis_pembayaran

         WHERE a.id_kasir = '$k_ID'

         AND a.status <> '4'

         ORDER BY a.seqno

         ";

    $dtampil = mysql_query($dSQL);

    $no = 1;

    while ($d = mysql_fetch_array($dtampil)) {
        $jid = $d['id_kasir_detail'];

        $ijumlah = number_format($d['jumlah'], 0, '.', ',');

        $jumlah = number_format($d['jumlah'], 0, '.', '');

        if ($jid == $d_id) {
            echo '<form action="modul/mod_'.$module.'/aksi_'.$module.'.php?module='.$module.'&act=add method="post" name="formData" enctype="multipart/form-data">';

            echo '<input type="hidden" name="module" value="'.$module.'" />';

            echo '<input type="hidden" name="id_module" value=" '.$id_module.'" />';

            echo '<input type="hidden" name="imodule" value="'.$imodule.'" />';

            echo '<input type="hidden" name="k_ID" value="'.$k_ID.'" />';

            echo  '<input type="hidden" name="ID" value="'.$jid.'" />';

            echo '<tr>';

            echo '<td>';

            echo '<input type="text" name="notrans" id="notrans" value=" '.$d['notrans'].'" autofocus required="required"  class="form-control">';

            echo '</td>';

            echo '<td>';

            echo '<input type="text" name="pasien" id="pasien" value="'.$d['pasien'].'" class="form-control">';

            echo '</td>';

            echo '<td>';

            echo '<select name="jenis_transaksi" id="jenis_transaksi" class="form-control">';

            $query = mysql_query('SELECT * FROM jenis_transaksi WHERE aktif = "Y" ORDER BY id_jenis_transaksi');

            if ($query && mysql_num_rows($query) > 0) {
                while ($row = mysql_fetch_object($query)) {
                    $selected = ($row->id_jenis_transaksi == @$d['id_jenis_transaksi']) ? 'selected' : '';
                    printf('<option value="%s" %s>%s</option>', $row->id_jenis_transaksi, $selected, $row->jenis_transaksi);
                }
            }

            echo '</select>';

            echo '</td>';

            echo '<td>';

            echo '<input type="text" name="ijumlah" id="ijumlah" min="1" value="'.$ijumlah.'" style="text-align:right;" required="required" class="form-control col-md-7 col-xs-12" onBlur="mask_jumlah()" onFocus="mask_clear_jumlah()"/>';

            echo '<input type="hidden" name="jumlah" id="jumlah" value="'.$jumlah.'" style="text-align:right;" required="required" class="form-control col-md-7 col-xs-12">';

            echo '</td>';

            echo '<td>';

            echo '<select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">';

            $query = mysql_query('SELECT * FROM jenis_pembayaran WHERE aktif = "Y" ORDER BY id_jenis_pembayaran');

            if ($query && mysql_num_rows($query) > 0) {
                while ($row = mysql_fetch_object($query)) {
                    $selected = ($row->id_jenis_pembayaran == @$d['id_jenis_pembayaran']) ? 'selected' : '';
                    printf('<option value="%s" %s>%s</option>', $row->id_jenis_pembayaran, $selected, $row->jenis_pembayaran);
                }
            }

            echo '</select>';

            echo '</td>';

            echo '<td>';

            echo '<select name="penjamin" id="penjamin" class="form-control">';
            echo '<option value="0"></option>';

            $query = mysql_query('SELECT * FROM penjamin WHERE aktif = "Y" ORDER BY id_penjamin');

            if ($query && mysql_num_rows($query) > 0) {
                while ($row = mysql_fetch_object($query)) {
                    $selected = ($row->id_penjamin == @$d['id_penjamin']) ? 'selected' : '';
                    printf('<option value="%s" %s>%s</option>', $row->id_penjamin, $selected, $row->penjamin);
                }
            }

            echo '</select>';

            echo '</td>';

            echo '<td>';

            echo '<textarea  name="ket" id="ket" col=1>'.$d['ket'].'</textarea>';

            echo '</td>';

            echo '<td>';

            echo '<button type="submit"  class="btn btn-primary btn-xs">';

            echo '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>';

            echo '</button>';

            echo '</td>';

            echo '</tr>';

            echo '</form>';
        } else {
            echo'<tr>';

            echo' <td>';

            echo $d['notrans'];

            echo'</td>';

            echo' <td>';

            echo $d['pasien'];

            echo'</td>';

            echo' <td>';

            echo $d['jenis_transaksi'];

            echo'</td>';

            echo" <td  style='text-align:right;'>";

            echo $ijumlah;

            echo'</td>';

            echo' <td>';

            echo $d['jenis_pembayaran'];

            echo'</td>';

            echo' <td>';

            echo $d['penjamin'];

            echo'</td>';

            echo' <td>';

            echo $d['ket'];

            echo'</td>';

            echo" <td  style='text-align:center;'>";

            if ($r_edit == 'Y') {
                echo"<span class='btn btn-success btn-sm' disabled><i class='fa fa-pencil'></i></span>";
            }

            if ($r_delete == 'Y') {
                echo"<span class='btn btn-danger btn-sm' disabled><i class='fa fa-trash'></i></span>";
            }

            echo'</td>';

            echo'</tr>';
        }
    }

    ?>



</table> 

 



</div>
 

</div>



<?php // end row?>

</div>

</div>

<?php

    endswitch;

?>