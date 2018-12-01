    <?php
    session_start();
    if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
        echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
    } else {
        include './../../config/koneksi.php'; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../../css/custom.css" rel="stylesheet">
    <link href="../../css/icheck/flat/green.css" rel="stylesheet">
    <!-- editor -->
    
    <link href="../../css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="../../css/editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="../../css/select/select2.min.css" rel="stylesheet">
    <!-- switchery -->
    <link rel="stylesheet" href="../../css/switchery/switchery.min.css" />

    <script src="../../js/jquery.min.js"></script>

</head>

<body style='background-color:#fff;'>
<?php

$modul = $_GET['module'];
        $title = $_GET['title'];
        $business_type = $_SESSION['business_type'];
        $role = $_SESSION['role'];

        $id_module = $_GET['id_module'];

        $id = isset($_GET['id_kunjungan_berobat']) ? intval($_GET['id_kunjungan_berobat']) : false;

        if ($id) {
            $query = mysql_query('SELECT * FROM kunjungan_berobat WHERE id_kunjungan_berobat = "'.$id.'"');
            if ($query && mysql_num_rows($query) == 1) {
                $data = mysql_fetch_object($query);
            } else {
                die('Data modul tidak ditemukan');
            }
        }

        if ($_GET['igroup']) {
            $group = $_GET['igroup'];
        } else {
            $group = $data->id_kunjungan_berobat;
        }

        if ($_GET['imenu']) {
            $imenu = $_GET['imenu'];
        } else {
            $imenu = $data->id_modul;
        }

        if ($data->tanggal) {
            $tanggal = $data->tanggal;
        } else {
            $tanggal = date('Y-m-d');
        } ?>

<div class="ix_panel">

       <!-- start form for validation -->
     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=close"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 


        <div class="form-group ">
               <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right" style='text-align: right;'>
                  <input type="hidden" name="ID" value="<?php echo @$data->id_kunjungan_berobat?>" />
                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                  <button type="submit"class="btn btn-danger">Tutup</button>
              </div>
        </div>  
     
        <div class="col-md-12 col-sm-12 col-xs-12">

           <div class="form-group col-md-4 col-sm-4 col-xs-4">
	               <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Tanggal</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <input type="date" name='tanggal' name='tanggal' disabled value="<?php echo @$tanggal?>" autofocus required="required" class="form-control col-md-7 col-xs-12">
              </div>
          </div>

       

           <div class="form-group col-md-8 col-sm-8 col-xs-8">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Pasien :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <select required name="pasien" class="form-control" disabled>
                 <option>--Pilih Pasien--</option>                
                    <?php
                        $query = mysql_query('SELECT * FROM pasien ORDER BY nama');
        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                $pasien = $row->ktp.'-'.$row->nama;

                echo '<option value="'.$row->id_pasien.'"';
                if ($row->id_pasien == @$data->id_pasien) {
                    echo ' selected';
                }
                echo '>'.$pasien.'</option>';
            }
        } ?>
                    </select>
              </div>

            </div>  

          </div>             
           
  
