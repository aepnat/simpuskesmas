<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$database = 'db_puskesmas';

mysql_connect($server, $username, $password) or die('Koneksi gagal');
mysql_select_db($database) or die('Database tidak bisa dibuka');

if (! function_exists('user_log')) {
    function user_log($log)
    {
        $id_user = $_SESSION['userid'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $log = 'Logout dari Aplikasi Puskemas';
        $query = "INSERT INTO `user_log` (`id_user`,`ip`,`browser`,`log`) VALUES ('$id_user', '$ip', '$browser', '$log')";
        $sql = mysql_query($query);
    }   
}