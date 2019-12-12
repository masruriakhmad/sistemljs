<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>By Pass Penerimaan Grey</title>

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
                        <h3 class="animated fadeInLeft">
                          Form <span class="fa-angle-right fa"></span> By Pass Penerimaan Grey
                        </h3>
                    </div>
                  <div class="col-md-12">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading">
                      <h4>By Pass Penerimaan Grey</h4>
                    </div>
                      <div class="col-sm-12">
                                   <?php echo $this->session->flashdata('notif');?>
                                   <?php echo $this->session->flashdata('notifhapus');?>
                                   <?php echo $this->session->flashdata('notifedit');?>
                                   <?php echo $this->session->flashdata('notifgagal');?>
                                </div>
                    <div class="col-md-20 panel-body" style="padding-bottom:30px;">

                       <form action="<?php echo base_url('Penerimaan_grey/createNewProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                      <div class="col-md-12">  

                               <div class="form-group">
                                  <label class="control-label">Mesin</label><br>
                                   <select  name="kd_mesin" id="kd_mesin" required>
                                    <option class="col-sm-6" value="">Pilih</option>
                                  <?php
                                  foreach ($mesin->result() as $row) {
                                    echo "<option value='".$row->kd_mesin."'>".$row->no_mesin."</option>";
                                  }    
                                ?>

                                <?php
                                 echo "</select>"; ?>
                                </div>

                               <div class="form-group">
                                  <label class="control-label">Nama Kain</label><br>
                                  <select name="kd_kain" id="kd_kain" style="width: 200px;" required>  
                                    <option class="col-sm-6" value="">Pilih</option>
                                  <?php
                                  foreach ($kain->result() as $row) {
                                    echo "<option value='".$row->kd_kain."'>".$row->nm_kain."</option>";
                                  }    
                                ?>

                                <?php
                                 echo "</select>"; ?>

                                </div>

                              <div class="form-group">
                                  <label class="control-label">Gramasi</label>
                                  <input class="form-control" id="gramasi" type="text" name="gramasi" placeholder="Diisi " value="" required>
                              </div>

                              <div class="form-group">
                                  <label class="control-label">Keterangan</label>
                                  <input class="form-control" id="ket" type="text" name="ket" placeholder="Diisi " value="">
                                </div>

                                 <div class="form-group">
                                  <label class="control-label">No Tr Greige Depan</label><br><i>PRG1500 sudah digunakan untuk bypass Penerimaan Kain Jadi</i><br/>
                                  <select name="no_tr_grey1" id="no_tr_grey1" style="width: 200px;" required>  
                                    <option class="col-sm-6" value="">Pilih</option>
                                    <option class="col-sm-6" value="PRG1700">PRG1700</option>
                                    <option class="col-sm-6" value="PRG1600">PRG1600</option>
                                    <option class="col-sm-6" value="PRG1400">PRG1400</option>
                                    <option class="col-sm-6" value="PRG1300">PRG1300</option>
                                    <option class="col-sm-6" value="PRG1200">PRG1200</option>
                                    <option class="col-sm-6" value="PRG1100">PRG1100</option>
                                    <option class="col-sm-6" value="PRG1000">PRG1000</option>
                                    <option class="col-sm-6" value="PRG0900">PRG0900</option>
                                    <option class="col-sm-6" value="PRG0800">PRG0800</option>
                                    <option class="col-sm-6" value="PRG0700">PRG0700</option>
                                    <option class="col-sm-6" value="PRG0600">PRG0600</option>
                                    <option class="col-sm-6" value="PRG0500">PRG0500</option>
                                    <option class="col-sm-6" value="PRG0400">PRG0400</option>
                                    <option class="col-sm-6" value="PRG0300">PRG0300</option>
                                    <option class="col-sm-6" value="PRG0200">PRG0200</option>
                                    <option class="col-sm-6" value="PRG0100">PRG0100</option>
                                    <option class="col-sm-6" value="PRG0000">PRG0000</option>
                                  </select>
                                </div>

                               <div class="form-group">
                                
                              <input id="idf" value="1" type="hidden" />
                              <button type="button" class="btn btn-xs btn-warning" onclick="tambahItem(); return false;" >Tambah Item</button><br/><br/>
                              <div id="divHobi">
                                
                              </div>
                                </div>
                              
                              <br/><br/>

                             <div class="col-sm-2">
                              <input class="submit btn btn-danger" type="submit" value="Simpan">
                           </div>  

                           <div class="col-sm-2">
                               <a href="<?php echo base_url('Penerimaan_grey'); 
                                         
                               ?>">
                                <button class="btn btn-primary">
                                <div>
                                <span>Kembali</span>
                                </div>
                                </button>
                                </a>
                           </div> 
                 
                </div>
              </form>
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
<!-- jquery untuk menampilkan dinamis combo box dengan jquery -->
<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/number-validation.js')?>"></script>
<script language="javascript">
   function tambahItem() {
     var idf = document.getElementById("idf").value;
     var stre;
     var x=1;
     stre="<p id='srow" + idf + "'>" + idf + "&nbsp<input type='text' name='no_tr_grey2[]' placeholder='no tr grey 4 digit belakang' onkeypress='return isNumberKey(event)' autofocus required autocomplete='off'/>&nbsp<input type='text' name='kg_grey[]' placeholder='Kg' onkeypress='return isNumberKey(event)' autofocus required autocomplete='off'/> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
     $("#divHobi").append(stre);
     idf = (idf-1) + 2;
     
     document.getElementById("idf").value = idf;
   }
   function hapusElemen(idf) {
     $(idf).remove();
   }
</script>

<!-- end: Javascript -->
</body>
</html>
