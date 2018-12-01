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
        if ($query && mysql_num_rows($query)==1) {
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
     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
     
          
           <div class="form-group">
	               <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Tanggal</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <input type="date" name='tanggal' name='tanggal' value="<?php echo @$tanggal?>" autofocus required="required" class="form-control col-md-7 col-xs-12">
              </div>
          </div>

       

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Pasien :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <select required name="pasien" class="form-control">
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

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style='padding-top:10px;'>Poliklinik :</label>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                 <select name="poli" class="form-control">     
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
              </div>

             <div class="form-group">
               <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style='margin-top:20px;'>
                  <input type="hidden" name="ID" value="<?php echo @$data->id_kunjungan_berobat?>" />
                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                  <button type="button" onClick="parent.tb_remove()" class="btn btn-danger">Cancel</button>
                  <input type="submit" class="btn btn-primary">
              </div>
             </div>  

       </form>
       <!-- end form for validations -->

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