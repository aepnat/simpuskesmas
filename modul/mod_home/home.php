
<?php
switch ($_GET[act]) {

    default:

     $gtampil = mysql_query("SELECT * FROM informasi_perusahaan where id_informasi_perusahaan = '1'");
        $g = mysql_fetch_array($gtampil);

    if ($g['pict']) {
        $pict = $g['pict'];
} else {
        $pict = '';
}

    ?>
<div class="col-md-12 col-sm-12 col-xs-12 center-block">
<div class="x_panel">
   <div class="x_title">
      <h3><span style="font-weight: bold;"><?=$g['company']?>	</span></h3>
      <h5><span><?php echo $g['address'].' '.$g['city'].' '.$g['state'].', '.$g['prov'].' '.$g['zip']; ?></span></h5>
      <h5><span>Telepon : <?=$g['phone']?> </span></h5>
   </div>
 

<img src="./images/logo/logo.png" style="padding:2px;" width='42%' class="center-block">
</div>
</div>    
<?php
}
?>