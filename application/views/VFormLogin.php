<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">
  <!-- plugins -->
  <link  href="<?php echo base_url ('assets/css/plugins/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
  <link  href="<?php echo base_url ('assets/css/plugins/simple-line-icons.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url ('assets/css/plugins/animate.min.css')?>"  rel="stylesheet" type="text/css">
  <link href="<?php echo base_url ('assets/css/plugins/icheck/skins/flat/aero.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url ('assets/css/style.css')?>" rel="stylesheet">
  <!-- end: Css -->

  <link href="<?php echo base_url('assets/img/logomi.png')?>" rel="shortcut icon" >


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
      $('body').append('<div id="dataConfirmModal" class="modal" style="margin-top: 270px; margin-left: 500px; margin-right: 500px; margin-bottom: 270px; background: white;" role="dialog" aria-hidden=""><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Konfirmasi</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Tidak</button><a class="btn btn-primary" id="dataConfirmOK">Ya</a></div></div>');
    } 
    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
    $('#dataConfirmOK').attr('href', href);
    $('#dataConfirmModal').modal({show:true});
    return false;
  });
});

  </script>



  
    </head>

    <br><br><br>
    <body id="mimin" class="" style="background-color:">
   
      <div class="container">
        <div class="container">
        <div class="info">
        
        </div>
        </div>
        
        <center> 
          <center><h3 style="color:#999999;">Sistem </h3></center>
          <center><p>CV LANGGENG JAYA SANTOSO</p></center>
           <center> ______________</center>
      </div>
       </center>
        <form action="<?php echo base_url('LoginControl/login'); ?>" method="post" class="form-signin">

          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  
                  
                  <h3>Login</h3>
                  
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="username" required>
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="password" required>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <input type="submit" class="btn col-md-12" value="Login"/>
              </div>
              <center>
              <div>
                  <p>Lupa Password? <a href="<?php echo base_url('LoginControl/lupaPassword'); ?>" data-confirm="Anda yakin ingin menghapus data ini?">Klik di sini</a></p>
              </div>
              </center>
          </div>
        </form>

        <center><b>STAFF IT</b></center>
          <center>Copyright 2019</center>
      </div>
       </center>
      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

      <script src="<?php echo base_url('assets/js/plugins/moment.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/plugins/icheck.min.js')?>"></script>

      <!-- custom -->
      <script src="<?php echo base_url('assets/js/main.js')?>"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>