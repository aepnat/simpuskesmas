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
    $business_type = $_SESSION['business_type'];

    if ($module == 'rekam_medis' and $act == 'update') {
        $id_module = $_POST['id_module'];

        mysql_query("UPDATE kunjungan_berobat SET keluhan   = '$_POST[keluhan]'
                    ,id_penyakit   = '$_POST[penyakit]'
                    ,diagnosa   = '$_POST[diagnosa]'
                    ,pemeriksaan   = '$_POST[pemeriksaan]'
                    ,tindakan   = '$_POST[tindakan]'
                    ,rujukan   = '$_POST[rujukan]'
                    ,upddt   = '$datetime' 
                    ,updby   = '$userid' 
                    ,status     = '1'  
                 WHERE id_kunjungan_berobat    = '$_POST[ID]'");

        //header('location:../../main.php?module='.$module.'&id_module='.$id_module);?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    }
}
    ?>
