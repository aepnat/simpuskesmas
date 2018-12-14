<?php

error_reporting(0);session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else {
    include './../../config/koneksi.php';
    include './../../config/fungsi_thumb.php';

    $imodule = $_POST[imodule];
    $module = $_GET[module];
    $act = $_GET['act'];

    $date = date('d/m/Y');
    $idate = date('Y-m-d');
    $hour = time() - (1 * 1 * 60 * 60);
    $datetime = date('Y-m-d G:i:s', $hour);
    $userid = $_SESSION['userid'];

    $SQL = 'SELECT* FROM periode ';
    $tampil = mysql_query($SQL);
    $p = mysql_fetch_array($tampil);

    $prd = $p['periode'];

    if ($module == 'pengaturan_sistem' and $act == 'ip') {
        $id_module = $_POST['id_module'];

        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $nama_file_unik = $acak.$nama_file;

        if (empty($lokasi_file)) {
            mysql_query("UPDATE informasi_perusahaan SET company    = '$_POST[company]'
                          ,address   = '$_POST[address]'
                          ,city      = '$_POST[city]'
                          ,zip       = '$_POST[zip]'      
                          ,phone   = '$_POST[phone]' 
                          ,fax      = '$_POST[fax]' 
                          ,email   = '$_POST[email]' 
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_informasi_perusahaan     = '$_POST[ID]'");
        } else {
            LogoImage($nama_file_unik);
            mysql_query("UPDATE informasi_perusahaan SET company    = '$_POST[company]'
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
                       WHERE id_informasi_perusahaan      = '$_POST[ID]'");
        }

        $id = $_POST['ID'];

        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    } elseif ($module == 'pengaturan_sistem' and $act == 'sa') {
        mysql_query("UPDATE pg_setoran_awal SET jenis    = '$_POST[jenis]'
                          ,nilai   = '$_POST[nilai]'
                          ,id_jenis_posting      = '$_POST[jenis_posting]'
                          ,rek_debet       = '$_POST[rek_debet]'      
                          ,rek_kredit  = '$_POST[rek_kredit]'  
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_pg_setoran_awal     = '$_POST[ID]'
                       AND prd = '$prd'
                       ");

        if ($_POST['u_tab'] == '1') {
            mysql_query("DELETE FROM pembukaan_tabungan 
                       WHERE id_pg_setoran_awal     = '$_POST[ID]'
                       AND status    = '2' 
                       ");

            mysql_query("UPDATE pembukaan_tabungan SET status    = '2' 
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_pg_setoran_awal     = '$_POST[ID]'
                       AND status = '0'
                       AND posting = '0'
                       ");

            mysql_query("INSERT INTO pembukaan_tabungan (
                          nik
                        , tanggal
                        , id_pg_setoran_awal
                        , nilai
                        , status
                        , posting
                        ,crtdt
                        ,crtby
                        ,upddt
                        ,updby   
                        )
                        select nik
                            , '$idate'  as tanggal
                            , '$_POST[ID]' as id
                            , '$_POST[nilai]' as nilai
                            , '0' as status
                             , '0' as posting
                             ,'$datetime'
                             ,'$userid'
                             ,'$datetime'
                             ,'$userid' 
                          from anggota
                          where tipe = 'A'
                          AND tab = '1'
                          ");
        }

        if ($_POST['u_tab'] == '2') {
            mysql_query("DELETE FROM pembukaan_tabungan 
                       WHERE id_pg_setoran_awal     = '$_POST[ID]'
                       AND status    = '2' 
                       ");

            mysql_query("UPDATE pembukaan_tabungan SET status    = '2' 
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_pg_setoran_awal     = '$_POST[ID]'
                       AND status = '0'
                       ");

            mysql_query("INSERT INTO pembukaan_tabungan (
                          nik
                        , tanggal
                        , id_pg_setoran_awal
                        , nilai
                        , status
                        , posting
                        ,crtdt
                        ,crtby
                        ,upddt
                        ,updby   
                        )
                        select nik
                            , '$idate'  as tanggal
                            , '$_POST[ID]' as id
                            , '$_POST[nilai]' as nilai
                            , '0' as status
                             , '0' as posting
                             ,'$datetime'
                             ,'$userid'
                             ,'$datetime'
                             ,'$userid' 
                          from anggota
                          where tipe = 'A'
                          AND tab = '1'
                          ");
        }

        $id = $_POST['ID'];
        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    } elseif ($module == 'pengaturan_sistem' and $act == 'pd') {
        mysql_query("UPDATE pg_penarikan_dana SET max_pencairan   = '$_POST[max_pencairan]'
                                      ,max_penarikan         = '$_POST[max_penarikan]'
                                      ,jeda_waktu      = '$_POST[jeda_waktu]'
                                      ,rek_debet       = '$_POST[rek_debet]'      
                                      ,rek_kredit  = '$_POST[rek_kredit]'  
                                      ,tgl_realisasi  = '$_POST[tgl_realisasi]'  
                                     ,upddt     = '$datetime' 
                                   ,updby     = '$userid'    
                       WHERE id_pg_penarikan_dana     = '$_POST[ID]'
                       AND prd = '$prd'
                       ");

        $id = $_POST['ID'];
        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    } elseif ($module == 'pengaturan_sistem' and $act == 'pm') {
        if ($_POST[stab] == 'tunai') {
            mysql_query("UPDATE pg_peminjaman_tunai SET min_tenor     = '$_POST[min_tenor_k]'
                                                ,max_tenor     = '$_POST[max_tenor_k]'
                                                ,max_pinjaman  = '$_POST[max_pinjaman_k]'      
                                                ,max_angsuran  = '$_POST[max_angsuran_k]'  
                                                ,bunga         = '$_POST[bunga_k]'  
                                                ,ipoint         = '$_POST[ipoint_k]'  
                                                ,batas_sisa_angsuran  = '$_POST[batas_sisa_angsuran_k]'  
                                                ,tgl_realisasi  = '$_POST[tgl_realisasi_k]'  
                                                ,rek_debet      = '$_POST[rek_debet_k]'  
                                                ,rek_kredit     = '$_POST[rek_kredit_k]'  
                                                ,rek_debet_pelunasan      = '$_POST[rek_debet_pelunasan_k]'  
                                                ,rek_kredit_pelunasan     = '$_POST[rek_kredit_pelunasan_k]'  
                                                ,rek_debet_bunga  = '$_POST[rek_debet_bunga_k]'
                                                ,rek_kredit_bunga  = '$_POST[rek_kredit_bunga_k]'
                                                ,rek_debet_ipoint  = '$_POST[rek_debet_ipoint_k]'
                                                ,rek_kredit_ipoint = '$_POST[rek_kredit_ipoint_k]'
                                                ,min_keanggotaan         = '$_POST[min_keanggotaan_k]'  
                                                ,upddt           = '$datetime' 
                                                ,updby           = '$userid'     
                                                  WHERE tipe     = 'K'
                                                  AND prd = '$prd'
                                                  ");

            mysql_query("UPDATE pg_peminjaman_tunai SET min_tenor     = '$_POST[min_tenor_s]'
                                                ,max_tenor     = '$_POST[max_tenor_s]'
                                                ,max_pinjaman  = '$_POST[max_pinjaman_s]'      
                                                ,max_angsuran  = '$_POST[max_angsuran_s]'  
                                                ,bunga         = '$_POST[bunga_s]'  
                                                ,ipoint         = '$_POST[ipoint_s]'  
                                                ,batas_sisa_angsuran  = '$_POST[batas_sisa_angsuran_s]'  
                                                ,tgl_realisasi  = '$_POST[tgl_realisasi_s]'  
                                                ,rek_debet      = '$_POST[rek_debet_k]'  
                                                ,rek_kredit     = '$_POST[rek_kredit_k]'  
                                                ,rek_debet_pelunasan      = '$_POST[rek_debet_pelunasan_k]'  
                                                ,rek_kredit_pelunasan     = '$_POST[rek_kredit_pelunasan_k]'  
                                                ,rek_debet_bunga  = '$_POST[rek_debet_bunga_k]'
                                                ,rek_kredit_bunga  = '$_POST[rek_kredit_bunga_k]'
                                                ,rek_debet_ipoint  = '$_POST[rek_debet_ipoint_k]'
                                                ,rek_kredit_ipoint = '$_POST[rek_kredit_ipoint_k]'
                                                ,min_keanggotaan         = '$_POST[min_keanggotaan_s]' 
                                                ,upddt           = '$datetime' 
                                                ,updby           = '$userid'     
                                                  WHERE tipe     = 'S'
                                                  AND prd = '$prd'
                                                  ");
        } else {
            mysql_query("UPDATE pg_peminjaman_barang SET min_tenor     = '$_POST[min_tenor_k]'
                                                ,max_tenor     = '$_POST[max_tenor_k]'
                                                ,max_pinjaman  = '$_POST[max_pinjaman_k]'      
                                                ,max_angsuran  = '$_POST[max_angsuran_k]'  
                                                ,bunga         = '$_POST[bunga_k]'  
                                                ,ipoint         = '$_POST[ipoint_k]'  
                                                ,batas_sisa_angsuran  = '$_POST[batas_sisa_angsuran_k]'  
                                                ,tgl_realisasi  = '$_POST[tgl_realisasi_k]'  
                                                ,rek_debet      = '$_POST[rek_debet_k]'  
                                                ,rek_kredit     = '$_POST[rek_kredit_k]'  
                                                ,rek_debet_pelunasan      = '$_POST[rek_debet_pelunasan_k]'  
                                                ,rek_kredit_pelunasan     = '$_POST[rek_kredit_pelunasan_k]'  
                                                ,rek_debet_bunga  = '$_POST[rek_debet_bunga_k]'
                                                ,rek_kredit_bunga  = '$_POST[rek_kredit_bunga_k]'
                                                ,rek_debet_ipoint  = '$_POST[rek_debet_ipoint_k]'
                                                ,rek_kredit_ipoint = '$_POST[rek_kredit_ipoint_k]'
                                                ,min_keanggotaan         = '$_POST[min_keanggotaan_k]' 
                                                ,upddt           = '$datetime' 
                                                ,updby           = '$userid'     
                                                  WHERE tipe     = 'K'
                                                  AND prd = '$prd'
                                                  ");

            mysql_query("UPDATE pg_peminjaman_barang SET min_tenor     = '$_POST[min_tenor_s]'
                                                ,max_tenor     = '$_POST[max_tenor_s]'
                                                ,max_pinjaman  = '$_POST[max_pinjaman_s]'      
                                                ,max_angsuran  = '$_POST[max_angsuran_s]'  
                                                ,bunga         = '$_POST[bunga_s]'  
                                                ,ipoint         = '$_POST[ipoint_s]'  
                                                ,batas_sisa_angsuran  = '$_POST[batas_sisa_angsuran_s]'  
                                                ,tgl_realisasi  = '$_POST[tgl_realisasi_s]'  
                                                ,rek_debet      = '$_POST[rek_debet_k]'  
                                                ,rek_kredit     = '$_POST[rek_kredit_k]'  
                                                ,rek_debet_pelunasan      = '$_POST[rek_debet_pelunasan_k]'  
                                                ,rek_kredit_pelunasan     = '$_POST[rek_kredit_pelunasan_k]'  
                                                ,rek_debet_bunga  = '$_POST[rek_debet_bunga_k]'
                                                ,rek_kredit_bunga  = '$_POST[rek_kredit_bunga_k]'
                                                ,rek_debet_ipoint  = '$_POST[rek_debet_ipoint_k]'
                                                ,rek_kredit_ipoint = '$_POST[rek_kredit_ipoint_k]'
                                                ,min_keanggotaan         = '$_POST[min_keanggotaan_s]' 
                                                ,upddt           = '$datetime' 
                                                ,updby           = '$userid'     
                                                  WHERE tipe     = 'S'
                                                  AND prd = '$prd'
                                                  ");
        }

        $stab = $_POST['stab'];

        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule.'&stab='.$stab);
    } elseif ($module == 'pengaturan_sistem' and $act == 'ln') {
        mysql_query("UPDATE pg_lainnya SET harga_saham    = '$_POST[harga_saham]'
                                     ,rek_shu        = '$_POST[rek_shu]'
                                     ,ftgl           = '$_POST[ftgl]'
                                     ,fbln           = '$_POST[fbln]'
                                     ,ltgl           = '$_POST[ltgl]'
                                     ,lbln           = '$_POST[lbln]'
                                     ,upddt     = '$datetime' 
                                     ,updby     = '$userid'    
                                   WHERE id_pg_lainnya     = '$_POST[ID]'
                                   AND prd = '$prd'
                       ");

        $id = $_POST['ID'];
        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    } elseif ($module == 'pengaturan_sistem' and $act == 'jr') {
        mysql_query("UPDATE pg_jurnal SET id_jenis_transaksi    = '$_POST[jenis_transaksi]'
                          ,id_modul      = '$_POST[modul]'
                         ,upddt     = '$datetime' 
                         ,updby     = '$userid'    
                       WHERE id_pg_jurnal     = '$_POST[ID]'
                       AND prd = '$prd'
                       ");

        $id = $_POST['ID'];
        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    } elseif ($module == 'pengaturan_sistem' and $act == 'pl') {
        mysql_query("UPDATE pg_plafon SET plafon    = '$_POST[plafon]'
                                     ,upddt     = '$datetime' 
                                     ,updby     = '$userid'    
                                   WHERE id_pg_plafon     = '$_POST[ID]'
                                   AND prd = '$prd'
                       ");

        $id = $_POST['ID'];
        header('location:form_'.$module.'.php?id='.$id.'&module='.$module.'&id_module='.$id_module.'&tab='.$act.'&imodule='.$imodule);
    }
}
