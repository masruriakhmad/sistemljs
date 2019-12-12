<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Kinerja MEsin</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/datatables.bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/charts.css');?>">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 
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


    $(document).ready(function() {
  $('a[data-confirm]').click(function(ev) {
    var href = $(this).attr('href');
    if (!$('#dataConfirmModal').length) {
      $('body').append(
        '<div id="dataConfirmModal" class="modal" style="margin-top: 270px; margin-left: 500px; margin-right: 500px; margin-bottom: 270px; background: white;" role="dialog" aria-hidden=""><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h5 id="dataConfirmLabel">Konfirmasi</h5></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Tidak</button><a class="btn btn-primary" id="dataConfirmOK">Ya</a></div></div>');
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
                    <div class="col-md-12">
                        <h3 class="animated fadeInDown">
                          Tabel  <span class="fa-angle-right fa"></span> Data Kinerja Mesin
                        </h3>
                    </div>
                  </div>
              </div>
              
              <div class="col-md-12" style="margin-top:5px;">
                <!--
                <div class="col-md-2">
                  <a href="<?php echo base_url('Mesin/create'); ?>">
                  <button class="btn ripple-infinite btn-gradient btn-info">
                    <div>
                    <span>Tambah Mesin</span>
                    </div>
                  </button>
                  </a>
                </div>
              -->  
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                  <?php echo $this->session->flashdata('notif');?>
                  <?php echo $this->session->flashdata('notifhapus');?>
                  <?php echo $this->session->flashdata('notifedit');?>

                      <!-- start: delete-->
                   <div class="row clear_fix col-md-12">
                    <div class="col-md-12" id="respose"></div></div>
                   <!-- responsiv delete -->

                    <div class="panel-heading"><h3>Data Kinerja Mesin</h3></div>
                    <div class="panel-body" align="center">
                    <form action="<?php echo base_url('Mesin/filterKinerjaMesin'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                          <input class="input-group-sm" type="date" name="tglawal" required>
                          <input class="input-group-sm" type="date" name="tglakhir"required>
                          <input type="submit" class="btn btn-xs btn-primary" value="Cari">
                          <a href="<?php echo base_url('Mesin/kinerjaMesin'); ?>">
                          <button type="button" class="btn btn-xs btn-warning">Reset</button>
                    </a>  
                    </form>
                    <br>
                     <div class="panel-body" align="center">
                      <?php
                    echo "Range : ".$this->session->flashdata('tglAwal')." s/d ".$this->session->flashdata('tglAkhir');
                    ?>
                  </div>
                  </div>

                    <div class="panel-body">
                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th >No. Mesin</th>
                          <th >Benang Masuk (Kg)</th>
                          <th >Output Kain (Kg)</th>
                          <th >Output Kain (Rol)</th>                      
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $jumlah_kg_masuk=0;
                        $jumlah_kg_keluar=0;
                        $jumlah_rol_keluar=0;
                        if($result->num_rows()>0)
                        {
                          foreach ($result->result() as $row)
                          {
                          ?>
                           <tr>
                            <td>
                              <?php echo $row->no_mesin; ?>
                            </td>
                            <td>
                              <?php 
                                echo number_format($kg_masuk=$row->kg_masuk,2); 
                                $jumlah_kg_masuk += $kg_masuk;
                              ?>  
                            </td>
                            <td>
                              <?php 
                                echo number_format($kg_keluar=$row->kg_keluar,2); 
                                $jumlah_kg_keluar += $kg_keluar;
                                ?>
                            </td>
                            <td>
                              <?php 
                                echo number_format($rol_keluar=$row->rol_keluar,2);
                                $jumlah_rol_keluar += $rol_keluar; 
                                ?>
                            </td>
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>
                          <tr>
                            <td><b>Total</b></td>
                            <td><b><?php echo number_format($jumlah_kg_masuk,2); ?></b></td>
                            <td><b><?php echo number_format($jumlah_kg_keluar,2); ?></b></td>
                            <td><b><?php echo number_format($jumlah_rol_keluar,2); ?></b></td>
                          </tr>
                        </table>
                        
                      </div>
                      <!--
                        <div class="col-md-12">
                            <div class="charts-single-pro shadow-reset">
                                <div class="alert-title">
                                    <h2>Grafik Benang Masuk</h2>
                                </div>
                                 <div id="bar1-chart">
                                    <canvas id="barchart1"></canvas>
                                </div>
                            </div>
                        </div>
                      -->
                  </div>

                </div>
              </div>  
              </div>
            </div>


             <!-- Delete Modal content-->

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

<script src="<?php echo base_url('assets/js/charts/Chart.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/charts/bar-chart.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>


<!-- custom -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });

   $(document).ready(function() {
                resetcheckbox();
                $('#selecctall').click(function(event) {  //on click
                    if (this.checked) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"              
                        });
                    } else {
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                        });
                    }
                });


                $("#del_all").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                    
                    $.each( checkValues, function( i, val ) {
                        $("#"+val).remove();
                        });
//                    return  false;
                    $.ajax({
                        url: '<?php echo base_url() ?>Kriteria/delete',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
                        $('#selecctall').attr('checked', false);
                    });
                });

                $(".addrecord").click(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $.ajax({
                        type: 'POST',
                        url: url
                    }).done(function() {
                        window.location.reload();
                    });
                });
                
                function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
                }
            });
</script>

<script>

$(document).ready(function(){ 

  //kirim value excel ke import
  $('#import_form').on('submit', function(event){

    event.preventDefault();

    $.ajax({

      url:"<?php echo base_url() ?>Mesin/import",

      method:"POST",

      data:new FormData(this),

      contentType:false,

      cache:false,

      processData:false,

      success:function(data){

          $('#file').val('');
          alert('Import dari Excel Sukses');
      
      }

    })

  });

});

</script>
<script>
    var ctx = document.getElementById("barchart1").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["BD01", "RB02", "DK03", "DK04", "DK05", "DK06", "BD07", "RB08", "DK08", "DK09", "DK10", "DK11", "DK12" ],
        datasets: [{
          label: 'Kinerja Mesin',
          data: [0,0,0,0,0,0,0,0,0,0,0,0],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
<!-- end: Javascript -->
</body>
</html>