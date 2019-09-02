<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Penilaian Tim</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/datatables.bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
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
            <div class="col-md-12">
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  
              </div>
           

              
              <div class="col-md-10 top-20 padding-0">
                <div class="col-md-6">
                  <div class="panel">
                    <div class="panel-heading"><h3>Data Penilaian Tim</h3></div>
                    <div class="panel-body">
                      
                      <div class="responsive-table">

                      <table class="table table-striped table-bordered " width="110%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Tim</th>
                          <th>ID Kriteria</th>
                        </tr>
                      </thead>
                        <?php
                        $no = 1;
                        if($result->num_rows()>0)
                        {
                          foreach ($result ->result() as $value)
                          {
                        ?>
                      <tbody>
                      <tr>
                        <td><?php echo $no; ?></td> 
                        <td><?php echo $value->id_tim; ?></td>
                         <td><?php echo $value->id_kriteria; ?></td>

                      <tr>
                          <?php $no++;
                        }
                      }
                      ?>
                      </tbody> 
                       </table>

                    </div>
                  </div>
                </div>
              </div>  
             
                
                  <div class="panel">
                    <div class="panel-heading"><h3>Normalisasi</h3></div>
                    <div class="panel-body">
                    <div class="col-md-6 top-18 padding-0">
                    <div class="col-md-5">
                       <table  class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Normalisasi</th>
                          
                        </tr>
                      </thead>
                        
                           <tbody>
                        <?php
                        foreach ($normalisasi as $key => $value) {
                          echo '<tr>
                              <td><b>'.$value.'</b></td>
                          </tr>';
                          # code...
                        }
                        ?>
                      </tbody>
                  
                       </table>



                  
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