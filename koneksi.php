<?php

$server = 'localhost';
$username = 'root';
$password = 'root';
$database = 'ehotel';

// Koneksi dan memilih database di server
mysql_connect($server, $username, $password) or die('Koneksi gagal');
mysql_select_db($database) or die('Database tidak bisa dibuka');

function user_log($log)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $log = 'Logout dari Aplikasi Puskemas';
    $query = "INSERT INTO `user_log` (`id_user`,`ip`,`browser`,`log`) VALUES ('$id_user', '$ip', '$browser', '$log')";
    $sql = mysql_query($query);
}