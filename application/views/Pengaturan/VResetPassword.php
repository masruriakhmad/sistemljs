<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data User</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/datatables.bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
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

<body id="mimin" class="dashboard">
      <!-- start: Header -->
       <?php $this->load->view('menu2'); ?>
          <!-- end: Left Menu -->


            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data User
                        </h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-21 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3 class="box-title"><i class = "fa fa-unlock"></i> &nbsp;Reset Password</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                     

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-10">
        <?php 
          $pesan = $this->session->flashdata('pesan');
          if (isset($pesan)){ 
            echo $pesan;
          }
         ?>
        <div class="box box-primary">
          <div class="box-header">
            <h4 color="red">Perhatian !!!. Jika pasword direset maka pasword berubah menjadi default. Default password adalah sesuai <b><i>Level Akses</i></b>.
            </h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table  class="table table-striped">
            <thead style = "background-color :  #d6eaf8">
              <tr>
                <th class = "text-center">Nama User</th>
                <th class = "text-center">Username</th>
                <th class = "text-center">Level Akses</th>
                <th class = "text-center">Proses</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($user -> result() as $u){
              if($u->level != 1){
              $level = $u->level; 
              ?>
              <tr class = "text-center">
                <td><?php echo $u->nm_user;?></td>
                <td><?php echo $u->username;?></td>
                <td><?php echo $u->level;?></td>
                <td>
                  <a href = "<?php echo site_url("Pengaturan/resetPass/".$level."") ;?> " onclick="return confirm('Apakah anda yakin akan mereset password <?php echo $u->username; ?> ?');" 
                  class="btn btn-xs btn-primary btn-flat"> <i class = "fa fa-unlock"></i> &nbsp;Reset
                  </a>
                </td>
              </tr>
              <?php } } ?>
            </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>


                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
          <!-- end: content -->

<!-- start: Javascript -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<!-- plugins -->
<script src="<?php echo base_url('assets/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.datatables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>


<!-- custom -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
<!-- end: Javascript -->
</body>
</html>