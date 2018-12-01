<?php
session_start();
include 'config/koneksi.php';

    if ($_SESSION['role']=='SA') {
        $sql = mysql_query("select * from modul where aktif='Y' and status_menu = 'M' order by urutan");

        $gjml = '1';
    } else {
        $sql = mysql_query("select distinct c.* from groupmodul b
                                                     inner join modul c
                                                     on b.id_modul = c.id_modul 
                                                     where b.id_groups = '$groups'  and c.aktif='Y' and status_menu='M'
                                                     order by c.urutan");

        $gsql = mysql_query("select * 
                                                      from modul a inner join groupmodul b
                                                      on a.id_modul = b.id_modul
                                                       where link = 'general_setting'
                                                       and b.id_groups = '$groups' 
                                                       ");
        $gjml = mysql_num_rows($gsql);
    }

                                while ($r = mysql_fetch_array($sql)) {
                                    if ($r[status_menu]=='M' and !empty($r[link])) {
                                        echo "<li><a href='$r[link]&id_module=$r[id_modul]'><i class='$r[icon]'></i> $r[nama_modul]</a>";
                                    } elseif ($r[status_menu]=='M' and empty($r[link])) {
                                        echo "<li><a href='#'><i class='$r[icon]'></i> $r[nama_modul] <span class='fa fa-chevron-down'></span></a>";
                                    }

                                    echo'<ul class="nav child_menu" style="display: none">';

                                    if ($_SESSION['role']=='SA') {
                                        $detil = mysql_query("select * from modul where aktif='Y' and status_menu = 'C' and parentid = '$r[id_modul]' order by urutan");
                                    } else {
                                        $detil = mysql_query("select distinct c.* 
                                                         from groupmodul b
                                                         inner join modul c
                                                         on b.id_modul = c.id_modul    
                                                         where b.id_groups = '$groups'
                                                         and c.aktif='Y'
                                                         and c.status_menu='C'
                                                         and c.parentid = '$r[id_modul]'
                                                         order by c.urutan");
                                    }
                                    while ($d = mysql_fetch_array($detil)) {
                                        if ($d[is_form]=='Y') {
                                            echo"<li><a href='modul/mod_$d[link]/form_$d[link].php?width=$d[f_width]&height=$d[f_height]&module=$d[link]&imodule=$imodule&id_module=$id&imenu=$imenu&isub=$isub&TB_iframe=true' title='$d[nama_modul]' class='thickbox' ><i class='$d[fa_icon]'></i>&nbsp&nbsp$d[nama_modul]</a></li>";
                                        } else {
                                            echo"<li><a href='$d[link]&id_module=$d[id_modul]'><i class='$d[fa_icon]'></i>&nbsp&nbsp$d[nama_modul]</a></li>";
                                        }
                                    }

                                    echo'</ul>';
                                }

?>

