<?php

// Added user �k6035570_fajar� with password �5uperman�.
$server = 'localhost';
$username = 'root';
$password = 'root';
$database = 'ehotel';

//$server = "103.11.74.20";
//$username = "k7398289_elite";
//$password = "5uperman";
//$database = "k7398289_three";

// Koneksi dan memilih database di server
mysql_connect($server, $username, $password) or die('Koneksi gagal');
mysql_select_db($database) or die('Database tidak bisa dibuka');
