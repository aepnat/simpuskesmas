<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else{
include "./../../config/koneksi.php";
include "./../../config/fungsi_thumb.php";

$imodule=$_POST[imodule];
$module=$_GET[module];
$act=$_GET[act];

$date     = date("d/m/Y");  
$idate    = date("Y-m-d");
$hour = time() - (1 * 1 * 60 * 60);
$datetime   = date("Y-m-d G:i:s", $hour);
$userid   = $_SESSION['userid'];


if ($module=='general_setting' AND $act=='input'){

  $id_module = $_POST['id_module'];

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

    
      if (empty($lokasi_file)){
          mysql_query("UPDATE general_setting SET company    = '$_POST[company]'
                          ,address   = '$_POST[address]'
                          ,city      = '$_POST[city]'
                          ,zip       = '$_POST[zip]'      
                          ,phone   = '$_POST[phone]' 
                          ,fax      = '$_POST[fax]' 
                          ,email   = '$_POST[email]' 
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_general_setting     = '$_POST[ID]'");
       } else {

           LogoImage($nama_file_unik);
           mysql_query("UPDATE general_setting SET company    = '$_POST[company]'
                          ,address   = '$_POST[address]'
                          ,city      = '$_POST[city]'
                          ,zip       = '$_POST[zip]'      
                          ,phone   = '$_POST[phone]' 
                          ,fax      = '$_POST[fax]' 
                          ,email   = '$_POST[email]' 
                         ,upddt     = '$datetime' 
                         ,pict        = '$nama_file_unik'
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'   
                       WHERE id_general_setting      = '$_POST[ID]'");

       }   

  $id = $_POST['ID'];       
                       
   header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module);          

}

}
?>
