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
    if ($module == 'user' and $act == 'hapus') {
        $id = $_GET['id'];
        $id_module = $_GET['id_module'];

        mysql_query('DELETE FROM '.$module.' WHERE id_'.$module." = '$id'");

        header('location:../../main.php?module='.$module.'&id_module='.$id_module);
    }

    // Input group
    elseif ($module == 'user' and $act == 'input') {
        $id_module = $_POST['id_module'];

        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $nama_file_unik = $acak.$nama_file;

        $pass = $_POST[password];

        if ($_POST['r_input'] == 'Y') {
            $r_input = 'Y';
        } else {
            $r_input = 'N';
        }

        if ($_POST['r_edit'] == 'Y') {
            $r_edit = 'Y';
        } else {
            $r_edit = 'N';
        }

        if ($_POST['r_delete'] == 'Y') {
            $r_delete = 'Y';
        } else {
            $r_delete = 'N';
        }

        if ($_POST['r_admin'] == 'Y') {
            $r_admin = 'Y';
        } else {
            $r_admin = 'N';
        }

        if ($_POST['ID']) {
            if (empty($_POST['password'])) {
                if (empty($lokasi_file)) {
                    mysql_query("UPDATE user SET  username      = '$_POST[username]'
                       ,id_groups     = '$_POST[groups]'  
                       ,nik           = '$_POST[nik]'  
                       ,r_input     = '$r_input'  
                       ,r_edit      = '$r_edit'
                       ,r_delete      = '$r_delete'
                       ,r_admin      = '$r_admin'
                       ,upddt       = '$datetime' 
                       ,updby       = '$userid' 
                       ,aktif         = '$_POST[aktif]'
                     WHERE id_user        = '$_POST[ID]'");
                } else {
                    ProfileImage($nama_file_unik);
                    mysql_query("UPDATE user SET  username      = '$_POST[username]'
                       ,id_groups     = '$_POST[groups]'  
                       ,nik           = '$_POST[nik]'  
                       ,r_input     = '$r_input'  
                       ,r_edit      = '$r_edit'
                       ,r_delete      = '$r_delete'         
                       ,r_admin      = '$r_admin'              
                       ,pict        = '$nama_file_unik'
                       ,upddt       = '$datetime' 
                         ,updby       = '$userid' 
                         ,aktif         = '$_POST[aktif]'
                     WHERE id_user        = '$_POST[ID]'");
                }
            }
            // Apabila password diubah
            else {

        //$pass=md5($_POST[password]);
                $pass = $_POST[password];

                if (empty($lokasi_file)) {
                    mysql_query("UPDATE user SET password     = '$pass'
                         ,username    = '$_POST[username]'
                         ,id_groups   = '$_POST[groups]'  
                         ,nik           = '$_POST[nik]'  
                         ,r_input     = '$r_input'  
                         ,r_edit      = '$r_edit'
                         ,r_delete    = '$r_delete'
                         ,r_admin      = '$r_admin'
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid' 
                         ,aktif       = '$_POST[aktif]'      
                       WHERE id_user      = '$_POST[ID]'");
                } else {
                    ProfileImage($nama_file_unik);
                    mysql_query("UPDATE user SET password     = '$pass'
                         ,username    = '$_POST[username]'
                         ,id_groups   = '$_POST[groups]'  
                         ,nik           = '$_POST[nik]'  
                         ,r_input     = '$r_input'  
                         ,r_edit      = '$r_edit'
                         ,r_delete    = '$r_delete'
                         ,r_admin      = '$r_admin'
                          ,pict        = '$nama_file_unik'
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid' 
                         ,aktif       = '$_POST[aktif]'      
                       WHERE id_user      = '$_POST[ID]'");
                }
            }
        } else {
            if (!empty($lokasi_file)) {
                ProfileImage($nama_file_unik);

                mysql_query("INSERT INTO user (id_user
                        ,username
                        ,password      
                        ,nik
                      ,id_groups    
                      ,r_input
                      ,r_edit
                      ,r_delete
                      ,r_admin      
                      ,pict
                      ,crtdt
                      ,crtby
                      ,upddt
                      ,updby                                                      
                      ,aktif) 
                  VALUES('$_POST[id_user]'
                       ,'$_POST[username]'
                      ,'$pass'      
                       ,'$_POST[nik]'
                        ,'$_POST[groups]' 
                       ,'$_POST[r_input]'
                       ,'$_POST[r_edit]'
                       ,'$_POST[r_delete]'
                       ,'$_POST[r_admin]'
                       ,'$nama_file_unik'
                       ,'$datetime'
                       ,'$userid'
                       ,'$datetime'
                       ,'$userid'
                       ,'$_POST[aktif]')");
            } else {
                mysql_query("INSERT INTO user (id_user
                        ,username
                        ,password     
                        ,nik 
                      ,id_groups
                      ,r_input
                      ,r_edit
                      ,r_delete
                      ,r_admin   
                      ,pict
                      ,crtdt
                      ,crtby
                      ,upddt
                      ,updby                                                      
                      ,aktif) 
                  VALUES('$_POST[id_user]'
                       ,'$_POST[username]'
                      ,'$pass'      
                      ,'$_POST[nik]'
                       ,'$_POST[groups]'
                       ,'$_POST[r_input]'
                       ,'$_POST[r_edit]'
                       ,'$_POST[r_delete]'
                       ,'$_POST[r_admin]'
                       ,'male.png'
                       ,'$datetime'
                       ,'$userid'
                       ,'$datetime'
                       ,'$userid'
                       ,'$_POST[aktif]')");
            }
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
