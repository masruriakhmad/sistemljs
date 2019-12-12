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
        var kd_user=document.forms["myform"]["kd_user"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (kd_user==null || kd_user=="")
          {
          alert("Nama Operator tidak boleh kosong !");
          return false;
          };
          
//        validasi nip harus berupa angka
//        dengan membandingkan dengan variabel number yang dibuat pada baris 21
        
          
//        validasi nip harus 18 digit pakai length javascript

        var gramasi=document.forms["myform"]["gramasi"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (gramasi==null || gramasi=="")
          {
          alert("Gramasi tidak boleh kosong !");
          return false;
          };

        if (!gramasi.match(numbers))
          {
          alert("Gramasi harus angka  !");
          return false;
          };
        
        var kg_grey =document.forms["myform"]["kg_grey"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (kg_grey==null || kg_grey=="")
          {
          alert("Kg Grey tidak boleh kosong !");
          return false;
          };

        if (!kg_grey.match(numbers))
          {
          alert("Kg Grey harus angka  !");
          return false;
          };

        var ket=document.forms["myform"]["ket"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9][A-Za-z]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (ket==null || ket=="")
          {
          alert("Keterangan tidak boleh kosong !");
          return false;
          };
//        ...
     }

      $(document).ready(function() {
  $('a[data-confirm]').click(function(ev) {
    var href = $(this).attr('href');
    if (!$('#dataConfirmModal').length) {
      $('body').append(
        '<div id="dataConfirmModal" class="modal col-sm-3" style="background: white;" role="dialog" aria-hidden=""><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h5 id="dataConfirmLabel">Konfirmasi</h5></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Tidak</button><a class="btn btn-primary" id="dataConfirmOK">Ya</a></div></div>');
    } 
    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
    $('#dataConfirmOK').attr('href', href);
    $('#dataConfirmModal').modal({show:true});
    return false;
  });
});

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
                    <div class="col-md-20">
                       <form action="<?php echo base_url('Penerimaan_grey/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                        <h3 class="animated fadeInLeft">
                          Form <span class="fa-angle-right fa"></span> Form Penerimaan Grey
                        </h3>
                    </div>
                  <div class="col-md-12">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading">
                      <h4>Tambah Data Penerimaan Grey</h4>
                    </div>
                      <div class="col-sm-12">
                                   <?php echo $this->session->flashdata('notif');?>
                                   <?php echo $this->session->flashdata('notifhapus');?>
                                   <?php echo $this->session->flashdata('notifedit');?>
                                   <?php echo $this->session->flashdata('notifgagal');?>
                                </div>
                    <div class="col-md-20 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                        
                         <form class="form-horizontal">  

                               <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nomor Mesin</label>
                                   <input class="form-control" id="kd_mesin" type="hidden" name="kd_mesin" value="<?php echo $edit['kd_mesin'];?>" /readonly>
                                  <input class="form-control" id="no_mesin" type="text" name="no_mesin" value="<?php echo $edit['no_mesin'];?>" /readonly>
                                  <input class="form-control" id="sku" type="hidden" name="sku" placeholder="Diisi " value="<?php echo $sku;?>" required>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">No Produksi</label>
                                  <input class="form-control" id="no_produksi" type="text" name="no_produksi" value="<?php echo $edit['no_produksi'];?>" /readonly>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nama Benang</label>
                                  <input class="form-control" id="" type="text" name="" value="<?php echo $edit['jenis_benang'];?>" /readonly>
                                  <input class="form-control" id="kd_jenis" type="hidden" name="kd_jenis" value="<?php echo $edit['kd_jenis'];?>" /readonly>
                                </div>
                              </div>
                              <br/><br/><br/>

                               <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Kg Tersedia</label>
                                  <input class="form-control" id="kg_akhir" type="text" name="kg_akhir" value="<?php echo number_format($edit['kg_akhir'],4);?>" /readonly>
                                  <input class="form-control" id="kd_mesin1" type="hidden" name="kd_mesin1" value="<?php echo $edit['kd_jenis'];?>" /readonly>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nama Gudang</label><br>
                                  <select  name="kd_gudang" id="kd_gudang" required>
                                    <option class="col-sm-3" value="G003">GUDANG GREY</option>
                                  <?php
                                  foreach ($result3->result() as $row) {
                                    echo "<option value='".$row->kd_gudang."'>".$row->nm_gudang."</option>";
                                  }    
                                ?>

                                <?php
                                 echo "</select>"; ?>

                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nama Kain</label><br>
                                  <select name="kd_kain" id="kd_kain" style="width: 200px;" required>  
                                    <option class="col-sm-3" value="<?php echo $this->session->flashdata('kd_kain');?>"><?php echo $this->session->flashdata('nm_kain');?></option>
                                  <?php
                                  foreach ($kain as $row) {
                                    echo "<option value='".$row->kd_kain."'>".$row->nm_kain."</option>";
                                  }    
                                ?>

                                <?php
                                 echo "</select>"; ?>

                                </div>
                              </div>
                              <br/><br/><br/>
                              
                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nomor WO</label><br>
                                  <select  name="no_wo" id="no_wo" style="width: 200px;" required>
                                    <option class="col-sm-3" value="<?php echo $this->session->flashdata('no_wo');?>"><?php echo $this->session->flashdata('no_wo');?></option>
                                  

                                <?php
                                 echo "</select>"; ?>

                                </div>
                              </div>
                              <br/><br/><br/>

                               

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Gramasi</label>
                                  <input class="form-control" id="gramasi" type="text" name="gramasi" placeholder="Diisi " value="<?php echo $this->session->flashdata('gramasi');?>" required>
                                </div>
                              </div>
                              <br/><br/><br/>

                               <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Operator (Harus Diisi)</label>
                                  <input class="form-control" id="operator" type="text" name="operator" placeholder="Diisi "value="<?php echo $this->session->flashdata('operator');?>" required>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Kg Grey</label>
                                  <input class="form-control" id="kg_grey" type="text" name="kg_grey" placeholder="Diisi " required>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Cacat Garis</label>
                                  <input class="form-control" id="bs_garis" type="text" name="bs_garis" placeholder="Diisi Nol Jika Normal" required>
                                </div>
                              </div>
                              <br/><br/><br/> 

                               <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Cacat Lubang</label>
                                  <input class="form-control" id="bs_lubang" type="text" name="bs_lubang" placeholder="Diisi Nol Jika Normal " required>
                                </div>
                              </div>
                              <br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Ket</label>
                                  <input class="form-control" id="ket" type="text" name="ket" placeholder="Diisi ">
                                </div>
                              </div>
                              <br/><br/><br/>

                              
                                <div class="col-sm-12">
                                  <label> 
                                  <B><h3> Nomor Transaksi Grey : </h3></B>
                                  <h3 style="color:red">
                                  <B><?php echo $result6 ."<br>" ;?></h3></B>
                                  <!--
                                  <?php echo $sku;?>
                                -->
                            
                                  <B><h3>Harap ditulis pada barang sebagai nama atau kode barang GREY !!!</h3><B></label>
                                </div>
                              
                              <br/>

                             <div class="col-sm-2">
                              <input class="submit btn btn-danger" type="submit" value="Simpan & Input Lagi">
                           </div>  
                  </form>
                  
                    <div class="col-sm-2">
                               <a href="<?php echo base_url('Produksi'); 
                                         
                               ?>">
                                <button class="btn btn-primary">
                                <div>
                                <span>Kembali Ke Produksi</span>
                                </div>
                                </button>
                                </a>
                           </div> 

                    <div class="col-sm-1">
                               <a href="<?php echo base_url('Penerimaan_grey/rekap/'.$edit['no_produksi']); 
                                         
                                          ?>">
                                <button class="btn btn-success">
                                <div>
                                <span>Lihat Rekap Input</span>
                                </div>
                                </button>
                                </a>
                           </div>
                     
                 
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
<!-- jquery untuk menampilkan dinamis combo box dengan jquery -->
<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script>
  <!--
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
-->
<!-- end: Javascript -->

<script type="text/javascript">
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_kain").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_wo").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_grey/getlistwo"); ?>", // Isi dengan url/path file php yang dituju
        data: {id : $("#kd_kain").val() }, // data yang akan dikirim ke file yang dituju
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
          $("#no_wo").html(response.listwo).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>
</body>
</html>
