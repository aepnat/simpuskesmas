 <script language="javascript">
    function doprint() {     
     document.getElementById("printto").value = '2';    
     popup<?=$module?>(this, 'join');
     document.getElementById("myform").submit()
     }
   </script>  
<?php
switch($_GET[act]){

default:  

$fdate   = date("Y-m-d");
$ldate   = date("Y-m-d");

  ?>

 <div class="">
                   
        <div class="row">

          <form name="myform" id="myform" method="get" action="<? echo"modul/mod_$module/print_$module.php";?>"  onSubmit="popup<?=$module?>(this, 'join')"> 
  
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                               <h2><?=$nmmodule;?></h2>
                               <div class='pull-right'>
                                <Button type="submit" class="btn btn-primary">
                                 <span class="glyphicon glyphicon-print" style='color:#fff;'></span>
                                 </Button>
                                </div> 
                               <div class="clearfix"></div>
                        </div>
                <div class="x_content">
                <br><br>

           <!--       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                   <label class="control-label">Abjad</label>
                </div>  

                <div class="col-md-9 col-sm-9 col-xs-9 form-group"> 
                     <select name="tipe" class="form-control">
                     <option value='%'>Semua</option>

                     <? for ($x = 'A'; $x <= 'Z'; $x++) { ?>
                        <option value= '<?=$x;?>'><?=$x;?></option>
                     <? } ?>

                     </select>   
                </div> -->

                 
                  <div class="col-md-2 col-sm-2 col-xs-2 form-group">
                   <label class="control-label">Tampilkan </label>
                </div> 
                <div class="col-md-9 col-sm-9 col-xs-9 form-group"> 
                    <?
                    echo"<input type=radio name='printto' value='1' class='flat' checked>&nbsp Preview &nbsp";
                    echo"<input type=radio name='printto' value='2' class='flat'>&nbsp Print ";
                    ?>                
                </div> 

             <?

             $module = '?module='.$_GET['module'];          
             $tampil=mysql_query("SELECT id_modul as id FROM modul WHERE link='".$module."'");                       
             $r=mysql_fetch_array($tampil);

             echo"<input type='hidden' name='report_id' id='report_id' value=".$r[id].">"; 
             echo"<input type='hidden' name='module' value=".$_GET[module].">";
            ?>
            </form>    
                   
                </div>
                <?for($i = 0; $i <= 20; $i++)  { 
                    ?>
                    <br />
                    <?
                    }
                    ?>
                 </div>
                   
                  
                 </div>
        </div>

    <?php
}
?>