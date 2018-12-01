<script language="javascript">
    function doprint() {     
     document.getElementById("printto").value = '2';    
     popup<?=$module?>(this, 'join');
     document.getElementById("myform").submit()
     }
</script>  

<script>

function showLokasi(str) {



  if (window.XMLHttpRequest) {

    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();

  } else { // code for IE6, IE5

    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

  xmlhttp.onreadystatechange=function() {

    if (xmlhttp.readyState==4 && xmlhttp.status==200) {

      document.getElementById("txtLokasi").innerHTML=xmlhttp.responseText;

    }

  }

  xmlhttp.open("GET","<?php echo"./modul/mod_$module/getlokasi.php?q="; ?>"+str,true);

  xmlhttp.send();

}

</script>

<script>

function getLokasi(str) {

  document.getElementById("lokasi").value= str;

}  

</script>


<?php
switch ($_GET[act]) {

default:

$fdate = date('Y-m-01');
$ldate = date('Y-m-d');

$prd = date('Y-m');

$userid = $_SESSION['userid'];
    ?>

 <div class="">
                   
        <div class="row">

          <form name="myform" id="myform" method="get" action="<?php echo"modul/mod_$module/print_$module.php"; ?>"  onSubmit="popup<?=$module?>(this, 'join')"> 
  
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                               <h2><?=$nmmodule; ?></h2>
                               <div class='pull-right'>
                                <Button type="submit" class="btn btn-primary">
                                 <span class="glyphicon glyphicon-print" style='color:#fff;'></span>
                                 </Button>
                                </div> 
                               <div class="clearfix"></div>
                        </div>
                <div class="x_content">
                <br><br>
                <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                   <label class="control-label">Periode </label>
                </div>  

                <div class="col-md-5 col-sm-5 col-xs-5 form-group"> 
                    <input type="date" name="fdate" value="<?=$fdate?>" class="form-control"  tabindex='1'>  

                </div> 


                <div class="col-md-5 col-sm-5 col-xs-5 form-group"> 
                    <input type="date" name="ldate" value="<?=$ldate?>" class="form-control"  tabindex='2'>  

                </div> 
                 

                 <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                   <label class="control-label">&nbsp </label>
                </div> 
                <div class="col-md-9 col-sm-9 col-xs-9 form-group"> 
                 <label class="control-label">
                    <?php
                    echo"<input type=radio name='printto' value='1' class='flat' checked>&nbsp Preview &nbsp</label>";
                    echo"<input type=radio name='printto' value='2' class='flat'>&nbsp Print</label> ";
                    ?>      
                 </label>             
                </div> 

             <?php

                $module = '?module='.$_GET['module'];
                $tampil = mysql_query("SELECT id_modul as id FROM modul WHERE link='".$module."'");
                $r = mysql_fetch_array($tampil);

                echo"<input type='hidden' name='report_id' id='report_id' value=".$r[id].'>';
                echo"<input type='hidden' name='module' value=".$_GET[module].'>';
            ?>
            </form>    
                   
                </div>
                <?php for ($i = 0; $i<=20; $i++) {
                ?>
                    <br />
                    <?php
            }
                    ?>
                 </div>
                   
                  
                 </div>
        </div>

    <?php
}
    ?>
    
