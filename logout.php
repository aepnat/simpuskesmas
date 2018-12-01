<?php

    session_start();

    session_destroy();

    $userid = $_GET['userid'];
    $module = $_GET['module'];

    header('location:index.php?userid='.$userid.'&module='.$module.'');

// Apabila setelah logout langsung menuju halaman utama website, aktifkan baris di bawah ini:

//  header('location:http://www.alamatwebsite.com');

?>

