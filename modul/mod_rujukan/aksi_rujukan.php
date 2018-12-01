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

    // Hapus modul
    if ($module == 'rujukan' and $act == 'hapus') {
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
    elseif ($module == 'rujukan' and $act == 'input') {
        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE rujukan SET tipe   = '$_POST[tipe]'
                    ,rujukan   = '$_POST[rujukan]'
                    ,upddt   = '$datetime' 
                  ,updby   = '$userid' 
                  ,aktif     = '$_POST[aktif]'  
                          WHERE id_rujukan    = '$_POST[ID]'");
        } else {
            mysql_query("INSERT INTO rujukan(tipe
                   ,rujukan 
                   ,crtdt
                   ,crtby
                   ,upddt
                   ,updby
                   ,aktif) 
                    VALUES('$_POST[tipe]'  
                    ,'$_POST[rujukan]'     
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
