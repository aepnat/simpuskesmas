<?php
error_reporting(0);session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else {
    include './../../config/koneksi.php';
    include './../../config/fungsi_thumb.php';

    $module = $_GET[module];
    $act = $_GET['act'];

    $date = date('d/m/Y');
    $idate = date('Y-m-d');
    $hour = time() - (1 * 1 * 60 * 60);
    $datetime = date('Y-m-d G:i:s', $hour);
    $userid = $_SESSION['userid'];

    // Hapus modul
    if ($module == 'penyakit' and $act == 'hapus') {
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
    elseif ($module == 'penyakit' and $act == 'input') {
        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE penyakit SET penyakit   = '$_POST[penyakit]'
                    ,upddt   = '$datetime' 
                    ,updby   = '$userid' 
                 WHERE id_penyakit    = '$_POST[ID]'");
        } else {
            mysql_query("INSERT INTO penyakit(penyakit
                   ,crtdt
                   ,crtby
                   ,upddt
                   ,updby) 
                   VALUES('$_POST[penyakit]' 
                   ,'$datetime'
                   ,'$userid'
                   ,'$datetime'
                   ,'$userid')");
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
