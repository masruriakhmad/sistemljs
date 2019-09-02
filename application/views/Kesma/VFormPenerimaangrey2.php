<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Penerimaan Grey</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css'); ?>"  rel="stylesheet" type="text/css">
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/nouislider.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/select2.min.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/bootstrap-material-datetimepicker.css') ;?>"/>
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
   <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
  <!-- end: Css -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    *{
      margin: 0;
      padding: 0;
    }
    body {
      text-align:center;
      background-color:#61b3de;
      font-family:Arial, Helvetica, sans-serif;
      font-size:80%;
      color:#666;
    }
    .entry{
      margin-bottom:10px;
    }
    .wrap {
      background: #f3f8fb;
      width:730px;
      margin:30px auto;
      border: 4px dashed #61b3de;
      border-radius:4px;
      padding: 20px 5px;
    }
    h1 {
      font-family:Georgia, "Times New Roman", Times, serif;
      font-size:24px;
      color:#645348;
      font-style:italic;
      text-decoration:none;
      font-weight:100;
      padding: 10px;
    }
    .form-control{
      border-radius:0px;
    }
    
    .btn {
      border-radius:0px;
    }
  </style>
    <script src="js/jquery-1.8.3.js"></script>
  <script src="js/script.js"></script>

</head>

<body id="mimin" class="dashboard" onload="setInterval('displayServerTime()', 1000);">
      <!-- start: Header -->
      <?php $this->load->view('menu2'); ?>
          <!-- end: Left Menu -->
          <!-- start: Content -->
    <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-20">
                   <form action="<?php echo base_url('Produksi/coba'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
            <div class="form-group">
            <div class="col-sm-12">
            <div class="controls col-md-12"> 
              <input class="form-control" name="no_produksi" id="no_produksi" type="text" placeholder="Diisi">
            </div>
            </div>
            </div>




            <div class="form-group">
            <div class="col-sm-12">
            <div class="controls col-md-12"> 
       
            <div class="entry input-group">
            <div class="col-md-2">
            <label class="control-label">No. Roll</label>
            <input class="form-control" name="no_roll[]" id="no_roll" type="text" placeholder="Diisi">
            </div>
            
            <div class="col-md-2">
            <label class="control-label">Kg Grey</label>
            <input class="form-control" name="kg_grey[]" id="kg_grey" type="text" placeholder="Diisi">
            </div>
            <div class="col-md-2">
            <label class="control-label">Operator</label>
            <input class="form-control" name="operator[]" id="operator" type="text" placeholder="Diisi">
            </div>
            <div class="col-md-2">
            <label class="control-label">Keterangan</label>
            <input class="form-control" name="ket[]" id="ket" type="text" placeholder="Diisi">
            </div>
            <div class="col-md-1">
            <br/>
            <span class="input-group-btn">
              <button class="btn btn-success btn-add" type="button">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
          
          </div>
      
      </div>

                                </div>
                              </div>
                                      
                            
      
          <!--
         <div class="controls"> 
        <div class="form-group">
          <div class="entry input-group">
            <input class="form-control" name="kg_grey[]" type="text" placeholder="Entry..." required>
            <span class="input-group-btn">
              <button class="btn btn-success btn-add" type="button">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
         </div>        
      </div>
    -->
     
 
       
        

                            


                          

            
                             <div class="col-md-12">
                              <br/>
                              <input class="submit btn btn-danger" type="submit" value="Simpan">
                           </div>  

                            
                </form>
                </div>
              </div>
            </div>
          <!-- end: content -->
      </div>


<!-- start: Javascript -->
<script src="<?php echo base_url('view/assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/bootstrap.min.js')?>"></script>

<!-- plugins -->
<script src="<?php echo base_url('view/assets/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.nicescroll.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/nouislider.min.js') ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.validate.min.js'); ?> />"></script>


