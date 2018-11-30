<?
include "qrlib.php";

QRcode::png("U1160100004","image.png","L",5,5);

echo "<img src='image.png'>";


?>