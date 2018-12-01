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
    if ($module=='modul' and $act=='hapus') {
        $id_module = $_GET['id_module'];
        $id = $_GET['id'];

        mysql_query('DELETE FROM '.$module.' WHERE id_'.$module." = $id");

        header('location:../../main.php?module='.$module.'&id_module='.$id_module);
    }

    // Input modul
    elseif ($module=='modul' and $act=='input') {
        if ($_POST['is_form']=='Y') {
            $link = $_POST['link'];
        } else {
            if ($_POST['link']) {
                $link = '?module='.$_POST['link'];
            } else {
                $link = '';
            }
        }

        $icon = $_POST['icon'];

        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                 is_form    = '$_POST[is_form]',
                                link        = '$_POST[link]',
                                icon        = '$_POST[icon]',
                                aktif       = '$_POST[aktif]',          
                                urutan      = '$_POST[urutan]'  
                          WHERE id_modul    = '$_POST[ID]'");
        } else {
            mysql_query("INSERT INTO modul(nama_modul,
                                     link,
                                     status_menu,
                                     parentid,  
                                     is_form,
                                     is_report,
                                     orientation,
                                     icon,    
                                     aktif,
                                     urutan) 
                               VALUES('$_POST[nama_modul]',
                                       '$link',
                                       'M',
                                        '0',
                                        '$_POST[is_form]',
                                        'N',
                                        'P',
                                        '$_POST[icon]',
                                          '$_POST[aktif]',
                                        '$_POST[urutan]')");
        }

        //header('location:../../main.php?module='.$module.'&id_module='.$id_module);?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    } elseif ($module=='modul' and $act=='hapusmod') {
        // membaca ID dari data yang akan dihapus
    $id = $_GET['id'];
        $id_module = $_GET['id_module'];

        mysql_query("DELETE a
                FROM business_group a LEFT JOIN modul b
                ON a.id_source = b.id_modul
                WHERE a.id_modul = '$id_module'
                AND b.parentid = '$id'");
        mysql_query("DELETE FROM business_group WHERE id_modul = '$id_module' AND id_source = '$id'");

        mysql_query("DELETE FROM modul WHERE id_modul = '$id'");
        mysql_query("DELETE FROM modul WHERE parentid = $id");

        //header('location:../../main.php?module='.$module.'&id_module='.$id_module);?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    } elseif ($module=='modul' and $act=='subinput') {
        if ($_POST['is_form']=='Y') {
            $link = $_POST['link'];
        } else {
            if ($_POST['link']) {
                $link = '?module='.$_POST['link'];
            } else {
                $link = '';
            }
        }

        $icon = $_POST['icon'];

        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                 link        = '$_POST[link]',
                                is_form   = '$_POST[is_form]',
                                is_report   = '$_POST[is_report]',  
                                orientation = '$_POST[orientation]',
                                icon        = '$_POST[icon]',
                                aktif       = '$_POST[aktif]',            
                                urutan      = '$_POST[urutan]'  
                          WHERE id_modul    = '$_POST[ID]'");
        } else {
            mysql_query("INSERT INTO modul(nama_modul,
                                 link,
                                 status_menu,
                                 parentid,
                                 is_form,
                                 is_report,
                                 orientation,
                                 icon,
                                 aktif,
                                 urutan) 
                         VALUES('$_POST[nama_modul]',
                                '$link',
                                'C',
                                '$_POST[parentid]', 
                                '$_POST[is_form]',  
                                '$_POST[is_report]',  
                                '$_POST[orientation]',  
                                '$icon',
                                '$_POST[aktif]',
                                '$_POST[urutan]')");
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
