<?
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else{
include "./../../config/koneksi.php";
include "./../../config/fungsi_thumb.php";
?>
<?




$modul = $_GET['module'];
$imodule = $_GET['imodule'];
$title = $_GET['title'];

$role   = $_SESSION['role'];

$id_module = $_GET['id_module']; 


 if ($_GET['tab']) {
   $tab = $_GET['tab'];
 } else {
   $tab = 'ip';
 }

 if ($_GET['stab']) {
   $stab = $_GET['stab'];
 } else {
   $stab = 'tunai';
 }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>


      <script src="../../js/jquery.min.js"></script>


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



<script language="javascript">
  function closeform() {
     window.parent.location.href = "<?php echo"./../../main.php?module=$imodule&id_module=$id_module";?>";  
     window.parent.tb_remove();
  }
   </script>

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

        th h3{
            padding: 0px;

        }

    </style>



</head>

<body style='background-color:#fff;'>


<div class="ix_panel">


  <div class="container body">

    <div class="main_container">

      <ul class="nav nav-tabs">

       <li <?php if ($tab == 'ip') { echo 'class="active"'; } ?> ><a data-toggle="tab" href="#home">Informasi Perusahaan</a>
        </li>
       
        <li class="pull-right">
          <div>
           <button type="button" onClick="closeform();" class="btn btn-danger">Tutup</button>
          </div>  
        </li>
      </ul>

      <div class="tab-content">

          <div id="home" class="tab-pane fade <?php if ($tab == 'ip') { echo 'in active primary'; } ?>">
          <br>

           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <div class="x_content">

                <?

                 $id = 1; // isset($_GET['id_general_setting']) ? intval($_GET['id_general_setting']) : false;
    
                    if($id){
                       $query = mysql_query('SELECT * FROM informasi_perusahaan WHERE id_informasi_perusahaan = "'.$id.'"');
                       if($query && mysql_num_rows($query) == 1){
                          $data = mysql_fetch_object($query);
                       }else 
                          die('Data general_setting tidak ditemukan');
                    }
                  
                    $pict  = $data->pict;

              


                ?>
                   <!-- start form for validation -->
                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=ip"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                     
                     <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                     <span class="pull-right"><input type="submit" class="btn btn-primary" Value='Simpan'></span>

                       <div class="iavatar">    

                            <div id="kv-avatar-errors" class="center-block" style="display:none"></div>
                         
                            <div class="kv-avatar center-block" style="width:200px">
                              <input id="avatar" name='fupload' type="file" class="file-loading">
                            </div>
                       </div>     
                       <br>
                      </div> 

                        <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                             <label class="control-label"  style="padding-top:8px;">Nama Perusahaan</label>
                        </div>  
                       <div class="col-md-10 col-sm-10 col-xs-10 form-group">
                             <input type="text" name="company" value="<?php echo @$data->company?>" class="form-control" required>                                    
                      </div>

                      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                             <label class="control-label"  style="padding-top:8px;">Alamat</label>
                        </div>  
                       <div class="col-md-10 col-sm-10 col-xs-10 form-group">
                             <textarea  class="form-control" name="address" style="height:60px;"><?php echo @$data->address?></textarea>                                  
                      </div>

                       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                        </div>  
                       <div class="col-md-5 col-sm-5 col-xs-5 form-group">
                            <input type="text" name="city" placeholder="Kota" value="<?php echo @$data->city?>" class="form-control" >                                      
                      </div>
                      <div class="col-md-5 col-sm-5 col-xs-5 form-group">
                            <input type="text" name="zip" placeholder="Kode Pos" value="<?php echo @$data->zip?>" class="form-control" >                                      
                      </div>


                      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                      <label class="control-label"  style="padding-top:8px;">Telepon & Fax </label>
                        </div>  
                       <div class="col-md-5 col-sm-5 col-xs-5 form-group">
                            <input type="text" name="phone" placeholder="Telepon" value="<?php echo @$data->phone?>" class="form-control" >                                      
                      </div>
                      <div class="col-md-5 col-sm-5 col-xs-5 form-group">
                            <input type="text" name="fax" placeholder="Fax" value="<?php echo @$data->fax?>" class="form-control" >                                      
                      </div>
                  
                       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                             <label class="control-label"  style="padding-top:8px;">Email</label>
                        </div>  
                       <div class="col-md-10 col-sm-10 col-xs-10 form-group">
                             <input type="email" name="email" value="<?php echo @$data->email?>" required class="form-control" >                                    
                      </div>

                             <div class="form-group">
                               <div class="col-md-12 col-sm-12 col-xs-12" style='margin-top:20px;'>
                                  <input type="hidden" name="ID" value="<?php echo @$data->id_informasi_perusahaan?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 
                                  
                              </div>
                             </div>  

                       </form>
                       <!-- end form for validations -->


              </div>

            </div>      

          </div>

          <div id="menu1" class="tab-pane fade <?php if ($tab == 'sa') { echo 'in active primary'; } ?>">
              <br>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <div class="x_content">
                      
                      <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th width="15%" rowspan="2"><h3 style='font-size:12px;'>Jenis</h3></th>
                                          <th width="10%" rowspan="2"><h3 style='font-size:12px;'>Nilai Standart</h3></th>
                                          <th width="15%" rowspan="2"><h3 style='font-size:12px;'>Posting</h3></th>  
                                          <th width="" colspan="2" style='text-align:center;' ><h3 style='font-size:12px;'>Rekening</h3></th>  
                                          <th class='nosort' width="10%" style='text-align:center;' rowspan="2">
                                          <h3 style='font-size:12px;'>Aksi</h3>
                                          </th>   
                                        </tr>   
                                      <tr>                          
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Rekening Debet</h3></th>
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Rekening Kredit</h3></th>         
                                      </tr>
                                      </thead>
                                  <tbody>
                                  <?

                                   $SQL = "SELECT* FROM pg_setoran_awal 
                                            WHERE prd = '$prd' order by id_pg_setoran_awal";


                                  $tampil=mysql_query($SQL);
                                    
                                 $no = 1;
            
                                    while ($r=mysql_fetch_array($tampil)){  

                                    if ($r['nilai'] == '0') {
                                      $disabled = 'readonly';
                                    } else {  
                                      $disabled = '';
                                    }

                                                                          
                                    
                                    echo"<tr>";

                                    ?>

                                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=sa"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                     
                                     <td>                                         
                                         <input type="text" style='padding:6px;' name="jenis" 
                                         class="form-control" value="<?php echo $r['jenis'];?>" /> 
                            
                                     </td>

                                     <td>                                         
                                         <input type="text" style='padding:6px;text-align: right;' name="nilai" 
                                         class="form-control" <?php echo $disabled;?>  value="<?php echo $r['nilai'];?>" /> 
                            
                                     </td>

                                      <td>
                                         <select name="jenis_posting" class="form-control" required >
                                          <?
                                            $query = mysql_query('SELECT * FROM jenis_posting ORDER BY jenis_posting');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_jenis_posting.'"';
                                                   if($row->id_jenis_posting == $r['id_jenis_posting']) echo ' selected';
                                                   echo '>'.$row->jenis_posting.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>

                                        <td>
                                         <select name="rek_debet" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $r['rek_debet']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>

                                        <td>
                                          <select name="rek_kredit" class="form-control" required >
                                         <option value='0'></option>
                                         <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid !=  "0"  
                                                                  
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $r['rek_kredit']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>



                                    <?php   
                                    echo" <td  style='text-align:center;'>";     
                                    ?>                               
                                    <button type="submit"   class="btn btn-primary btn-sm">
                                                  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                    <?php            
                                    echo"</td>";              
                                    echo"</tr>";
                                $no++;
                                ?>

                                <input type="hidden" name="ID" value="<?php echo $r['id_pg_setoran_awal']?>" />
                                <input type="hidden" name="u_tab" value="<?php echo $r['u_tab']?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                                <?
                               echo"</form>";
                                
                                }

                                  ?>  



                                  </tbody>

                                </table>      
                            </div>
                        </div>
                      </div>            
                 </div>

          </div>    

          <div id="menu2" class="tab-pane fade <?php if ($tab == 'pd') { echo 'in active primary'; } ?>">
              <br>
                 <div class="row">

                  <?

                 $id = 1; // isset($_GET['id_general_setting']) ? intval($_GET['id_general_setting']) : false;
    
                    if($id){
                       $query = mysql_query('SELECT * FROM pg_penarikan_dana
                                             WHERE  prd = "'.$prd.'" ');
                       if($query && mysql_num_rows($query) == 1){
                          $data = mysql_fetch_object($query);
                       }else 
                          die('Data pg_penarikan_dana tidak ditemukan');
                    }
                  
         

                ?>
                   <!-- start form for validation -->
                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=pd"; ?>"   method="post" name="formData" enctype="multipart/form-data"  > 
                     
                     <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                     <span class="pull-right"><input type="submit" class="btn btn-primary" Value='Simpan'></span>
   
                       <br>
                      </div> 


                      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                      <label class="control-label"  style="padding-top:8px;">Max. Pencairan </label>
                        </div>  
                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="text" name="max_pencairan" placeholder="" value="<?php echo @$data->max_pencairan?>" class="form-control" style='text-align: right;' >                                      
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                            <label class="control-label"  style="padding-top:8px;">%</label>                                     
                      </div>

                      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                      <label class="control-label"  style="padding-top:8px;">Max. Penarikan </label>
                        </div>  
                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="text" name="max_penarikan" placeholder="" value="<?php echo @$data->max_penarikan?>" class="form-control" style='text-align: right;' >                                      
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                            <label class="control-label"  style="padding-top:8px;">Kali/Tahun</label>                                     
                      </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                      <label class="control-label"  style="padding-top:8px;">Jeda Waktu</label>
                        </div>  
                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="text" name="jeda_waktu" placeholder="" value="<?php echo @$data->jeda_waktu?>" class="form-control" style='text-align: right;' >                                      
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                            <label class="control-label"  style="padding-top:8px;">Bulan</label>                                     
                      </div>

                       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                      <label class="control-label"  style="padding-top:8px;">Tanggal Pencairan Dana</label>
                        </div>  
                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="text" name="tgl_realisasi" placeholder="" value="<?php echo @$data->tgl_realisasi?>" class="form-control"style='text-align: right;' >                                                                           
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                            <label class="control-label"  style="padding-top:8px;">Bulan Berikut</label>                                     
                      </div>

                   <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                             <label class="control-label"  style="padding-top:8px;">Rekening</label>
                               </div>  
                      <div class="col-md-4  col-sm-4 col-xs-4 form-group">
                               <select name="rek_debet" class="form-control" required >
                                <option value='0'></option>
                                 <?
                                   $query = mysql_query('SELECT * FROM rekening 
                               WHERE parentid != "0" 
                               
                               ORDER BY norek');
                                    if($query && mysql_num_rows($query) > 0){
                                       while($row = mysql_fetch_object($query)){
                                          echo '<option value="'.$row->id_rekening.'"';
                                          if($row->id_rekening == $data->rek_debet) echo ' selected';
                                          echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                       }
                                    }        
                                 ?>  
                                 </select>      
                             </div>
                       <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                              <label class="control-label"  style="padding-top:8px;">Debet</label>                             
                      </div>
                      <div class="col-md-4  col-sm-4 col-xs-4 form-group">
                               <select name="rek_kredit" class="form-control" required >
                                <option value='0'></option>
                                 <?
                                   $query = mysql_query('SELECT * FROM rekening 
                               WHERE parentid != "0" 
                               
                               ORDER BY norek');
                                    if($query && mysql_num_rows($query) > 0){
                                       while($row = mysql_fetch_object($query)){
                                          echo '<option value="'.$row->id_rekening.'"';
                                          if($row->id_rekening == $data->rek_kredit) echo ' selected';
                                          echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                       }
                                    }        
                                 ?>  
                                 </select>      
                             </div>
                       <div class="col-md-1 col-sm-1 col-xs-1 form-group">
                              <label class="control-label"  style="padding-top:8px;">Kredit</label>                             
                      </div>



                             <div class="form-group">
                               <div class="col-md-12 col-sm-12 col-xs-12" style='margin-top:20px;'>
                                  <input type="hidden" name="ID" value="<?php echo @$data->id_pg_penarikan_dana?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 
                                  
                              </div>
                             </div>  

                       </form>                       <!-- end form for validations -->



                 </div>

          </div>    

          <div id="menu3" class="tab-pane fade <?php if ($tab == 'pm') { echo 'in active primary'; } ?>">
              <br>
                 <div class="row" style="padding: 0px 10px 0px 10px;">

                  <ul class="nav nav-tabs" >

                   <li <?php if ($stab == 'tunai') { echo 'class="active"'; } ?> ><a data-toggle="tab" href="#tunai">Dana Tunai</a>
                    </li>
                    <li <?php if ($stab == 'barang') { echo 'class="active"'; } ?> ><a data-toggle="tab" href="#barang">Barang</a>
                    </li>
                  </ul>

                  <div class="tab-content">

                      <div id="tunai" class="tab-pane fade <?php if ($stab == 'tunai') { echo 'in active primary'; } ?>">
                      <br>

                     
                     

                       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                          <div class="x_content">

                           <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=pm"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 

                             <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <span class="pull-right"><input type="submit" class="btn btn-primary" Value='Simpan'></span>
                              </div>   


                           <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th width="20%" rowspan="2"><h3 style='font-size:12px;'></h3></th>  
                                          <th width="20%" colspan="2" style='text-align:center;padding: 2px;' ><h3 style='font-size:12px;'>Jenis</h3></th>
                                          <th width="1%" rowspan="2"><h3 style='font-size:12px;'></h3></th>  
                                          <th width="20%" colspan="2" style='text-align:center;;padding: 2px;' ><h3 style='font-size:12px;'>Rekening</h3></th>  
                                          <th class='nosort' width="10%" style='text-align:center;' rowspan="2">
                                          <h3 style='font-size:12px;'>
                                          </h3>
                                          </th>   
                                        </tr>   
                                      <tr>                          
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Konvensional</h3></th>
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Syariah</h3></th>  
                                                                                                 
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Debet</h3></th>
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Kredit</h3></th>         
                                      </tr>
                                      </thead>
                                  <tbody>

                                   <?

                                  $kSQL = "SELECT* FROM pg_peminjaman_tunai WHERE tipe = 'K'  AND  prd = '$prd'";


                                  $ktampil=mysql_query($kSQL);
                                    
                                        
                                  $k=mysql_fetch_array($ktampil);


                                  $sSQL = "SELECT* FROM pg_peminjaman_tunai WHERE tipe = 'S'  AND  prd = '$prd'";


                                  $stampil=mysql_query($sSQL);
                                    
                                        
                                  $s=mysql_fetch_array($stampil);


                                  ?>    

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Rekening</label></td>

                                   <td> </td>

                                   <td> </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"         
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>  

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Rekening Pelunasan</label></td>

                                   <td> </td>

                                   <td> </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_pelunasan_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"         
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_pelunasan']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_pelunasan_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_pelunasan']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>  

                                  
                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Min. Angsuran</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_tenor_k" 
                                         class="form-control" value="<?php echo $k['min_tenor'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_tenor_s" 
                                         class="form-control" value="<?php echo $s['min_tenor'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. Angsuran</label></td>

                                   <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_tenor_k" 
                                         class="form-control" value="<?php echo $k['max_tenor'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_tenor_s" 
                                         class="form-control" value="<?php echo $s['max_tenor'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. pengajuan</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_pinjaman_k" 
                                         class="form-control" value="<?php echo $k['max_pinjaman'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X Saldo</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_pinjaman_s" 
                                         class="form-control" value="<?php echo $s['max_pinjaman'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X Saldo</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. Angsuran</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_angsuran_k" 
                                         class="form-control" value="<?php echo $k['max_angsuran'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                              <label class="control-label"  style="padding-top:8px;">Gaji</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">    
                                         <input type="number" style='padding:6px;' name="max_angsuran_s" 
                                         class="form-control" value="<?php echo $s['max_angsuran'];?>" /> 
                                         </div>
                                           <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Gaji</label>                                           
                                          </div>
                                   </td>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Bunga</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="bunga_k" 
                                         class="form-control" value="<?php echo $k['bunga'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Bulan</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="bunga_s" 
                                         class="form-control" value="<?php echo $s['bunga'];?>" /> 
                                         </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Bulan</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_bunga_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_bunga']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_bunga_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"                                                                   
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_bunga']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Point</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="text" style='padding:6px;' name="ipoint_k" 
                                         class="form-control" value="<?php echo $k['ipoint'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Bulan</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="text" style='padding:6px;' name="ipoint_s" 
                                         class="form-control" value="<?php echo $s['ipoint'];?>" /> 
                                         </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Bulan</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_ipoint_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_ipoint']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_ipoint_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_ipoint']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Batas Sisa Angsuran Untuk Pengajuan Berikutnya</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="batas_sisa_angsuran_k" 
                                         class="form-control" value="<?php echo $k['batas_sisa_angsuran'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="batas_sisa_angsuran_s" 
                                         class="form-control" value="<?php echo $s['batas_sisa_angsuran'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Tanggal Pencairan Dana</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="tgl_realisasi_k" 
                                         class="form-control" value="<?php echo $k['tgl_realisasi'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan Berikut</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="tgl_realisasi_s" 
                                         class="form-control" value="<?php echo $s['tgl_realisasi'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan Berikut</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Min. Keanggotaan</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_keanggotaan_k" 
                                         class="form-control" value="<?php echo $k['min_keanggotaan'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_keanggotaan_s" 
                                         class="form-control" value="<?php echo $s['min_keanggotaan'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>



                                 <input type="hidden" name="stab" value="tunai" /> 
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                               </form>


                                  </tbody>

                                </table>      
                            </div>
                        </div>

                          </div>
                       </div>
                       
                       </div>

                        <div id="barang" class="tab-pane fade <?php if ($stab == 'barang') { echo 'in active primary'; } ?>">
                      <br>

                       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                          <div class="x_content">

                              <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=pm"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 

                             <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                 <span class="pull-right"><input type="submit" class="btn btn-primary" Value='Simpan'></span>
                              </div>   

 <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th width="20%" rowspan="2"><h3 style='font-size:12px;'></h3></th>  
                                          <th width="20%" colspan="2" style='text-align:center;padding: 2px;' ><h3 style='font-size:12px;'>Jenis</h3></th>
                                          <th width="1%" rowspan="2"><h3 style='font-size:12px;'></h3></th>  
                                          <th width="20%" colspan="2" style='text-align:center;;padding: 2px;' ><h3 style='font-size:12px;'>Rekening</h3></th>  
                                          <th class='nosort' width="10%" style='text-align:center;' rowspan="2">
                                          <h3 style='font-size:12px;'>
                                          </h3>
                                          </th>   
                                        </tr>   
                                      <tr>                          
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Konvensional</h3></th>
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Syariah</h3></th>  
                                                                                                 
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Debet</h3></th>
                                          <th width="20%" style='text-align:center;' ><h3 style='font-size:12px;'>Kredit</h3></th>         
                                      </tr>
                                      </thead>
                                  <tbody>

                                   <?

                                  $kSQL = "SELECT* FROM pg_peminjaman_barang WHERE tipe = 'K' AND prd = '$prd' ";


                                  $ktampil=mysql_query($kSQL);
                                    
                                        
                                  $k=mysql_fetch_array($ktampil);


                                  $sSQL = "SELECT* FROM pg_peminjaman_barang WHERE tipe = 'S' AND prd = '$prd' ";


                                  $stampil=mysql_query($sSQL);
                                    
                                        
                                  $s=mysql_fetch_array($stampil);


                                  ?>    

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Rekening</label></td>

                                   <td> </td>

                                   <td> </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"         
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>  

                                  
                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Rekening Pelunasan</label></td>

                                   <td> </td>

                                   <td> </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_pelunasan_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"         
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_pelunasan']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_pelunasan_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_pelunasan']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>  

                                  
                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Min. Angsuran</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_tenor_k" 
                                         class="form-control" value="<?php echo $k['min_tenor'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_tenor_s" 
                                         class="form-control" value="<?php echo $s['min_tenor'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. Angsuran</label></td>

                                   <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_tenor_k" 
                                         class="form-control" value="<?php echo $k['max_tenor'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_tenor_s" 
                                         class="form-control" value="<?php echo $s['max_tenor'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. pengajuan</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_pinjaman_k" 
                                         class="form-control" value="<?php echo $k['max_pinjaman'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X Saldo</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_pinjaman_s" 
                                         class="form-control" value="<?php echo $s['max_pinjaman'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X Saldo</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Max. Angsuran</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="max_angsuran_k" 
                                         class="form-control" value="<?php echo $k['max_angsuran'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                              <label class="control-label"  style="padding-top:8px;">Gaji</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">    
                                         <input type="number" style='padding:6px;' name="max_angsuran_s" 
                                         class="form-control" value="<?php echo $s['max_angsuran'];?>" /> 
                                         </div>
                                           <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Gaji</label>                                           
                                          </div>
                                   </td>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Bunga</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="bunga_k" 
                                         class="form-control" value="<?php echo $k['bunga'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Barang</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="bunga_s" 
                                         class="form-control" value="<?php echo $s['bunga'];?>" /> 
                                         </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Barang</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_bunga_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_bunga']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_bunga_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0"                                                                   
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_bunga']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Point</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="text" style='padding:6px;' name="ipoint_k" 
                                         class="form-control" value="<?php echo $k['ipoint'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Barang</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="text" style='padding:6px;' name="ipoint_s" 
                                         class="form-control" value="<?php echo $s['ipoint'];?>" /> 
                                         </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">% / Barang</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td>
                                     <select name="rek_debet_ipoint_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_debet_ipoint']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                   </td>                                   
                                   <td> 
                                    <select name="rek_kredit_ipoint_k" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $k['rek_kredit_ipoint']) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       


                                   </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Batas Sisa Angsuran Untuk Pengajuan Berikutnya</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="batas_sisa_angsuran_k" 
                                         class="form-control" value="<?php echo $k['batas_sisa_angsuran'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="batas_sisa_angsuran_s" 
                                         class="form-control" value="<?php echo $s['batas_sisa_angsuran'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                  <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Tanggal Terima Barang</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="tgl_realisasi_k" 
                                         class="form-control" value="<?php echo $k['tgl_realisasi'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="tgl_realisasi_s" 
                                         class="form-control" value="<?php echo $s['tgl_realisasi'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">X</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>

                                   <tr>
                                   <td><label class="control-label"  style="padding-top:8px;">Min. Keanggotaan</label></td>

                                   <td>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_keanggotaan_k" 
                                         class="form-control" value="<?php echo $k['min_keanggotaan'];?>" /> 
                                         </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan</label>                                           
                                          </div>
                                   </td>

                                    <td>
                                      <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                         <input type="number" style='padding:6px;' name="min_keanggotaan_s" 
                                         class="form-control" value="<?php echo $s['min_keanggotaan'];?>" /> 
                                         </div>
                                         <div class="col-md-6 col-sm-6 col-xs-6 form-group">  
                                              <label class="control-label"  style="padding-top:8px;">Bulan</label>                                           
                                          </div>
                                   </td>

                                   <td></td>
                                   <td> </td>                                   
                                   <td> </td>
                                   <td> </td>
                                  </tr>



                                   <input type="hidden" name="stab" value="barang" />                                  
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                               </form>


                                  </tbody>

                                </table>      
                            </div>
                        </div>

                          </div>
                       </div>
                       
                       </div>

                   </div>       

                 </div>

          </div>       

          <div id="menu4" class="tab-pane fade <?php if ($tab == 'pl') { echo 'in active primary'; } ?>">
             <br>

           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <div class="x_content">

               <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th width="50%" rowspan="2"><h3 style='font-size:12px;'>Jenis Pinjaman</h3></th>
                                          <th width="30%" rowspan="2"><h3 style='font-size:12px;'>Plafon</h3></th>
                                          <th width="10%" rowspan="2"><h3 style='font-size:12px;text-align: center;'>Aksi</h3></th>
                                      </tr>
                                      </thead>
                                  <tbody>
                                  <?

                                   $SQL = "SELECT* FROM pg_plafon a inner join jenis_pinjaman b
                                            ON a.id_jenis_pinjaman = b.id_jenis_pinjaman
                                            WHERE a.prd = '$prd'";


                                  $tampil=mysql_query($SQL);
                                    
                                 $no = 1;
            
                                    while ($r=mysql_fetch_array($tampil)){  
                                    
                                    echo"<tr>";

                                    ?>

                                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=pl"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                     
                                    
                                      <td>
                                         <select name="jenis_pinjaman" class="form-control" disabled>
                                          <?
                                            $query = mysql_query('SELECT * FROM jenis_pinjaman ORDER BY jenis_pinjaman');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_jenis_pinjaman.'"';
                                                   if($row->id_jenis_pinjaman == $r['id_jenis_pinjaman']) echo ' selected';
                                                   echo '>'.$row->jenis_pinjaman.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>

                                    <td>                                         
                                         <input type="text" style='padding:6px;text-align: right;' name="plafon" 
                                         class="form-control" value="<?php echo $r['plafon'];?>" /> 
                            
                                     </td>

                                    <?php   
                                    echo" <td  style='text-align:center;'>";     
                                    ?>                               
                                    <button type="submit"   class="btn btn-primary btn-sm">
                                                  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                    <?php            
                                    echo"</td>";              
                                    echo"</tr>";
                                $no++;
                                ?>

                                <input type="hidden" name="ID" value="<?php echo $r['id_pg_plafon']?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                                <?
                               echo"</form>";
                                
                                }

                                  ?>  



                                  </tbody>

                                </table>      
                            </div>
                        </div>

              </div>

            </div>      


          </div>   

          <div id="menu5" class="tab-pane fade <?php if ($tab == 'jr') { echo 'in active primary'; } ?>">
              <br>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <div class="x_content">
                      
                      <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th><h3 style='font-size:12px;'>Transaksi</h3></th>
                                          <th ><h3 style='font-size:12px;'>Jenis Transaksi</h3></th>
                                          <th><h3 style='font-size:12px;'>Aksi</h3></th>   
                                        </tr>                                         
                                      </thead>
                                  <tbody>
                                  <?

                                   $SQL = "SELECT* FROM pg_jurnal WHERE prd = '$prd' ORDER BY id_pg_jurnal";


                                  $tampil=mysql_query($SQL);
                                    
                                 $no = 1;
            
                                    while ($r=mysql_fetch_array($tampil)){  
                                                                          
                                    
                                    echo"<tr>";

                                    ?>

                                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=jr"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                     
                                         
                                          <td>
                                         <select name="modul" class="form-control" required >
                                          <?
                                            $query = mysql_query('SELECT * FROM modul WHERE jurnal = "Y" and aktif = "Y" ORDER BY nama_modul');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_modul.'"';
                                                   if($row->id_modul == $r['id_modul']) echo ' selected';
                                                   echo '>'.$row->nama_modul.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>
                          

                                        <td>
                                         <select name="jenis_transaksi" class="form-control" required >
                                          <?
                                            $query = mysql_query('SELECT a.*,b.kode,b.tipe_transaksi 
                                                                  FROM jenis_transaksi a inner join tipe_transaksi b
                                                                  ON a.id_tipe_transaksi = b.id_tipe_transaksi
                                                                  ORDER BY a.id_tipe_transaksi,a.id_jenis_transaksi');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_jenis_transaksi.'"';
                                                   if($row->id_jenis_transaksi == $r['id_jenis_transaksi']) echo ' selected';
                                                   echo '>'.$row->kode.' - '.$row->tipe_transaksi.' - '.$row->jenis_transaksi.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>       

                                       </td>

                                         

                                    <?php   
                                    echo" <td  style='text-align:center;'>";     
                                    ?>                               
                                    <button type="submit"   class="btn btn-primary btn-sm">
                                                  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                    <?php            
                                    echo"</td>";              
                                    echo"</tr>";
                                $no++;
                                ?>

                                <input type="hidden" name="ID" value="<?php echo $r['id_pg_jurnal']?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                                <?
                               echo"</form>";
                                
                                }

                                  ?>  



                                  </tbody>

                                </table>      
                            </div>
                        </div>
                      </div>            
                 </div>

          </div>    




           <div id="menu6" class="tab-pane fade <?php if ($tab == 'ln') { echo 'in active primary'; } ?>">
             <br>

           <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <div class="x_content">

                <?

                 $id = 1; // isset($_GET['id_general_setting']) ? intval($_GET['id_general_setting']) : false;
    
                    if($id){
                       $query = mysql_query('SELECT * FROM pg_lainnya 
                                                WHERE prd =  "'.$prd.'"
                                                ');

                       if($query && mysql_num_rows($query) == 1){
                          $data = mysql_fetch_object($query);
                       }else 
                          die('Data general_setting tidak ditemukan');
                    }
                  


                ?>
                   <!-- start form for validation -->
                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=ln"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                     
                     <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                     <span class="pull-right"><input type="submit" class="btn btn-primary" Value='Simpan'></span>
                     </div>

                     
                      <div class="col-md-3 col-sm-3 col-xs-3 form-group">
                      <label class="control-label"  style="padding-top:8px;">Harga Saham </label>
                        </div>  
                       <div class="col-md-7  col-sm-7 col-xs-7 form-group">
                            <input type="text" name="harga_saham" placeholder="" value="<?php echo @$data->harga_saham?>" class="form-control" style='text-align: right;' >                                      
                      </div>

                      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                            <label class="control-label"  style="padding-top:8px;">/ Lembar</label>                                     
                      </div>

                       <div class="col-md-3 col-sm-3 col-xs-3 form-group">
                      <label class="control-label"  style="padding-top:8px;">Rekening SHU </label>
                        </div>  
                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <select name="rek_shu" class="form-control" required >
                                         <option value='0'></option>
                                          <?
                                            $query = mysql_query('SELECT * FROM rekening 
                                                                  WHERE parentid != "0" 
                                                                  ORDER BY norek');
                                             if($query && mysql_num_rows($query) > 0){
                                                while($row = mysql_fetch_object($query)){
                                                   echo '<option value="'.$row->id_rekening.'"';
                                                   if($row->id_rekening == $data->rek_shu) echo ' selected';
                                                   echo '>'.$row->norek.' - '.$row->rekening.'</option>';
                                                }
                                             }        
                                          ?>  
                                          </select>                                         
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label class="control-label"  style="padding-top:8px;">Realisasi Pengajuan Transaksi :</label>
                        </div>      
                      </div>

                        <div class="col-md-3 col-sm-3 col-xs-3 form-group" >
                      <label class="control-label" style='padding-left: 15px;padding-top:8px;'>Pengajuan Kurang Dari Tanggal</label>
                        </div>  

                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="number" name="ftgl" placeholder="" value="<?php echo @$data->ftgl?>" class="form-control2" style='text-align: right;' >     

                            <label class="control-label"  style="padding-top:8px;">&nbsp Realisasi Pada &nbsp </label>  

                            <input type="number" name="fbln" placeholder="" value="<?php echo @$data->fbln?>" class="form-control2" style='text-align: right;' >     

                            <label class="control-label"  style="padding-top:8px;">&nbsp Bulan Berikutnya &nbsp</label>

                      </div> 

                        <div class="col-md-3 col-sm-3 col-xs-3 form-group" >
                      <label class="control-label" style='padding-left: 15px;padding-top:8px;'>Pengajuan Lebih Dari Tanggal</label>
                        </div>  

                       <div class="col-md-9  col-sm-9 col-xs-9 form-group">
                            <input type="number" name="ltgl" placeholder="" value="<?php echo @$data->ltgl?>" class="form-control2" style='text-align: right;' >     

                            <label class="control-label"  style="padding-top:8px;">&nbsp Realisasi Pada &nbsp </label>  

                            <input type="number" name="lbln" placeholder="" value="<?php echo @$data->lbln?>" class="form-control2" style='text-align: right;' >     

                            <label class="control-label"  style="padding-top:8px;">&nbsp Bulan Berikutnya &nbsp</label>

                      </div> 
                
                      <div class="form-group">
                               <div class="col-md-12 col-sm-12 col-xs-12" style='margin-top:20px;'>
                                  <input type="hidden" name="ID" value="<?php echo @$data->id_pg_lainnya?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 
                                  
                              </div>
                             </div>  

                       </form>
                       <!-- end form for validations -->


              </div>

            </div>      


          </div>   



    </div>
    
  </div>      
      
</div>

<script src="../../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../../js/icheck/icheck.min.js"></script>
        <!-- tags -->
        <script src="../../js/tags/jquery.tagsinput.min.js"></script>
        <!-- switchery -->
        <script src="../../js/switchery/switchery.min.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="../../js/moment.min2.js"></script>
        <script type="text/javascript" src="../../js/datepicker/daterangepicker.js"></script>
        <!-- richtext editor -->
        <script src="../../js/editor/bootstrap-wysiwyg.js"></script>
        <script src="../../js/editor/external/jquery.hotkeys.js"></script>
        <script src="../../js/editor/external/google-code-prettify/prettify.js"></script>
        <!-- select2 -->
        <script src="../../js/select/select2.full.js"></script>
        <!-- form validation -->
        <script type="text/javascript" src="../../js/parsley/parsley.min.js"></script>
        <!-- textarea resize -->
        <script src="../../js/textarea/autosize.min.js"></script>
        <script>
            autosize($('.resizable_textarea'));
        </script>
        <!-- Autocomplete -->
        <script type="text/javascript" src="../../js/autocomplete/countries.js"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js"></script>
        <script type="text/javascript">
            $(function () {
                'use strict';
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // Initialize autocomplete with custom appendTo:
                $('#autocomplete-custom-append').autocomplete({
                    lookup: countriesArray,
                    appendTo: '#autocomplete-container'
                });
            });
        </script>
        <script src="../../js/custom.js"></script>


        <!-- select2 -->
        <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
        </script>
        <!-- /select2 -->
        <!-- input tags -->
        <script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
        </script>
        <!-- /input tags -->
        <!-- form validation -->
        <script type="text/javascript">
            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form .btn').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function () {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script>
        <!-- /form validation -->
        <!-- editor -->
        <script>
            $(document).ready(function () {
                $('.xcxc').click(function () {
                    $('#descr').val($('#editor').html());
                });
            });

            $(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                            return false;
                        })
                        .change(function () {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function () {
                            this.value = '';
                            $(this).change();
                        });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                            target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });
                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();
                        $('#voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('#voiceBtn').hide();
                    }
                };

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                };
                initToolbarBootstrapBindings();
                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });
                window.prettyPrint && prettyPrint();
            });
        </script>
        <!-- /editor -->

         <?php 

         $id = 1; // isset($_GET['id_general_setting']) ? intval($_GET['id_general_setting']) : false;
    
                    if($id){
                       $query = mysql_query('SELECT * FROM informasi_perusahaan WHERE id_informasi_perusahaan = "'.$id.'"');
                       if($query && mysql_num_rows($query) == 1){
                          $data = mysql_fetch_object($query);
                       }else 
                          die('Data general_setting tidak ditemukan');
                    }
                  
                    $pict  = $data->pict;


         if(empty($pict)) { 
            $ipict = 'logo.png';
           } else { 
            $ipict = $pict;
           } 
           ?>

        <script>
          var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
              'onclick="alert(\'Call your custom code here.\')">' +
              '<i class="glyphicon glyphicon-tag"></i>' +
              '</button>'; 
          $("#avatar").fileinput({
              overwriteInitial: true,
              maxFileSize: 1500,
              showClose: false,
              showCaption: false,
              browseLabel: '',
              removeLabel: '',
              browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
              removeTitle: 'Cancel or reset changes',
              elErrorContainer: '#kv-avatar-errors',
              msgErrorClass: 'alert alert-block alert-danger',
              defaultPreviewContent: '<img src="../../images/logo/<?php echo $ipict;?>" alt="Your Avatar" style="width:180px;">',
              layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
              allowedFileExtensions: ["jpg"]
          });
          </script>

          <?php 
         if(empty($pict)) { 
            $ipict = 'logo.png';
           } else { 
            $ipict = $pict;
           } 

           ?>

        <script>
          var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
              'onclick="alert(\'Call your custom code here.\')">' +
              '<i class="glyphicon glyphicon-tag"></i>' +
              '</button>'; 
          $("#avatar").fileinput({
              overwriteInitial: true,
              maxFileSize: 1500,
              showClose: false,
              showCaption: false,
              browseLabel: '',
              removeLabel: '',
              browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
              removeTitle: 'Cancel or reset changes',
              elErrorContainer: '#kv-avatar-errors',
              msgErrorClass: 'alert alert-block alert-danger',
              defaultPreviewContent: '<img src="../../images/logo/<?php echo $ipict;?>" alt="Your Avatar" style="width:180px;">',
              layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
              allowedFileExtensions: ["jpg"]
          });
          </script>

</body>
</html>
<?
}
?>