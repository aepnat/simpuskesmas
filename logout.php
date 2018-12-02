<?php
    session_start();

    include 'config/koneksi.php';

    // user_log
    user_log('Logout dari Aplikasi Puskemas');

    session_destroy();

    header('location:index.php');

?>

