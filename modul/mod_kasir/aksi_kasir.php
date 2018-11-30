<?php

session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['password'])){

  echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";

} else{

include "./../../config/koneksi.php";

include "./../../config/fungsi_thumb.php";



$module=$_GET[module];

$act=$_GET[act];



$date     = date("d/m/Y");  

$idate    = date("Y-m-d");

$hour = time() - (1 * 1 * 60 * 60);

$datetime   = date("Y-m-d G:i:s", $hour);

$userid   = $_SESSION['userid'];





// Hapus modul

if ($module=='kasir' AND $act=='hapus'){

  $id = $_GET['id'];

  $id_module = $_GET['id_module'];





  mysql_query("UPDATE kasir SET status   = '4'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                              WHERE id_kasir = '$id'");  



  mysql_query("UPDATE kasir_detail SET status   = '4'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                            WHERE id_kasir = '$id'

                              "); 



  

  header('location:../../main.php?module='.$module.'&id_module='.$id_module.'&kode='.$kode.'&prd='.$prd.'&notrans='.$notrans.'&outlet='.$outlet);          
   

 }



  // Input group

elseif ($module=='kasir' AND $act=='input'){



 $id_module = $_POST['id_module'];

       
if($_POST['ID']){


  mysql_query("UPDATE kasir SET tanggal   = '$_POST[tanggal]'

                                    ,id_shift   = '$_POST[shift]'

                                    ,petugas  = '$_POST[petugas]'

                                    ,upddt   = '$datetime' 

                                    ,updby   = '$userid' 

                                  WHERE id_kasir = '$_POST[ID]'");            

  
                          

       } else {

       mysql_query("INSERT INTO kasir (tanggal

                            , id_shift

                            , petugas


                            , status

                            ,crtdt

                            ,crtby

                            ,upddt

                            ,updby   

                            )

                        VALUES('$_POST[tanggal]'

                        ,'$_POST[shift]' 

                        ,'$_POST[petugas]' 

                        ,'0' 

                        ,'$datetime'

                        ,'$userid'

                        ,'$datetime'

                        ,'$userid')");  

                    

        }


         $sql  = mysql_query("SELECT max(id_kasir) as id FROM kasir");
      

         $r    = mysql_fetch_array($sql); 
         
       
         $k_ID= $r['id'];
       

  ?>

   

  <script language="javascript">

     window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module&act=save&ID=$k_ID";?>";  

   </script>

  

  <?php                               

 



}



elseif ($module=='kasir' AND $act=='add'){



 $id_module = $_POST['id_module'];

 $k_ID        = $_POST['k_ID'];


 $detil  = mysql_query("SELECT max(seqno) as seqno 

                              FROM kasir_detail 

                              WHERE id_kasir = '$k_ID'

                          

                              ");



 $d         = mysql_fetch_array($detil);

  

 $seqno  = $d['seqno'];

  

  if (empty($seqno)) {

  $iseqno = '1';  

  } else {

  $iseqno = $seqno+1;     

  }

 

   if($_POST['ID']){


         mysql_query("UPDATE kasir_detail SET notrans ='$_POST[notrans]' 

                                , pasien ='$_POST[pasien]' 

                                , id_jenis_transaksi ='$_POST[jenis_transaksi]' 

                                , id_jenis_pembayaran ='$_POST[jenis_pembayaran]' 

                                , id_penjamin ='$_POST[penjamin]' 

                                , jumlah ='$_POST[jumlah]' 

                                , ket    ='$_POST[ket]' 

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                              WHERE id_kasir_detail = '$_POST[ID]'

                              ");  


                                                                           

       } else {

       mysql_query("INSERT INTO kasir_detail (

                              id_kasir

                            , notrans 

                            , seqno

                            , pasien

                            , id_jenis_transaksi

                            , id_jenis_pembayaran

                            , id_penjamin

                            , jumlah

                            , ket

                            , status

                            ,crtdt

                            ,crtby

                            ,upddt

                            ,updby   

                            )

                        VALUES('$_POST[k_ID]'                           

                        ,'$_POST[notrans]'     

                        ,'$iseqno'

                        ,'$_POST[pasien]' 

                        ,'$_POST[jenis_transaksi]'  

                        ,'$_POST[jenis_pembayaran]'  

                        ,'$_POST[penjamin]' 

                        ,'$_POST[jumlah]' 

                        ,'$_POST[ket]'  

                        ,'0' 

                        ,'$datetime'

                        ,'$userid'

                        ,'$datetime'

                        ,'$userid')");  




                             

   }

       

  ?>

   

  <script language="javascript">

       window.parent.location.href = "<?php echo"./../../main.php?module=$module&id_module=$id_module&act=save&ID=$k_ID";?>";  

   </script>

  

  <?php                               

 



}



elseif ($module=='kasir' AND $act=='dhapus'){

  $id = $_GET['id'];

  $id_module = $_GET['id_module'];

  $k_ID        = $_GET['k_ID'];



   mysql_query("UPDATE kasir_detail SET status   = '4'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                              WHERE id_kasir_detail = '$id'");     

                                                            





  header('location:../../main.php?module='.$module.'&id_module='.$id_module.'&act=save&ID='.$k_ID);          



   

 }



elseif ($module=='kasir' AND $act=='verified'){

  $id = $_GET['id'];

  $id_module = $_GET['id_module'];

  $notrans   = $_GET['notrans'];

  $kode      = $_GET['kode'];

  $prd      = $_GET['prd'];

  $outlet      = $_GET['outlet'];





  $istatus = '1';

   

   mysql_query("UPDATE kasir SET status   = '$istatus'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                             WHERE notrans = '$notrans'

                              AND prd = '$prd'

                              AND kode = '$kode'

                              and status != '4'

                              AND id_outlet = '$outlet'

                              ");    



   mysql_query("UPDATE kasir_detail SET status   = '$istatus'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                              WHERE notrans = '$notrans'

                              AND prd = '$prd'

                              AND kode = '$kode'

                              AND id_outlet = '$outlet'

                              and status != '4'

                              ");        





  header('location:../../main.php?module='.$module.'&id_module='.$id_module.'&act=save&notrans='.$notrans.'&prd='.$prd.'&kode='.$kode.'&outlet='.$outlet);  





   

 }



 elseif ($module=='kasir' AND $act=='reset'){

  $id = $_GET['id'];

  $id_module = $_GET['id_module'];

  $notrans   = $_GET['notrans'];

  $kode      = $_GET['kode'];

  $prd      = $_GET['prd'];

  $outlet      = $_GET['outlet'];





   mysql_query("UPDATE kasir SET status   = '0'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                               WHERE notrans = '$notrans'

                              AND prd = '$prd'

                              AND kode = '$kode' 

                              AND id_outlet = '$outlet' 

                              AND status in ('1')

                              ");       



   mysql_query("UPDATE kasir_detail SET status   = '0'

                                ,upddt   = '$datetime' 

                                ,updby   = '$userid' 

                              WHERE notrans = '$notrans'

                              AND prd = '$prd'

                              AND kode = '$kode'

                              AND id_outlet = '$outlet'

                              AND status  in ('1')

                              ");        



  header('location:../../main.php?module='.$module.'&id_module='.$id_module.'&act=save&notrans='.$notrans.'&prd='.$prd.'&kode='.$kode.'&outlet='.$outlet);           



   

 }









 

}

?>

