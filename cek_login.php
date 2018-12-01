<?php
include 'config/koneksi.php';
function anti_injection($data)
{
    $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));

    return $filter;
}

//$pass=md5($_POST[password]);

$userid = anti_injection($_POST[userid]);
$pass = anti_injection($_POST[password]);
$module = anti_injection($_POST[module]);

$login = mysql_query("SELECT a.*,b.id_tipe_sales 
                    FROM user a LEFT JOIN groups b
                    on a.id_groups = b.id_groups
                    WHERE a.id_user='$userid' AND a.password='$pass' and a.aktif='Y'");

$find = mysql_num_rows($login);
$r = mysql_fetch_array($login);

// Apabila userid dan password ditemukan
if ($find>0) {
    session_start();
    //session_register("userid");
    //  session_register("username");
    //  session_register("pass");
    //  session_register("role");
    //  session_register("dept");
    //  session_register("posisi");
    //  session_register("uclient");

    $_SESSION['userid'] = $r['id_user'];
    $_SESSION['username'] = $r['username'];
    $_SESSION['iusername'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['groups'] = $r['id_groups'];
    $_SESSION['tipe_sales'] = $r['id_tipe_sales'];
    $_SESSION['outlet'] = $r['id_outlet'];
    $_SESSION['role'] = $r['role'];
    $_SESSION['pict'] = $r['pict'];
    $_SESSION['r_input'] = $r['r_input'];
    $_SESSION['r_edit'] = $r['r_edit'];
    $_SESSION['r_delete'] = $r['r_delete'];
    $_SESSION['r_admin'] = $r['r_admin'];

    $gsql = mysql_query("SELECT main_page FROM groups WHERE id_groups ='$r[id_groups]'");
    $g = mysql_fetch_array($gsql);

    if ($g['main_page']) {
        $lmodule = $g['main_page'];
    } else {
        $lmodule = '?module='.$module;
    }

    $sql = mysql_query("SELECT * FROM modul WHERE link ='$lmodule'");

    $r = mysql_fetch_array($sql);

    if ($r['id_modul']) {
        $imodule = $r['link'];
        $id_module = $r['id_modul'];
        $kode = $r['kode'];
    } else {
        $imodule = '?home';
        $id_module = '54';
        $kode = '';
    }

    header('location:main.php'.$imodule.'&id_module='.$id_module.'&kode='.$kode.'');
} else {
    echo "<script>window.alert('User Id atau password tidak cocok.'); window.location=('index.php?userid=$userid&module=$module')</script>"; ?>

<?php
}
?>
