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
    if ($module == 'kunjungan_berobat' and $act == 'hapus') {
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
    elseif ($module == 'kunjungan_berobat' and $act == 'input') {
        $id_module = $_POST['id_module'];

        if ($_POST['ID']) {
            mysql_query("UPDATE kunjungan_berobat SET tanggal   = '$_POST[tanggal]'
                    ,id_pasien   = '$_POST[pasien]'
                    ,id_poli   = '$_POST[poli]'    
                    ,upddt   = '$datetime' 
                    ,updby   = '$userid' 
                    ,aktif     = '$_POST[aktif]'  
                 WHERE id_kunjungan_berobat    = '$_POST[ID]'");
        } else {
            $sql = mysql_query("select no_urut from kunjungan_berobat 
                     where tanggal='$_POST[tanggal]' 
                     and id_poli   = '$_POST[poli]'   ");

            $r = mysql_fetch_array($sql);

            if ($r['no_urut']) {
                $no_urut = $r['no_urut'] + 1;
            } else {
                $no_urut = 1;
            }

            mysql_query("INSERT INTO kunjungan_berobat(tanggal
                    ,no_urut
                   ,id_pasien
                   ,id_poli
                   ,crtdt
                   ,crtby
                   ,upddt
                   ,updby) 
                    VALUES('$_POST[tanggal]' 
                   ,'$no_urut'  
                   ,'$_POST[pasien]' 
                   ,'$_POST[poli]'    
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
