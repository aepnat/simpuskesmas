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

    if ($module == 'approval_diskon_penjualan_barang' and $act == 'approve') {
        $id_module = $_POST['id_module'];

        $jum = $_POST['jum'] - 1;

        for ($i = 1; $i <= $jum; $i++) {
            $id = $_POST['id'.$i];
            $p_status = $_POST['p_status'.$i];
            $status = $_POST['status'.$i];
            $prd = $_POST['prd'.$i];

            $kode = 'PJ';
            $notrans = $_POST['notrans'.$i];
            $outlet = $_POST['outlet'.$i];

            if ($p_status == '1') {
                mysql_query("UPDATE penjualan_barang_detail
                    SET disc       = disc1
                      , disc_value = disc_value1      
                      ,tax_value    = ((total - (total*disc1)/100)*tax)/100      
                    WHERE id_penjualan_barang_detail = '$id'
                    ");

                mysql_query("UPDATE penjualan_barang_detail
                    SET disc1       = 0
                      , disc_value1 = 0
                      , status_diskon =  '$p_status'            
                    WHERE id_penjualan_barang_detail = '$id'
                    ");

                mysql_query("UPDATE penjualan_barang_detail SET gtotal   = total-disc_value+tax_value
                                ,upddt   = '$datetime' 
                                ,updby   = '$userid' 
                            WHERE id_penjualan_barang_detail = '$id'
                              ");

                mysql_query("UPDATE penjualan_barang as a 
                                left join
                                  (SELECT  prd
                                    , notrans
                                    , kode
                                    , id_outlet
                                    , sum(total) as total
                                    , sum(disc_value) as disc_value
                                    , sum(tax_value) as tax_value
                                    , sum(gtotal) as gtotal
                                  from penjualan_barang_detail 
                                  WHERE notrans= '$notrans'
                                  AND prd = '$prd'
                                  AND kode = '$kode' 
                                  AND id_outlet = '$outlet'
                                  AND status = '0'
                                  GROUP BY  notrans
                                      ,prd 
                                      ,kode
                                      ,id_outlet          
                                  ) as b        
                                ON  a.prd     = b.prd
                                AND a.notrans = b.notrans
                                AND a.kode    = b.kode
                                and a.id_outlet = b.id_outlet
                                 SET a.total = ifnull(b.total,0) 
                                 , a.disc_value = ifnull(b.disc_value,0) 
                                 , a.tax_value = ifnull(b.tax_value,0) 
                                 , a.gtotal = ifnull(b.gtotal,0) 
                                WHERE a.notrans= '$notrans'
                                AND a.prd = '$prd'
                                AND a.kode = '$kode' 
                                AND a.id_outlet = '$outlet'  
                                AND a.status = '0' 
                          ");
            } else {
                mysql_query("UPDATE penjualan_barang_detail
                    SET status_diskon =  '$p_status'            
                    WHERE id_penjualan_barang_detail = '$id'
                    ");
            }
        }

        $istatus = $_POST['istatus'];
        $prd = $_POST['prd'];
        $outlet = $_POST['outlet']; ?>
   
  <script language="javascript">
     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module&outlet=$outlet&prd=$prd&istatus=$istatus"; ?>";  
     window.parent.tb_remove();
   </script>
  
  <?php
    }
}
?>
