<?php
session_start();
if (empty($_SESSION['userid']) and empty($_SESSION['password'])) {
    echo "<script>window.alert('Login first.'); window.location=('index.php')</script>";
} else {
    date_default_timezone_set('Asia/Jakarta');
    include 'config/koneksi.php';
    include 'config/fungsi_indobulan.php';
    include 'config/browser_detection.php';

    $userid = $_SESSION['userid'];
    $username = $_SESSION['iusername'];
    $role = $_SESSION['role'];
    $groups = $_SESSION['groups'];
    $outlet = $_SESSION['outlet'];
    $df_outlet = $_SESSION['outlet'];

    $tipe_sales = $_SESSION['tipe_sales'];

    $r_input = $_SESSION['r_input'];
    $r_edit = $_SESSION['r_edit'];
    $r_delete = $_SESSION['r_delete'];
    $r_admin = $_SESSION['r_admin'];
    $r_department = $_SESSION['r_department'];

    $gsql = mysql_query("SELECT a.main_page,b.id_modul FROM groups a inner join modul b
                    on a.main_page = b.link
                    WHERE id_groups ='$groups'");

    $g = mysql_fetch_array($gsql);

    if ($g['main_page']) {
        $lmodule = $g['main_page'].'&id_module='.$g['id_modul'];
    } else {
        $lmodule = 'main.php?module=home&id_module=11';
    }

    $SQL = "SELECT * FROM informasi_perusahaan WHERE id_informasi_perusahaan = '1'";

    $tampil = mysql_query($SQL);

    $r = mysql_fetch_array($tampil);

    $company = $r[company];

    $logo_hotel = $r[pict];
    $module = trim($_GET[module]);

    $uSQL = "SELECT pict FROM user where id_user = '$userid' ";

    $utampil = mysql_query($uSQL);

    $u = mysql_fetch_array($utampil);

    $pict = $u['pict'];

    $id_module = $_GET['id_module'];

    $sql = mysql_query("select * from modul where id_modul = '$_GET[id_module]'");
    $r = mysql_fetch_array($sql);

    $imodule = $_GET['module'];
    $nmmodule = ucwords($r['nama_modul']);
    $id = $r['id_modul'];

    $fa_icon = $r['ficon'];

    $psql = mysql_query("select * from modul where id_modul = '$r[parentid]'");
    $p = mysql_fetch_array($psql);

    $p_imodule = $p['nama_modul'];
    $p_id = $p['id_modul'];
    $p_fa_icon = $p['fa_icon'];

    $kode = $_GET['kode'];

    if ($_GET['fdate']) {
        $fdate = $_GET['fdate'];
        $ifdate = $_GET['fdate'];
    } else {
        $hour = time() - (1 * 1 * 60 * 60);
        $fdate = date('Y-m-d', $hour);
        $ifdate = date('Y-m-d', $hour);
    }

    if ($_GET['ldate']) {
        $ldate = $_GET['ldate'];
        $ildate = $_GET['ldate'];
    } else {
        $hour = time() - (1 * 1 * 60 * 60) + (168 * 1 * 60 * 60);
        $ldate = date('Y-m-d', $hour);
        $ildate = date('Y-m-d', $hour);
    } ?>

<?php
    $SQL = "SELECT* FROM versi WHERE status = 'A' ";
    $tampil = mysql_query($SQL);
    $p = mysql_fetch_array($tampil);

    $app = $p['aplikasi'];

    $versi = $p['versi']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$app; ?></title>

    
    <!-- Bootstrap core CSS -->
   
    
    <link href="config/css/thickbox.css" rel="stylesheet" type="text/css" />
    <link href="config/css/tiny_table.css" rel="stylesheet" type="text/css" />

    <script language="javascript" src="config/js/jquery.js"></script>
    <script language="javascript" src="config/js/thickbox.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">


    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
             
<!--         <script>
        $(document).ready(function(){
            setInterval(function(){
                $("#screen").load('<?php echo $imod?>')
            }, 2000);
        });
        </script>  -->

        <script type="text/javascript">

        function number_format(number,num_decimal_places,dec_separator,thousand_separator)
        {
        var decimal = '00000';
        var negatif = (number.substring(0,1) == '-' ? '-' : '');
        number = Math.abs(parseFloat(number)).toString().split('.');
        if (number.length == 2)
        number[1] = (number[1] + decimal).substring(0,num_decimal_places);
        else
        number[1] = decimal.substring(0,num_decimal_places);
        number[0] = stringreverse(number[0]);
        var strdigit = '';
        for (i=0;i<number[0].length;i++)
        {
        if (i % 3 == 0 && i !=0) strdigit += thousand_separator;
        strdigit += number[0].charAt(i);
        }
        return negatif + stringreverse(strdigit) + (num_decimal_places > 0 ? dec_separator + number[1] : '');
        }

        function stringreverse(str)
        {
        var strlen = str.length;
        var strrev = '';
        for (i=strlen-1;i>=0;i--)
        {
        strrev += str.charAt(i);
        }
        return strrev;
        }

        //alert("Format 175500.235 ==>" + number_format('175500.23', 2,'.',',') );
        </script>



<?php
$mod = '?module='.$_GET['module'];
    $tampil = mysql_query("SELECT orientation FROM modul WHERE link='".$mod."'");
    $r = mysql_fetch_array($tampil);

    if ($r[orientation] == 'P') {
        ?>
        
<SCRIPT TYPE="text/javascript">
<!--
function popup<?php echo $module?>(myform, windowname)
{
if (! window.focus)return true;
window.open('', 'print_<?php echo $module?>.php', 'height=650,width=700,resizable=1,scrollbars=1,addressbars=0,directories=no,location=no');
myform.target='print_<?php echo $module?>.php';
return true;
}
//-->
</SCRIPT>

<?php
    } elseif ($r[orientation] == 'A') {
        ?>

<SCRIPT TYPE="text/javascript">
<!--
function popup<?php echo $module?>(myform, windowname)
{
if (! window.focus)return true;
window.open('', 'print_<?php echo $module?>.php', 'height=750,width=1020,resizable=1,scrollbars=1,addressbars=0,directories=no,location=no');
myform.target='print_<?php echo $module?>.php';
return true;
}
//-->
</SCRIPT>

<?php
    } else {
        ?>

<SCRIPT TYPE="text/javascript">
<!--
function popup<?php echo $module?>(myform, windowname)
{
if (! window.focus)return true;
window.open('', 'print_<?php echo $module?>.php', 'height=650,width=1100,resizable=1,scrollbars=1,addressbars=0,directories=no,location=no');
myform.target='print_<?php echo $module?>.php';
return true;
}
//-->
</SCRIPT>


<?php
    } ?>
  

</head>


<body class="nav-md">

<?php

$SQL = "SELECT* FROM versi WHERE status = 'A' ";
    $tampil = mysql_query($SQL);
    $p = mysql_fetch_array($tampil);

    $app = $p['aplikasi'];

    $versi = $p['versi']; ?>

<div id="dhtmltooltip"></div>
<script language="javascript" src="js/dhtml.tooltips.js"></script>


    <div class="container body">


        <div class="main_container ">

            <div class="col-md-3 left_col ">
                <div class="left_col scroll-view ">

                    <div class="navbar nav_title" style="border: 0;text-align:center;">
                       <!--  <a href="#" class="site_title">
                           <span style='font-size:14px' class="btn btn-success"><?php echo $app; ?></span>
                        </a> -->

                    </div>
                    <div class="clearfix"></div>
                      <!-- menu prile quick info -->
                   
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/profile/<?php echo $pict; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">                      
                            <span>Hallo,</span>                       
                            <h2><?php echo $username; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    
                    <br />

                    
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
                    

                        <div class="menu_section">
                          <h3>&nbsp </h3> 
                            <ul class="nav side-menu">

                           <?php include 'menu.php'; ?> 

                             </ul>           
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                </div>
            </div>
 -->
            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                
                <div class="nav navbar-nav navbar-left" style="padding-top:18px;font-size:14px;width:92%;">
                    <i class="fa fa-home"></i>
                    <a href="<?php echo $lmodule?>">Home</a>
                    &nbsp   
                    <i class="fa fa-angle-right"></i>
                    &nbsp
                    Halaman Utama

                    <span class='pull-right'>
                     <a href="logout.php" onclick="return confirm('keluar dari aplikasi ?')"><i class="fa fa-sign-out "></i> Keluar</a>
                    </span> 


                      </div>
                
                      
                      
 
                       <!--  <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/profile/<?php echo $pict; ?>" alt=""><?php echo $userid; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  <i class="fa fa-user pull-right"></i>&nbspProfile</a></li>
                                   
                                    <li><a href="logout.php" onclick="return confirm('Do you want to logout ?')"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>                            
                        </ul> -->              
                </div> 
            </div>

            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">

                 <?php include 'content.php'; ?>
                                
                <!-- footer content -->
          
                            
                <footer>
                    <div class="">
                    
                    <div class="col-md-9 col-sm-12 col-xs-12 form-group"></div>

                    <?php
                    $SQL = "SELECT* FROM versi WHERE status = 'A' ";
    $tampil = mysql_query($SQL);
    $p = mysql_fetch_array($tampil);

    $app = $p['aplikasi'];

    $versi = $p['versi']; ?>
                
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group" >
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>



        <script src="js/bootstrap.min.js"></script>


        <!-- chart js -->
        <script src="js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>

        <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment.min2.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

        <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->


        


    <script type="text/javascript" src="config/js/script.js"></script>
    <script type="text/javascript">
    var sorter = new TINY.table.sorter('sorter','table',{
        headclass:'head',
        ascclass:'asc',
        descclass:'desc',
        evenclass:'evenrow',
        oddclass:'oddrow',
        evenselclass:'evenselected',
        oddselclass:'oddselected',
        paginate:true,
        size:10,
        colddid:'columns',
        currentid:'currentpage',
        totalid:'totalpages',
        startingrecid:'startrecord',
        endingrecid:'endrecord',
        totalrecid:'totalrecords',
        hoverid:'selectedrow',
        pageddid:'pagedropdown',
        navid:'tablenav',
        <!--sortcolumn:1,-->
        sortdir:1,
        /*sum:[8],
        avg:[6,7,8,9],
        columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],*/
        init:true
    });
  </script>

</body>

</html>
<?php
}
?>