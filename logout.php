<?php
    session_start();

    include 'config/koneksi.php';

    $id_user = $_SESSION['userid'];

    // session_destroy();

    // user_log
    user_log('Logout dari Aplikasi Puskemas');
    header('location:index.php');

?>

