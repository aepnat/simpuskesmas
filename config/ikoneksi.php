<?php

//$con = mysqli_connect('103.11.74.20','k7398289_elite','5uperman','k7398289_three');
$con = mysqli_connect('localhost', 'root', '', 'koperasi');
if (!$con) {
    die('Could not connect: '.mysqli_error($con));
}

mysqli_select_db($con, 'koperasi');

?>
