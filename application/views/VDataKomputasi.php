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

            <div id="content">
            <div class="notifications-wrapper text-center">

             
              <div class="panel box-shadow-none content-header">
              <div class="panel-body">
              <div class="col-md-12 padding-0">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="panel">
                      <div class="panel-heading panel-heading-white">
                        <h2 class="animated fadeInLeft">Komputasi</h2>
                      </div>
                      <div class="panel-body">
                        <div class="col-md-12">
                         <!--
                        <a href="<?php echo base_url('Komputasi/komputasi'); ?>">
                          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left" style="margin:5px;">Hasil Normalisasi</button>
                        </a>
                        <a href="<?php echo base_url('Komputasi/maxmin'); ?>">
                          <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top" style="margin:5px;">Hasil MaxMin</button>
                        </a>
                        -->
          <?php echo $this->session->flashdata('notifProses');?>
          <?php echo $this->session->flashdata('notifProsesUlang');?>
          
          <section class="">
          <form action="<?php echo base_url('Komputasi/komputasi'); ?>" autocomplete="on" method="POST">
            
          <?php foreach($result1 ->result() as $value){?>
            <tr class = "text-center">
              <td>
              <input type = "hidden" value ="<?php echo $value->id_tim;?>" name = "id_tim[]">
              <?php }?> 
               <?php
                        foreach ($result2 as $key => $value) {?>
                              <input type = "hidden" value ="<?php echo $value;?>" name = "nilai_y[]">
                        <?php }?> 


              </td>
              
              
            </tr>  
                   

                </tbody>
              </table>

            <center> 
            </center>
              

            </div>
      
            <!-- /.box-body -->

                        <input class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Proses" style="margin:5px;" type="submit" value="Proses">
                          </form>
                       
                    
                

      
          <form action = "<?php echo site_url("Komputasi/lihat_Hasil")?>" method = "GET">
              <div class="box-body">
                <div class="form-group">
               
                  <div class="">
                 
                      
                        <input type="hidden" name="tahun" value = "<?php echo $tahun;?>">
               
                   
                  </div>
                </div>
              
              </div>
              <!-- /.box-body -->

              <input class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Lihat Hasil" style="margin:5px;" type="submit" value="Lihat Hasil">
              <!-- /.box-footer -->
            </form>
               </div>
                      </div>
                    </div>
                    </div>
                </div>
              </div>  
              </div>
      







               <div class="col-md-12">
                          <div class="panel">
                            <div class="panel-heading panel-heading-white"></div>
                            <div class="panel-body">
                         
                              <div class="col-md-6">
                                <div class="alert alert-warning alert-border alert-dismissible fade in" role="alert">
                                 <h3>Proses
                                  
                                </h3>
                                <p>Tombol Proses digunakan untuk memproses data nilai sehingga menghasilkan data hasil berupa nilai y</p>
                              </div>
                            </div>

                         

                          <div class="col-md-6">
                            <div class="alert alert-info alert-border alert-dismissible fade in" role="alert">
                              <h3>Lihat Hasil  
                              </h3>
                              <p>Tombol Lihat Data Hasil digunakan untuk melihat data hasil yang telah dirangking. Data hasil ini dapat diexport dalam format Excel</p>
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