<!-- 
            <div class="form-group ">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Poliklinik :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <select name="poli" class="form-control" disabled>     
                 <option>--Pilih Poliklinik --</option>                          
                    <?php
                        $query = mysql_query('SELECT * FROM poli ORDER BY poli');
        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_poli.'"';
                if ($row->id_poli == @$data->id_poli) {
                    echo ' selected';
                }
                echo '>'.$row->poli.'</option>';
            }
        } ?>
                    </select>
              </div> -->

           <div class="col-md-12 col-sm-12 col-xs-12">    

            <div class="form-group col-md-6 col-sm-6 col-xs-6">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Keluhan :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <textarea disabled  class="form-control" name="keluhan" style="height:60px;"><?php echo @$data->keluhan?></textarea>       
            </div>
          </div>

          <div class="form-group col-md-6 col-sm-6 col-xs-6">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Diagnosa :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <textarea disabled class="form-control" name="diagnosa" style="height:60px;"><?php echo @$data->diagnosa?></textarea>       
            </div>
          </div>  

         </div>

            

       </form>
       <!-- end form for validations -->

        <div id="tablewrapper">

                          <div id="tableheader">

                               <table cellpadding="0" cellspacing="0" width='100%' border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                                  <thead>
                                      <tr>
                                          <th><h3 style='font-size:12px;'>Obat</h3></th>
                                          <th width='12%'><h3 style='font-size:12px;' >Qty</h3></th>
                                           <th width="30%" ><h3 style='font-size:12px;'>Deskripsi</h3></th>  
                                          <th class='nosort' width="15%" style='text-align:center;' >
                                          <h3 style='font-size:12px;'>Aksi</h3>
                                          </th>   
                                        </tr>   
                                 
                                      </thead>
                                  <tbody>

                                  <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                                                            
                           
                                    <input type="hidden" name="id_kunjungan_berobat" value="<?php echo @$id?>" />
                            
                                     <td>                                         
                                          <select name="obat" id="obat" class="form-control" required>
                                         <option value='0'></option>
                                            <?php
                                                $query = mysql_query('SELECT * FROM obat ORDER BY obat');
        if ($query && mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                echo '<option value="'.$row->id_obat.'"';
                if ($row->id_obat == @$r['id_obat']) {
                    echo ' selected';
                }
                echo '>'.$row->obat.'</option>';
            }
        } ?>
                                            </select> 
                            
                                     </td>

                                      <td>
                                          <input type="number" required="" name='qty' id='qty' min = '0' value="0" style='text-align:right;' class="form-control col-md-7 col-xs-12">    

                                       </td>

                                       <td>
                                          <input type="text" name='descr' id='descr' value="" class="form-control col-md-7 col-xs-12">                                              

                                       </td>

                                 
                                    <?php 
                                    echo" <td  style='text-align:right;'>"; ?>                               
                                    <button type="submit" <?php if (!$id) {
                                        echo 'disabled';
                                    } ?>  class="btn btn-success btn-sm">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                    <?php 
                                    echo'</td>';
        echo'</tr>';
        $no++; ?>

                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                                <?php
                                echo'</form>'; ?>

                                  <?php

                                    $SQL = "SELECT a.*,b.obat
                                             FROM kunjungan_berobat_detail  a LEFT JOIN obat b
                                            ON a.id_obat = b.id_obat  
                                            WHERE a.id_kunjungan_berobat = '$id' 
                                            order by a.id_kunjungan_berobat_detail";

        $tampil = mysql_query($SQL);

        $jml = mysql_num_rows($tampil);

        $no = 1;

        while ($r = mysql_fetch_array($tampil)) {
            $ID = $r['id_kunjungan_berobat'];

            echo'<tr>'; ?>

                                     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
                                                            
                                        <input type="hidden" name="id_kunjungan_berobat" value="<?php echo @$id?>" />

                                        <input type="hidden" name="ID" value="<?php echo @$ID?>" />
                            
                                     <td>
                                        <select name="obat" id="obat<?php echo $no; ?>" class="form-control" required>
                                         <option value='0'></option>
                                            <?php
                                                $query = mysql_query('SELECT * FROM obat ORDER BY obat');
            if ($query && mysql_num_rows($query) > 0) {
                while ($row = mysql_fetch_object($query)) {
                    echo '<option value="'.$row->id_obat.'"';
                    if ($row->id_obat == @$r['id_obat']) {
                        echo ' selected';
                    }
                    echo '>'.$row->obat.'</option>';
                }
            } ?>
                                            </select> 
                                       </td>

                                      <td>
                                          <input type="number" required name='qty' id='iqty<?php echo $no; ?>' min = '0' value="<?php if ($jml > 0) {
                echo number_format($r['qty'], 0, '.', '');
            } else {
                echo 1;
            } ?>" style='text-align:right;' class="form-control col-md-7 col-xs-12">  
                                          <input type="hidden" name='eqty' id='eiqty<?php echo $no; ?>' min = '0' value="<?php if ($jml > 0) {
                echo number_format($r['qty'], 0, '.', '');
            } else {
                echo 1;
            } ?>" style='text-align:right;' class="form-control col-md-7 col-xs-12">    

                                       </td>

                                       <td>
                                          <input type="text" name='descr' id='descr' value="<?=$r['descr']; ?>" class="form-control col-md-7 col-xs-12">                                              

                                       </td>
                                                                              

                                 
                                    <?php 
                                    echo" <td  style='text-align:right;'>"; ?>                               
                                    <button type="submit" <?php if (!$id) {
                                        echo 'disabled';
                                    } ?>  class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                    <?php 
                                    echo"<a href='../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=dhapus&id=$r[id_kunjungan_berobat_detail]&id_kunjungan_berobat=$r[id_kunjungan_berobat]&obat=$r[id_obat]&qty=$r[qty]&id_module=$id_module' onClick=\"return confirm('Hapus data ?')\" title='Hapus $nmmodule'><span class='btn btn-danger btn-sm '><i class='glyphicon glyphicon-trash'></i></span></a>";
            echo'</td>';
            echo'</tr>';

            $no++; ?>

                                  <input type="hidden" name="ID" value="<?php echo $r['id_kunjungan_berobat_detail']?>" />
                                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 

                                <?php
                                echo'</form>';
        } ?>  



                                  </tbody>

                                </table>      
                            </div>
                        </div>

