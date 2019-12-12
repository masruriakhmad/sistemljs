<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Benang</title>

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

      function validasi()
     {
//        menangkap variabel nip dari form, 
//        my form adalah id dari form, lihat baris 5
//        nip adalah id inputan, lihat baris 6
        var no_tr_benang=document.forms["myform"]["no_tr_benang"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (no_tr_benang==null || no_tr_benang=="")
          {
          alert("No transaksi tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (no_tr_barang.length>30)
          {
          alert("No transaksi maksimal 30 digit");
          return false;
          };

          var tgl=document.forms["myform"]["tgl"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (tgl==null || tgl=="")
          {
          alert("Tanggal tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (tgl.length>8)
          {
          alert("kesalahan tanggal");
          return false;
          };

          var kd_jenis =document.forms["myform"]["kd_jenis"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (kd_jenis==null || kd_jenis=="")
          {
          alert("Kode Gudang tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (kd_jenis.length>10)
          {
          alert("Kesalahan Kode Gudang");
          return false;
          };


          var kd_gudang=document.forms["myform"]["kd_gudang"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (kd_gudang==null || kd_gudang=="")
          {
          alert("Kode Vendor tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (kd_gudang.length>30)
          {
          alert("Nama Gudang tidak boleh kosong");
          return false;
          };

          var kd_user=document.forms["myform"]["kd_user"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (kd_user==null || kd_user=="")
          {
          alert("Kode User tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (kd_user.length>30)
          {
          alert("No transaksi maksimal 30 digit");
          return false;
          };

          var jumlah=document.forms["myform"]["jumlah"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (jumlah==null || jumlah=="")
          {
          alert("No transaksi tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (jumlah>30)
          {
          alert("No transaksi maksimal 30 digit");
          return false;
          };

          var jenis_benang=document.forms["myform"]["jenis_benang"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (jenis_benang==null || jenis_benang=="")
          {
          alert("Nama Benang tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript
        if (jenis_benang.length>30)
          {
          alert("No transaksi maksimal 30 digit");
          return false;
          };     
//        ...
     }

</script>
</head>

<body id="mimin" class="dashboard" onload="setInterval('displayServerTime()', 1000);">
      <!-- start: Header -->
      <?php $this->load->view('menu2'); ?>
          <!-- end: Left Menu -->
          <!-- start: Content -->
    <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                    <form action="<?php echo base_url('Customer/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                        <h3 class="animated fadeInLeft">
                          Form <span class="fa-angle-right fa"></span> Form Data Master Customer
                        </h3>
                    </div>
                  <div class="col-md-10">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading">
                      <h4>Tambah Data Master Customer</h4>
                    </div>
                    <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                         <form class="form-horizontal">

                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">NIK/NPWP</label>
                                  <input class="form-control" id="nik" type="text" name="nik" placeholder="Diisi " required>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>                           
                          
                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nama Customer</label>
                                  <input class="form-control" id="nm_customer" type="text" name="nm_customer" placeholder="Diisi " required>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>

                               <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Alamat</label>
                                  <textarea class="form-control" id="alamat" type="text" name="alamat" placeholder="Diisi "></textarea>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>
                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Kota/Kabupaten</label>
                                  <input class="form-control" id="kota" type="text" name="kota" placeholder="Diisi "></textarea>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>
                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">No. Telp</label>
                                  <input class="form-control" id="no_telp" type="text" name="no_telp" placeholder="Diisi "></textarea>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>

                            <div class="col-md-12">
                              <input class="submit btn btn-danger" type="submit" value="Simpan">
                           </div>
                  </form>
                </div>
              </div>
            </div>
          <!-- end: content -->
      </div>


<!-- start: Javascript -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<!-- plugins -->


<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.validate.min.js'); ?> />"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>


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
<!-- end: Javascript -->
</body>
</html>
