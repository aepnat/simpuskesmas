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
    if ($module == 'groupmodul' and $act == 'hapus') {
        $id = $_GET['id'];

        mysql_query('DELETE FROM '.$module.' WHERE id_'.$module." = $id");

        $id_module = $_GET['id_module'];

        header('location:../../main.php?module='.$module.'&id_module='.$id_module);
    }

    // Input groupmodul
    elseif ($module == 'groupmodul' and $act == 'input') {
        $jum = $_POST['jum'];

        mysql_query("DELETE FROM groupmodul WHERE id_groups = '$_POST[groups]' AND id_modul = '$_POST[imenu]'");

        mysql_query("INSERT INTO groupmodul(id_groups
                         ,id_modul
                        ,crtdt
                          ,crtby
                          ,upddt
                          ,updby  
                        ,aktif) 
                       VALUES('$_POST[groups]'
                        ,'$_POST[imenu]'
                        ,'$datetime'
                        ,'$userid'
                        ,'$datetime'
                        ,'$userid'
                        ,'Y')");

        for ($i = 1; $i <= $jum; $i++) {
            $id = $_POST['id'.$i];
            $modul = $_POST['modul'.$i];

            mysql_query("DELETE FROM groupmodul WHERE id_groups = '$_POST[groups]' AND id_modul = '$modul'");

            if (!empty($id)) {
                mysql_query("INSERT INTO groupmodul(id_groups
                         ,id_modul
                        ,crtdt
                          ,crtby
                          ,upddt
                          ,updby
                         ,aktif) 
                       VALUES('$_POST[groups]'
                        ,'$modul'
                        ,'$datetime'
                        ,'$userid'
                        ,'$datetime'
                        ,'$userid'
                        ,'Y')");
            }
        }

        $id_module = $_POST['id_module']; ?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    }
}
?>
