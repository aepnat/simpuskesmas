<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else {
    include './../../config/koneksi.php';
    include './../../config/fungsi_thumb.php';

    $module = $_GET[module];
    $act = $_GET[act];

    $date = date('d/m/Y');
    $idate = date('Y-m-d');
    $hour = time() - (1 * 1 * 60 * 60);
    $datetime = date('Y-m-d G:i:s', $hour);
    $userid = $_SESSION['userid'];
    $business_type = $_SESSION['business_type'];

    // Hapus modul
    if ($module == 'pasien' and $act == 'hapus') {
        $id = $_GET['id'];
        $id_module = $_GET['id_module'];

        mysql_query('DELETE FROM '.$module.' WHERE id_'.$module." = $id");

        //header('location:../../main.php?module='.$module.'&id_module='.$id_module);?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    }

    // Input group
    elseif ($module == 'pasien' and $act == 'input') {
        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE pasien SET ktp   = '$_POST[ktp]'
                    ,bpjs   = '$_POST[bpjs]'
                    ,nama   = '$_POST[nama]'
                    ,gender   = '$_POST[gender]'    
                    ,tgl_lahir   = '$_POST[tgl_lahir]'    
                    ,id_agama   = '$_POST[agama]'    
                    ,id_kategori   = '$_POST[kategori]'                        
                    ,telp   = '$_POST[telp]'         
                    ,alamat   = '$_POST[alamat]'         
                    ,upddt   = '$datetime' 
                    ,updby   = '$userid' 
                    ,aktif     = '$_POST[aktif]'  
                 WHERE id_pasien    = '$_POST[ID]'");
        } else {
            mysql_query("INSERT INTO pasien(ktp
                   ,bpjs
                   ,nama
                   ,gender
                   ,tgl_lahir
                   ,id_agama
                   ,id_kategori
                   ,telp
                   ,alamat
                   ,crtdt
                   ,crtby
                   ,upddt
                   ,updby
                   ,aktif) 
                    VALUES('$_POST[ktp]' 
                   ,'$_POST[bpjs]' 
                   ,'$_POST[nama]' 
                   ,'$_POST[gender]'    
                   ,'$_POST[tgl_lahir]'    
                   ,'$_POST[agama]'    
                   ,'$_POST[kategori]'    
                   ,'$_POST[telp]'    
                   ,'$_POST[alamat]'    
                   ,'$datetime'
                  ,'$userid'
                  ,'$datetime'
                  ,'$userid'
                    ,'$_POST[aktif]')");
        }

        //header('location:../../main.php?module='.$module.'&id_module='.$id_module);?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    }
}
    ?>
