  
<style type="text/css">
.ftd{
	background-color:#FFFFFF;
	color:#000000;
	text-align:left;
	text-transform:capitalize;	
	font-size:12px;
	text-align: center;
	
}



.ltd{	
	background-color:#f5f3f4;
	text-align:left;
	text-transform:capitalize;	
	color:#000000;	
	text-align: center;

}

.iframe { 
	position:static;
	border:none;
	width: 100%; 
	height: 460px; 
	overflow: auto;
	margin-bottom:0px;	
	
}
</style>

<style>
#dhtmltooltip{
position: absolute;
text-align:left;
width: 200px;
padding: 6px;
background-color: #706c6f;
color: #E7E7E7;
font-weight:bold;
visibility: hidden;
z-index: 100;
}
</style>

<?php
switch ($_GET[act]) {

default:

if ($_GET['fdate']) {
    $fdate = $_GET['fdate'];
} else {
    $hour = time() - (1 * 1 * 60 * 60);
    $fdate = date('Y-m-d', $hour);
}

if ($_GET['ldate']) {
    $ldate = $_GET['ldate'];
} else {
    $hour = time() - (1 * 1 * 60 * 60) + (168 * 1 * 60 * 60);
    $ldate = date('Y-m-d', $hour);
}

$fdate1 = date('m/d/Y', strtotime($fdate));
$ldate1 = date('m/d/Y', strtotime($ldate));

    $fday = date('d', strtotime($fdate));
    $fmonth = date('m', strtotime($fdate));
    $fyear = date('Y', strtotime($fdate));

    $fmonthName = date('M', mktime(0, 0, 0, $fmonth, 10));

    $lday = mysql_query("SELECT substr(LAST_DAY('$fdate'),-2,2) as lastday ");
    $l = mysql_fetch_array($lday);
    $f_lastday = $l['lastday'];
    $f_jml = ($f_lastday - $fday) + 1;

    //$ldate = '2014-08-15';

    $lday = date('d', strtotime($ldate));
    $lmonth = date('m', strtotime($ldate));
    $lyear = date('Y', strtotime($ldate));
    $l_jml = $lday;

    $lmonthName = date('M', mktime(0, 0, 0, $lmonth, 10));

    $jml = ($lday - $fday) + 1;

if ($_GET['ldate']) {
    if ($lmonth == $fmonth and $lyear == $fyear) {
        $jcol = $jml;
    } else {
        $jcol = $f_jml + $l_jml;
    }
} else {
    $jcol = 8;
}

?>

 <div class="">
                   
                <div class="row">

                		<form method=get action='<?=$_SERVER[PHP_SELF]?>' name='myform'>
                		 <input type="hidden" name="module" value="<?=$module?>"/>
						 <input type="hidden" name="id_module"  value="<?=$id?>" /> 	
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Room View</h2>

                                    	 <div class="form-group">
							             <div class="col-md-6 col-sm-6 col-xs-12" >
							                 <select name="room_type" class="form-control1" required onChange="document.myform.submit();">
							                 	<option value="">--------- Room Type ---------</option>
							                    <?php
                                                  $query = mysql_query('SELECT * FROM room_type ORDER BY room_type');
                                                   if ($query && mysql_num_rows($query) > 0) {
                                                       while ($row = mysql_fetch_object($query)) {
                                                           echo '<option value="'.$row->id_room_type.'"';
                                                           if ($row->id_room_type == $_GET['room_type']) {
                                                               echo ' selected';
                                                           }
                                                           echo '>'.$row->room_type.'</option>';
                                                       }
                                                   }
                                                ?>
							                    </select>
							              </div>   

                                       <div class="pull-right" style='text-align:right'>
                                        		                                        		
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <input type="date" name='fdate' value="<?=$fdate?>" required="required" class="form-control-fdate" onChange="document.myform.submit();">
							                -
							                <input type="date" name='ldate' value="<?=$ldate?>" required="required" class="form-control-ldate" onChange="document.myform.submit();">
              								
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   <div id="tablewrapper">
							</form>	
							<br>
						<div class='iframe'>	
                        <table cellpadding="0" width='100%' cellspacing="0" border="0"  class="tinytable table-striped responsive-utilities jambo_table" >
                        <thead>
                           <tr>                            
		                            <th style='text-align:center;' width='17%' ><h3 style='font-size:12px;'>Room</h3></th>

		                        	<?php
                                    $col = (83 / $jcol);

                                    if ($lmonth == $fmonth and $lyear == $fyear) {
                                        for ($i = $fday; $i <= $lday; $i++) {
                                            if (strlen($i) == '1') {
                                                $tgl = '0'.$i;
                                            } else {
                                                $tgl = $i;
                                            }

                                            $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                            $DayName = date('D', strtotime($tanggal));

                                            $sSQL = "select sdate from special_day_detail where sdate in ('$tanggal')";
                                            $sday = mysql_query($sSQL);
                                            $s = mysql_fetch_array($sday);

                                            $nday = date('N', strtotime($tanggal));

                                            if ($s['sdate']) {
                                                $bg = '#eba51c';
                                            } elseif ($nday == '6' or $nday == '7') {
                                                $bg = '#eb1c41';
                                            } else {
                                                $bg = '';
                                            }

                                            echo"<th style='text-align:center;background-color:$bg' width='$col%'>
										<h3 style='font-size:12px;'>
										$tgl<BR>
										$fmonthName<BR>
										$DayName
										</h3>
										</th>";
                                        }
                                    } else {
                                        for ($i = $fday; $i <= $f_lastday; $i++) {
                                            if (strlen($i) == '1') {
                                                $tgl = '0'.$i;
                                            } else {
                                                $tgl = $i;
                                            }

                                            $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                            $DayName = date('D', strtotime($tanggal));

                                            $sSQL = "select sdate from special_day_detail where sdate in ('$tanggal')";
                                            $sday = mysql_query($sSQL);
                                            $s = mysql_fetch_array($sday);

                                            $nday = date('N', strtotime($tanggal));

                                            if ($s['sdate']) {
                                                $bg = '#eba51c';
                                            } elseif ($nday == '6' or $nday == '7') {
                                                $bg = '#eb1c41';
                                            } else {
                                                $bg = '';
                                            }

                                            echo"<th style='text-align:center;background-color:$bg' width='$col%'>
										<h3 style='font-size:12px;'>
										$tgl<BR>
										$fmonthName<BR>
										$DayName
										</h3>
										</th>";
                                        }

                                        for ($i = 1; $i <= $lday; $i++) {
                                            if (strlen($i) == '1') {
                                                $tgl = '0'.$i;
                                            } else {
                                                $tgl = $i;
                                            }

                                            $tanggal = $lyear.'-'.$lmonth.'-'.$tgl;

                                            $DayName = date('D', strtotime($tanggal));

                                            $sSQL = "select sdate from special_day_detail where sdate in ('$tanggal')";
                                            $sday = mysql_query($sSQL);
                                            $s = mysql_fetch_array($sday);

                                            $nday = date('N', strtotime($tanggal));

                                            if ($s['sdate']) {
                                                $bg = '#eba51c';
                                            } elseif ($nday == '6' or $nday == '7') {
                                                $bg = '#eb1c41';
                                            } else {
                                                $bg = '';
                                            }

                                            echo"<th style='text-align:center;background-color:$bg' width='$col%'>
										<h3 style='font-size:12px;'>
										$tgl<BR>
										$lmonthName<BR>
										$DayName
										</h3>
										</th>";
                                        }
                                    }

                                    ?>

		                        </tr> 

                        </thead>
                        <tbody>
                        
									
                            
                         <?php	
                                 $tSQL = 'SELECT * FROM room_type ';

                                 if ($_GET['room_type']) {
                                     $tSQL .= "WHERE id_room_type = '$_GET[room_type]'";
                                 }

                                 $tSQL .= 'ORDER BY room_type';

                                 $type = mysql_query($tSQL);

                                 while ($t = mysql_fetch_array($type)) {
                                     $id_room_type = $t['id_room_type'];

                                     echo'<tr>';
                                     echo"<td style='background-color: #1ABB9C;color: #E7E7E7;'>".$t['room_type'].'</td>';

                                     if ($lmonth == $fmonth and $lyear == $fyear) {
                                         for ($i = $fday; $i <= $lday; $i++) {
                                             if (strlen($i) == '1') {
                                                 $tgl = '0'.$i;
                                             } else {
                                                 $tgl = $i;
                                             }

                                             $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                             echo"<td style='background-color: #1ABB9C;color: #E7E7E7;'>
										</td>";
                                         }
                                     } else {
                                         for ($i = $fday; $i <= $f_lastday; $i++) {
                                             if (strlen($i) == '1') {
                                                 $tgl = '0'.$i;
                                             } else {
                                                 $tgl = $i;
                                             }

                                             $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                             $DayName = date('D', strtotime($tanggal));

                                             echo"<td style='background-color: #1ABB9C;color: #E7E7E7;'>
										</td>";
                                         }

                                         for ($i = 1; $i <= $lday; $i++) {
                                             if (strlen($i) == '1') {
                                                 $tgl = '0'.$i;
                                             } else {
                                                 $tgl = $i;
                                             }

                                             $tanggal = $lyear.'-'.$lmonth.'-'.$tgl;

                                             $DayName = date('D', strtotime($tanggal));

                                             echo"<td style='background-color: #1ABB9C;color: #E7E7E7;'>
										</td>";
                                         }
                                     }

                                     echo'</tr>';

                                     $rSQL = "SELECT * FROM room WHERE id_room_type = '$id_room_type' ORDER BY room_no";

                                     $room = mysql_query($rSQL);

                                     $no = 1;
                                     while ($r = mysql_fetch_array($room)) {
                                         $aktif = $r['aktif'];

                                         if (($no % 2) == 0) {
                                             $sty = 'ftd';
                                         } else {
                                             $sty = 'ltd';
                                         }

                                         $id_room = $r['id_room'];

                                         echo'<tr>';
                                         echo"<td style='padding-left:20px;text-align:left;' class=$sty>".$r['room_no'].'</td>';

                                         if ($lmonth == $fmonth and $lyear == $fyear) {
                                             for ($i = $fday; $i <= $lday; $i++) {
                                                 if (strlen($i) == '1') {
                                                     $tgl = '0'.$i;
                                                 } else {
                                                     $tgl = $i;
                                                 }

                                                 $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                                 echo"<td class=$sty style='padding:0;'>";

                                                 if ($aktif == 'T') {
                                                     echo"
												<i class='fa fa-warning' style='color: red;font-size:18px' onMouseover=\"ddrivetip('Out of Order')\"; onMouseout=\"hideddrivetip()\"></i>
												";
                                                 }

                                                 echo"<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
                                                 echo'<tr>';

                                                 $cSQL = "SELECT a.id_room,a.room_no,b.rdate,b.status,a.aktif,c.guest,c.initial,d.legend
													FROM room a left join room_reservation b
													 ON a.id_room = b.id_room
													 and b.status in ('0','1')
													 LEFT JOIN guest c
													 ON b.id_guest = c.id_guest
													 LEFT JOIN room_status d
													 ON b.id_room_status = d.id_room_status
													 WHERE a.id_room = '$id_room' 
													 AND b.rdate = '$tanggal'												
													 ORDER BY a.room_no,b.id_reservation";

                                                 $croom = mysql_query($cSQL);

                                                 $jml = mysql_num_rows($croom);

                                                 //$c=mysql_fetch_array($croom);
                                                 while ($c = mysql_fetch_array($croom)) {
                                                     $rdate = $c['rdate'];

                                                     $lSQL = "SELECT '$rdate' - INTERVAL 1 DAY as ldate, '$rdate' + INTERVAL 1 DAY as ndate ";
                                                     //echo $lSQL;
                                                     $ld = mysql_query($lSQL);

                                                     $l = mysql_fetch_array($ld);

                                                     $ldate = $l['ldate'];

                                                     $ndate = $l['ndate'];

                                                     $cSQL1 = "SELECT * from room_reservation 
													 WHERE id_room = '$id_room' 
													 AND rdate = '$ldate'";

                                                     $lroom = mysql_query($cSQL1);

                                                     if ($ldate) {
                                                         $ljml = mysql_num_rows($lroom);
                                                     } else {
                                                         $ljml = '0';
                                                     }

                                                     $cSQL2 = "SELECT * from room_reservation 
													 WHERE id_room = '$id_room' 
													 AND rdate = '$ndate'";

                                                     $nroom = mysql_query($cSQL2);

                                                     $njml = mysql_num_rows($nroom);

                                                     if ($ndate) {
                                                         $njml = mysql_num_rows($nroom);
                                                     } else {
                                                         $njml = '0';
                                                     }

                                                     $guest = $c['guest'];

                                                     $legend = $c['legend'];
                                                     $status = $c['status'];

                                                     if ($status == 0) {
                                                         $icolor = '#fff';
                                                     } else {
                                                         $icolor = '#fff';
                                                     }

                                                     if ($status == 0) {
                                                         $istatus = 'Reserved';
                                                     } elseif ($status == 1) {
                                                         $istatus = 'Check In';
                                                     } else {
                                                         $istatus = 'Check Out';
                                                     }

                                                     $iguest = trim($c['initial']).'. '.trim($c['guest']).' | '.$istatus;

                                                     if ($c['initial'] == 'Mr ') {
                                                         $icon = 'fa fa-male';
                                                     } else {
                                                         $icon = 'fa fa-female';
                                                     }

                                                     echo $ljml.'-'.$jml.'-'.$njml;

                                                     //if ($jml == '1') {

                                                     if ($ljml == '0' and $jml == '1' and $njml == '1') {
                                                         echo"<td width='50%'>
														</td>";
                                                     }

                                                     if ($guest) {
                                                         if ($guest) {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
														<a href='' onMouseover=\"ddrivetip('$iguest')\"; onMouseout=\"hideddrivetip()\" title=''><i class='$icon' style='color: $icolor;font-size:15px'></i></a>
														</td>";
                                                         } else {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
														</td>";
                                                         }
                                                     }
                                                 }

                                                 if ($ljml != '0' and $jml == '1') {
                                                     echo"<td width='50%'>
														</td>";
                                                 }

                                                 //}

                                                 echo'</tr>';
                                                 echo'</table>';
                                                 echo'</td>';
                                             }
                                         } else {
                                             for ($i = $fday; $i <= $f_lastday; $i++) {
                                                 if (strlen($i) == '1') {
                                                     $tgl = '0'.$i;
                                                 } else {
                                                     $tgl = $i;
                                                 }

                                                 $tanggal = $fyear.'-'.$fmonth.'-'.$tgl;

                                                 echo"<td class=$sty style='padding:0;'>";

                                                 if ($aktif == 'T') {
                                                     echo"
												<i class='fa fa-warning' style='color: red;font-size:18px' onMouseover=\"ddrivetip('Out of Order')\"; onMouseout=\"hideddrivetip()\"></i>
												";
                                                 }

                                                 echo"<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
                                                 echo'<tr>';

                                                 $cSQL = "SELECT a.id_room,a.room_no,b.rdate,b.status,a.aktif,c.guest,c.initial,d.legend
													FROM room a left join room_reservation b
													 ON a.id_room = b.id_room
													 and b.status in ('0','1')
													 LEFT JOIN guest c
													 ON b.id_guest = c.id_guest
													 LEFT JOIN room_status d
													 ON b.id_room_status = d.id_room_status
													 WHERE a.id_room = '$id_room' 
													 AND b.rdate = '$tanggal'												
													 ORDER BY a.room_no";

                                                 $croom = mysql_query($cSQL);

                                                 $jml = mysql_num_rows($croom);

                                                 //$c=mysql_fetch_array($croom);
                                                 while ($c = mysql_fetch_array($croom)) {
                                                     $guest = $c['guest'];

                                                     $legend = $c['legend'];
                                                     $status = $c['status'];

                                                     if ($status == 0) {
                                                         $icolor = '#fff';
                                                     } else {
                                                         $icolor = '#fff';
                                                     }

                                                     if ($status == 0) {
                                                         $istatus = 'Reserved';
                                                     } elseif ($status == 1) {
                                                         $istatus = 'Check In';
                                                     } else {
                                                         $istatus = 'Check Out';
                                                     }

                                                     $iguest = trim($c['initial']).'. '.trim($c['guest']).' | '.$istatus;

                                                     if ($c['initial'] == 'Mr ') {
                                                         $icon = 'fa fa-male';
                                                     } else {
                                                         $icon = 'fa fa-female';
                                                     }

                                                     if ($guest) {
                                                         if ($guest) {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
												<a href='' onMouseover=\"ddrivetip('$iguest')\"; onMouseout=\"hideddrivetip()\" title=''><i class='$icon' style='color: $icolor;font-size:15px'></i></a>
												</td>";
                                                         } else {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
												</td>";
                                                         }
                                                     }
                                                 }

                                                 if ($jml == '1') {
                                                     echo"<td width='50%'>
												</td>";
                                                 }

                                                 echo'</tr>';
                                                 echo'</table>';
                                                 echo'</td>';
                                             }

                                             for ($i = 1; $i <= $lday; $i++) {
                                                 if (strlen($i) == '1') {
                                                     $tgl = '0'.$i;
                                                 } else {
                                                     $tgl = $i;
                                                 }

                                                 $tanggal = $lyear.'-'.$lmonth.'-'.$tgl;

                                                 echo"<td class=$sty style='padding:0;'>";

                                                 if ($aktif == 'T') {
                                                     echo"
												<i class='fa fa-warning' style='color: red;font-size:18px' onMouseover=\"ddrivetip('Out of Order')\"; onMouseout=\"hideddrivetip()\"></i>
												";
                                                 }

                                                 echo"<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
                                                 echo'<tr>';

                                                 $cSQL = "SELECT a.id_room,a.room_no,b.rdate,b.status,a.aktif,c.guest,c.initial,d.legend
													FROM room a left join room_reservation b
													 ON a.id_room = b.id_room
													 and b.status in ('0','1')
													 LEFT JOIN guest c
													 ON b.id_guest = c.id_guest
													 LEFT JOIN room_status d
													 ON b.id_room_status = d.id_room_status
													 WHERE a.id_room = '$id_room' 
													 AND b.rdate = '$tanggal'												
													 ORDER BY a.room_no";

                                                 $croom = mysql_query($cSQL);

                                                 $jml = mysql_num_rows($croom);

                                                 //$c=mysql_fetch_array($croom);
                                                 while ($c = mysql_fetch_array($croom)) {
                                                     $guest = $c['guest'];

                                                     $legend = $c['legend'];
                                                     $status = $c['status'];

                                                     if ($status == 0) {
                                                         $icolor = '#fff';
                                                     } else {
                                                         $icolor = '#fff';
                                                     }

                                                     if ($status == 0) {
                                                         $istatus = 'Reserved';
                                                     } elseif ($status == 1) {
                                                         $istatus = 'Check In';
                                                     } else {
                                                         $istatus = 'Check Out';
                                                     }

                                                     $iguest = trim($c['initial']).'. '.trim($c['guest']).' | '.$istatus;

                                                     if ($c['initial'] == 'Mr ') {
                                                         $icon = 'fa fa-male';
                                                     } else {
                                                         $icon = 'fa fa-female';
                                                     }

                                                     if ($guest) {
                                                         if ($guest) {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
												<a href='' onMouseover=\"ddrivetip('$iguest')\"; onMouseout=\"hideddrivetip()\" title=''><i class='$icon' style='color: $icolor;font-size:15px'></i></a>
												</td>";
                                                         } else {
                                                             echo"<td style='background-color:$legend;'  width='50%'>
												</td>";
                                                         }
                                                     }
                                                 }

                                                 if ($jml == '1') {
                                                     echo"<td width='50%'>
												</td>";
                                                 }

                                                 echo'</tr>';
                                                 echo'</table>';
                                                 echo'</td>';
                                             }
                                         }
                                         echo'</tr>';

                                         $no++;
                                     }
                                 }
                                ?>

					                         </tbody>
					                    </table>
					                  </div>  
					                  </div>
					                </div>
                                </div>

                               <div class="col-md-7  col-xs-7" style='text-align:right;padding-top:10px;'> 
									<table style='text-align:right;'>
										<tr>
										<td style='padding-right:3px;'>Room Status : </td>	
										<?php
                                             $SQL = "SELECT * FROM room_status where aktif ='Y' ORDER BY id_room_status";
                                             $tampil = mysql_query($SQL);

                                             while ($r = mysql_fetch_array($tampil)) {
                                                 echo"<td style='width:20px;background-color:".$r['legend'].";'>&nbsp</td>";
                                                 echo"<td style='padding-left:3px;'>".$r['room_status'].'&nbsp</td>';
                                             }

                                        ?>
										</tr>
									</table>
								</div>

								<div class="col-md-5  col-xs-5" class='pull-right' style='text-align:right;padding-top:10px;'> 
									<table style='text-align:right;'>
										<tr>
										<td style='padding-right:3px;'>Day Status : </td>	
										<?php

                                             echo"<td style='width:20px;background-color:#eba51c;'>&nbsp</td>";
                                             echo"<td style='padding-left:3px;'>Spesial Day&nbsp</td>";
                                             echo"<td style='width:20px;background-color:#eb1c41;'>&nbsp</td>";
                                             echo"<td style='padding-left:3px;'>Weekend&nbsp</td>";
                                             echo"<td style='width:20px;background-color:#2A3F54;;'>&nbsp</td>";
                                             echo"<td style='padding-left:3px;'>Weekday&nbsp</td>";

                                        ?>
										</tr>
									</table>
								</div>
							  		
                            </div>
                        </div>
					</div>
               </div>
        </div>

    <?php
}
?>