</div>


</div>

<script src="../../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../../js/icheck/icheck.min.js"></script>
        <!-- tags -->
        <script src="../../js/tags/jquery.tagsinput.min.js"></script>
        <!-- switchery -->
        <script src="../../js/switchery/switchery.min.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="../../js/moment.min2.js"></script>
        <script type="text/javascript" src="../../js/datepicker/daterangepicker.js"></script>
        <!-- richtext editor -->
        <script src="../../js/editor/bootstrap-wysiwyg.js"></script>
        <script src="../../js/editor/external/jquery.hotkeys.js"></script>
        <script src="../../js/editor/external/google-code-prettify/prettify.js"></script>
        <!-- select2 -->
        <script src="../../js/select/select2.full.js"></script>
        <!-- form validation -->
        <script type="text/javascript" src="../../js/parsley/parsley.min.js"></script>
        <!-- textarea resize -->
        <script src="../../js/textarea/autosize.min.js"></script>
        <script>
            autosize($('.resizable_textarea'));
        </script>
        <!-- Autocomplete -->
        <script type="text/javascript" src="../../js/autocomplete/countries.js"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js"></script>
        <script type="text/javascript">
            $(function () {
                'use strict';
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // Initialize autocomplete with custom appendTo:
                $('#autocomplete-custom-append').autocomplete({
                    lookup: countriesArray,
                    appendTo: '#autocomplete-container'
                });
            });
        </script>
        <script src="../../js/custom.js"></script>


        <!-- select2 -->
        <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
        </script>
        <!-- /select2 -->
        <!-- input tags -->
        <script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
        </script>
        <!-- /input tags -->
        <!-- form validation -->
        <script type="text/javascript">
            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form .btn').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function () {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script>
        <!-- /form validation -->
        <!-- editor -->
        <script>
            $(document).ready(function () {
                $('.xcxc').click(function () {
                    $('#descr').val($('#editor').html());
                });
            });

            $(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                            return false;
                        })
                        .change(function () {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function () {
                            this.value = '';
                            $(this).change();
                        });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                            target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });
                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();
                        $('#voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('#voiceBtn').hide();
                    }
                };

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                };
                initToolbarBootstrapBindings();
                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });
                window.prettyPrint && prettyPrint();
            });
        </script>
        <!-- /editor -->

</body>
</html>
<?php
    }
?>