<!-- custom -->
<script type="text/javascript">
  $(document).ready(function(){

    $("#signupForm").validate({
      errorElement: "em",
      errorPlacement: function(error, element) {
        $(element.parent("div").addClass("form-animate-error"));
        error.appendTo(element.parent("div"));
      },
      success: function(label) {
        $(label.parent("div").removeClass("form-animate-error"));
      },
      rules: {
        validate_firstname: "required",
        validate_lastname: "required",
        validate_username: {
          required: true,
          minlength: 2
        },
        validate_password: {
          required: true,
          minlength: 5
        },
        validate_confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#validate_password"
        },
        validate_email: {
          required: true,
          email: true
        },
        validate_agree: "required"
      },
      messages: {
        validate_firstname: "Please enter your firstname",
        validate_lastname: "Please enter your lastname",
        validate_username: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 2 characters"
        },
        validate_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        validate_confirm_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        validate_email: "Please enter a valid email address",
        validate_agree: "Please accept our policy"
      }
    });

    // propose username by combining first- and lastname
    $("#username").focus(function() {
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      if (firstname && lastname && !this.value) {
        this.value = firstname + "." + lastname;
      }
    });


    $('.mask-date').mask('00/00/0000');
    $('.mask-time').mask('00:00:00');
    $('.mask-date_time').mask('00/00/0000 00:00:00');
    $('.mask-cep').mask('00000-000');
    $('.mask-phone').mask('0000-0000');
    $('.mask-phone_with_ddd').mask('(00) 0000-0000');
    $('.mask-phone_us').mask('(000) 000-0000');
    $('.mask-mixed').mask('AAA 000-S0S');
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    $('.mask-money2').mask("#.##0,00", {reverse: true});
    $('.mask-ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
      translation: {
        'Z': {
          pattern: /[0-9]/, optional: true
        }
      }
    });
    $('.mask-ip_address').mask('099.099.099.099');
    $('.mask-percent').mask('##0,00%', {reverse: true});
    $('.mask-clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.mask-placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.mask-fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/, 
          fallback: '/'
        }, 
        placeholder: "__/__/____"
      }
    });
    $('.mask-selectonfocus').mask("00/00/0000", {selectOnFocus: true});

    var options =  {onKeyPress: function(cep, e, field, options){
      var masks = ['00000-000', '0-00-00-00'];
      mask = (cep.length>7) ? masks[1] : masks[0];
      $('.mask-crazy_cep').mask(mask, options);
    }};

    $('.mask-crazy_cep').mask('00000-000', options);


    var options2 =  { 
      onComplete: function(cep) {
        alert('CEP Completed!:' + cep);
      },
      onKeyPress: function(cep, event, currentField, options){
        console.log('An key was pressed!:', cep, ' event: ', event, 
          'currentField: ', currentField, ' options: ', options);
      },
      onChange: function(cep){
        console.log('cep changed! ', cep);
      },
      onInvalid: function(val, e, f, invalid, options){
        var error = invalid[0];
        console.log ("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
      }
    };

    $('.mask-cep_with_callback').mask('00000-000', options2);

    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    };

    $('.mask-sp_celphones').mask(SPMaskBehavior, spOptions);



    var slider = document.getElementById('noui-slider');
    noUiSlider.create(slider, {
      start: [20, 80],
      connect: true,
      range: {
        'min': 0,
        'max': 100
      }
    });

    var slider = document.getElementById('noui-range');
    noUiSlider.create(slider, {
                        start: [ 20, 80 ], // Handle start position
                        step: 10, // Slider moves in increments of '10'
                        margin: 20, // Handles must be more than '20' apart
                        connect: true, // Display a colored bar between the handles
                        direction: 'rtl', // Put '0' at the bottom of the slider
                        orientation: 'vertical', // Orient the slider vertically
                        behaviour: 'tap-drag', // Move handle on tap, bar is draggable
                        range: { // Slider can select '0' to '100'
                        'min': 0,
                        'max': 100
                      },
                        pips: { // Show a scale with the slider
                          mode: 'steps',
                          density: 2
                        }
                      });



    $(".select2-A").select2({
      placeholder: "Select a state",
      allowClear: true
    });

    $(".select2-B").select2({
      tags: true
    });

    $("#range1").ionRangeSlider({
      type: "double",
      grid: true,
      min: -1000,
      max: 1000,
      from: -500,
      to: 500
    });

    $('.dateAnimate').bootstrapMaterialDatePicker({ weekStart : 0, time: false,animation:true});
    $('.date').bootstrapMaterialDatePicker({ weekStart : 0, time: false});
    $('.time').bootstrapMaterialDatePicker({ date: false,format:'HH:mm',animation:true});
    $('.datetime').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm',animation:true});
    $('.date-fr').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', lang : 'fr', weekStart : 1, cancelText : 'ANNULER'});
    $('.min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });


    $(".dial").knob({
      height:80
    });

    $('.dial1').trigger(
     'configure',
     {
       "min":10,
       "width":80,
       "max":80,
       "fgColor":"#FF6656",
       "skin":"tron"
     }
     );

    $('.dial2').trigger(
     'configure',
     {

       "width":80,
       "fgColor":"#FF6656",
       "skin":"tron",
       "cursor":true
     }
     );

    $('.dial3').trigger(
     'configure',
     {

       "width":80,
       "fgColor":"#27C24C",
     }
     );
  });
</script>
<!-- jquery untuk menampilkan dinamis combo box dengan jquery -->
<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script>
  
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_jenis").ready(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kd_kain").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Produksi/listKain"); ?>", // Isi dengan url/path file php yang dituju
        data: {kd_jenis : $("#kd_jenis").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#kd_kain").html(response.list_kain).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
  });
  </script>

 
 <script type="text/javascript">
   $(function()
    {
     $(document).on('click', '.btn-add', function(e)
     {
    e.preventDefault();

    var controlForm = $('.controls:first'),
     currentEntry = $(this).parents('.entry:first'),
     newEntry = $(currentEntry.clone()).appendTo(controlForm);

    newEntry.find('input').val('');
    controlForm.find('.entry:not(:last) .btn-add')
     .removeClass('btn-add').addClass('btn-remove')
     .removeClass('btn-success').addClass('btn-danger')
     .html('<span class="glyphicon glyphicon-minus"></span>');
     }).on('click', '.btn-remove', function(e)
     {
    $(this).parents('.entry:first').remove();

    e.preventDefault();
    return false;
     });
    }
   );

  </script>

</html>
