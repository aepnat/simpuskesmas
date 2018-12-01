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
    if ($module=='resep_obat' and $act=='dhapus') {
        $id = $_GET['id'];
        $id_module = $_GET['id_module'];
        $id_kunjungan_berobat = $_GET['id_kunjungan_berobat'];

        mysql_query("DELETE FROM kunjungan_berobat_detail WHERE id_kunjungan_berobat_detail = $id");

        mysql_query("UPDATE obat SET jumlah   = jumlah+'$_GET[qty]'
                              ,upddt   = '$datetime'
                              ,updby   = '$userid' 
                        WHERE id_obat    = '$_GET[obat]'");

        header('location:form_'.$module.'.php?id_kunjungan_berobat='.$id_kunjungan_berobat.'&module='.$module.'&id_module='.$id_modul);
    }

    // Input group
    elseif ($module=='resep_obat' and $act=='input') {
        $id_module = $_POST['id_module'];
        $id_kunjungan_berobat = $_POST['id_kunjungan_berobat'];

        if ($_POST['ID']) {
            mysql_query("UPDATE kunjungan_berobat_detail SET id_obat   = '$_POST[obat]'
                              ,qty   = '$_POST[qty]'  
                              ,descr   = '$_POST[descr]'
                            ,upddt   = '$datetime'
                            ,updby   = '$userid' 
                      WHERE id_kunjungan_berobat_detail    = '$_POST[ID]'");

            mysql_query("UPDATE obat SET jumlah   = jumlah+'$_POST[eqty]'
                            ,upddt   = '$datetime'
                            ,updby   = '$userid' 
                      WHERE id_obat    = '$_POST[obat]'");

            mysql_query("UPDATE obat SET jumlah   = jumlah-'$_POST[qty]'
                            ,upddt   = '$datetime'
                            ,updby   = '$userid' 
                      WHERE id_obat    = '$_POST[obat]'");
        } else {
            mysql_query("INSERT INTO kunjungan_berobat_detail(id_obat
                            ,qty
                            ,descr
                            ,id_kunjungan_berobat
                           ,crtdt
                           ,crtby
                           ,upddt
                           ,updby) 
                   VALUES('$_POST[obat]'
                          ,'$_POST[qty]'
                          ,'$_POST[descr]'
                          ,'$id_kunjungan_berobat'
                          ,'$datetime'
                          ,'$userid'
                          ,'$datetime'      
                          ,'$userid')");

            mysql_query("UPDATE obat SET jumlah   = jumlah-'$_POST[qty]'
                              ,upddt   = '$datetime'
                              ,updby   = '$userid' 
                        WHERE id_obat    = '$_POST[obat]'");
        }
        header('location:form_'.$module.'.php?id_kunjungan_berobat='.$id_kunjungan_berobat.'&module='.$module.'&id_module='.$id_modul);
    }  // Input group
    elseif ($module=='resep_obat' and $act=='close') {
        $id_module = $_POST['id_module']; ?>
  
    <script language="javascript">
       window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
       window.parent.tb_remove();
     </script> 
  
  <?php
        }
}
    ?>
