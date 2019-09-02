<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Penilaian</title>

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
  <!-- end: Css -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }


</script>
</head>

<body id="mimin" class="dashboard" onload="setInterval('displayServerTime()', 1000);">
      <!-- start: Header -->
        <?php $this->load->view('menu'); ?>
          <!-- end: Left Menu -->


          <!-- start: Content -->
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                    <form action="" autocomplete="on" method="POST">
                        <h3 class="animated fadeInLeft">
                          Form <span class="fa-angle-right fa"></span> Form Data Penilaian
                        </h3>
                    </div>
                    <div class="col-md-8">
                  <div class="col-md-12 panel">

          <div class="da-panel-content">

          <form class="da-form" method="post" id="da-ex-validate1">
          <div class="da-panel-widget">
            <h3 style="background: gray; color: white;">&nbsp;&nbsp;Petunjuk Pengisian Skor</h3>
            <blockquote>
              5 = Sangat Tinggi <br />
              4 = Tinggi<br />
              2 = Rendah <br />
              1 = Sangat Rendah <br />
            </blockquote>
          </div> 
          <hr>
          <div id="da-ex-val1-error" class="da-message error" style="display:none;"></div>

            <h3 style="background: gray; color: white;">&nbsp;&nbsp;Petunjuk Pengisian Bobot Skor</h3>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                       
                          <th>No</th>
                          <th>Nama Kriteria</th>
                          <th>Bobot</th>                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        if($result4->num_rows()>0)
                        {
                          foreach ($result4->result() as $row)
                          {
                          ?>
                          
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->nama_kriteria; ?></td>
                            <td><?php echo $row->bobot_kriteria; ?></td>
                            </td>
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>
                        </table>
                        
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
        <div class="col-md-10 top-20 padding-0">
        <div class="col-md-10">
        <div class="panel">
         <div class="panel-body">
          <div class="responsive-table">
          <table id="" class="" width="" cellspacing="0">
        <tr>  
            <td>No</td>
            <td>ID TIM</td>
            <td>Kriteria</td>
            <td>Skor</td>
            <td>Bobot Skor</td>
        </tr>
        <?php for($i=1;$i<=$banyak_data;$i++): ?>
        <tr>  <td><?= $i ?></td>
            <td><select class="form-group" name="data[<?= $i ?>][id_tim]" />
             <?php
                        if($result1->num_rows()>0)
                          {
                              foreach ($result1->result() as $row)
                              {
                          ?>
                          <option > 
                            <?php echo  htmlspecialchars ($row->id_tim); ?>
                                <?php }} ?>
                          </option>
            </select>
            </td>
            &nbsp;
      
            
            <td><select class="form-group" name="data[<?= $i ?>][id_kriteria]" />
             <?php
                        if($result3->num_rows()>0)
                          {
                              foreach ($result3->result() as $row)
                              {
                          ?>
                          <option value="<?php echo htmlspecialchars($row->id_kriteria); ?>">
                            <?php echo  htmlspecialchars ($row->nama_kriteria); ?>
                                <?php }} ?>
                          </option>
            </select>
            </td>
            &nbsp;
            
            <td><select class="form-group" name="data[<?= $i ?>][skor]" />
            &nbsp;
          <option>1</option>
          <option>2</option>
          <option>4</option>
          <option>5</option>
            </select>
            </td>
            &nbsp;

          <td><select class="form-group" name="data[<?= $i ?>][bobot_skor]" />
            &nbsp;
          <option>10</option>
          <option>15</option>
          <option>20</option>
          <option>25</option>
          <option>30</option>
          <option>40</option>
          <option>50</option>
          <option>60</option>
          <option>80</option>
          <option>100</option>
          <option>125</option>
            </select>

            </td>
            &nbsp;
          
        </tr>
        <?php endfor ?>
         </table>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
            <input class="submit btn btn-danger" type="submit" value="Simpan">
            &nbsp;&nbsp;
            <a href="<?php echo base_url('Penilaian/index') ?>">
            <input type="button" class="btn btn-warning" value="Batal">
         
            </a>
            <h1></h1>
      </form>



         
</div>
</div>

          <!-- end: content -->

<!-- start: Javascript -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

<!-- plugins -->
<script src="<?php echo base_url('assets/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js') ;?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/nouislider.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.validate.min.js'); ?> />"></script>


<!-- custom -->
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });

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
<!-- end: Javascript -->
</body>
</html>
