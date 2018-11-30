<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<script>window.alert('Please login first.'); window.location=('../../index.php.php')</script>";
} else {
    include './../../config/koneksi.php';
    include './../../config/fungsi_thumb.php'; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>


  <script src="../../js/jquery.min.js"></script>


    <link href="../../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/fileinput.js" type="text/javascript"></script>
    
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


  <style>

        .iavatar {
         /* position:fixed;
          right: 20px;*/
          text-align: center;
        }  

        .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
          margin: 0;
          padding: 0;
          border: none;
          box-shadow: none;
          text-align: center;
        }
        .kv-avatar .file-input {
          display: table-cell;
          max-width: 220px;
        }


    </style>



</head>

<body style='background-color:#fff;'>
<?php

$modul = $_GET['module'];
    $imodule = $_GET['imodule'];
    $title = $_GET['title'];

    $role = $_SESSION['role'];

    $id_module = $_GET['id_module'];

    $id = 1; // isset($_GET['id_general_setting']) ? intval($_GET['id_general_setting']) : false;

    if ($id) {
        $query = mysql_query('SELECT * FROM general_setting WHERE id_general_setting = "'.$id.'"');
        if ($query && mysql_num_rows($query) == 1) {
            $data = mysql_fetch_object($query);
        } else {
            die('Data general_setting tidak ditemukan');
        }
    }

    if ($_GET['igroup']) {
        $group = $_GET['igroup'];
    } else {
        $group = $data->id_location;
    }

    if ($_GET['imenu']) {
        $imenu = $_GET['imenu'];
    } else {
        $imenu = $data->id_modul;
    }

    $pict = $data->pict; ?>


<div class="ix_panel">

       <!-- start form for validation -->
     <form action="<?php echo"../../modul/mod_$modul/aksi_$modul.php?module=$modul&act=input"; ?>" method="post" name="formData" enctype="multipart/form-data"  > 
     
       <div class="iavatar">    

            <div id="kv-avatar-errors" class="center-block" style="display:none"></div>
         
            <div class="kv-avatar center-block" style="width:200px">
              <input id="avatar" name='fupload' type="file" class="file-loading">
            </div>
       </div>     
       <br>

        <div class="col-md-3 col-sm-3 col-xs-3 form-group">
             <label class="control-label"  style="padding-top:8px;">Nama Perusahaan</label>
        </div>  
       <div class="col-md-9 col-sm-9 col-xs-9 form-group">
             <input type="text" name="company" value="<?php echo @$data->company?>" class="form-control" required>                                    
      </div>

      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
             <label class="control-label"  style="padding-top:8px;">Alamat</label>
        </div>  
       <div class="col-md-10 col-sm-10 col-xs-10 form-group">
             <textarea  class="form-control" name="address" style="height:60px;"><?php echo @$data->address?></textarea>                                  
      </div>

       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
        </div>  
       <div class="col-md-5 col-sm-5 col-xs-5 form-group">
            <input type="text" name="city" placeholder="Kota" value="<?php echo @$data->city?>" class="form-control" >                                      
      </div>
      <div class="col-md-5 col-sm-5 col-xs-5 form-group">
            <input type="text" name="zip" placeholder="Kode Pos" value="<?php echo @$data->zip?>" class="form-control" >                                      
      </div>


      <div class="col-md-2 col-sm-2 col-xs-2 form-group">
      <label class="control-label"  style="padding-top:8px;">Telepon & Fax </label>
        </div>  
       <div class="col-md-5 col-sm-5 col-xs-5 form-group">
            <input type="text" name="phone" placeholder="Telepon" value="<?php echo @$data->phone?>" class="form-control" >                                      
      </div>
      <div class="col-md-5 col-sm-5 col-xs-5 form-group">
            <input type="text" name="fax" placeholder="Fax" value="<?php echo @$data->fax?>" class="form-control" >                                      
      </div>
  
       <div class="col-md-2 col-sm-2 col-xs-2 form-group">
             <label class="control-label"  style="padding-top:8px;">Email</label>
        </div>  
       <div class="col-md-10 col-sm-10 col-xs-10 form-group">
             <input type="email" name="email" value="<?php echo @$data->email?>" required class="form-control" >                                    
      </div>

             <div class="form-group">
               <div class="col-md-12 col-sm-12 col-xs-12" style='margin-top:20px;'>
                  <input type="hidden" name="ID" value="<?php echo @$data->id_general_setting?>" />
                  <input type="hidden" name="id_module" value="<?php echo $id_module?>" /> 
                  <input type="hidden" name="imodule" value="<?php echo $imodule?>" /> 
                  <button type="button" onClick="parent.tb_remove()" class="btn btn-danger">Tutup</button>
                  <input type="submit" class="btn btn-primary" Value='Simpan'>
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

         <?php 
         if (empty($pict)) {
             $ipict = 'logo.png';
         } else {
             $ipict = $pict;
         } ?>

        <script>
          var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
              'onclick="alert(\'Call your custom code here.\')">' +
              '<i class="glyphicon glyphicon-tag"></i>' +
              '</button>'; 
          $("#avatar").fileinput({
              overwriteInitial: true,
              maxFileSize: 1500,
              showClose: false,
              showCaption: false,
              browseLabel: '',
              removeLabel: '',
              browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
              removeTitle: 'Cancel or reset changes',
              elErrorContainer: '#kv-avatar-errors',
              msgErrorClass: 'alert alert-block alert-danger',
              defaultPreviewContent: '<img src="../../images/logo/<?php echo $ipict; ?>" alt="Your Avatar" style="width:180px;">',
              layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
              allowedFileExtensions: ["jpg"]
          });
          </script>

</body>
</html>
<?php
}
?>