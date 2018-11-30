<?php

include '../../config/koneksi.php';

$q = intval($_GET['q']);

$tampil = mysql_query("SELECT term FROM supplier WHERE id_supplier = '".$q."'");

$r = mysql_fetch_array($tampil);

$term = $r['term'];

?>

<input type="text" name="term" id="term" value="<?php echo $term; ?>" class="form-control"  readonly>  

<?php
//mysqli_close($con);
?>