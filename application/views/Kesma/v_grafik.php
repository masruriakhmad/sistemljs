<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grafik</title>

  <!-- start: Css -->
   <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">

  <!-- plugins -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/nouislider.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/select2.min.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/datatables.bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- plugins -->

  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
 
   
  <?php
        foreach($data as $data){
            $ambil = $data->ambil;

            if ($ambil=="01")          {$nama="Januari ".$data->tahun;}
                elseif ($ambil=="02")  {$nama="Februari ".$data->tahun;}
                elseif ($ambil=="03")  {$nama="Maret ".$data->tahun;}
                elseif ($ambil=="04")  {$nama="April ".$data->tahun;}
                elseif ($ambil=="05")  {$nama="Mei ".$data->tahun;}
                elseif ($ambil=="06")  {$nama="Juni ".$data->tahun;}
                elseif ($ambil=="07")  {$nama="Juli ".$data->tahun;}
                elseif ($ambil=="08")  {$nama="Agustus ".$data->tahun;}
                elseif ($ambil=="09")  {$nama="September ".$data->tahun;}
                elseif ($ambil=="10")  {$nama="Oktober ".$data->tahun;}
                elseif ($ambil=="11")  {$nama="November ".$data->tahun;}
                elseif ($ambil=="12")  {$nama="Desember ".$data->tahun;}
                elseif ($ambil >"12")  {$nama=$ambil;}
                else   {$nama=$ambil;}
            $name[] = $nama;
            $jumlah[] = (float) $data->jumlah;
        }
    ?>
        <!--Load chart js-->
    <script type="text/javascript" src="<?php echo base_url('assets/chart.js-master/Chart.min.js')?>"></script>

    <style type="text/css">
     .rol {
            transform: rotate(-90deg);
            margin-bottom: 0;

           /* transform-origin: right bottom 0;*/
          }
    </style>
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
                          Tabel  <span class="fa-angle-right fa"></span> Data Grafik <?php echo $tabel?> 
                        </h3>
                    </div>
                  </div>
              </div>
              
          
              <div class="col-md-20 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                 
                      <!-- start: delete-->
                   <div class="row clear_fix"><div class="col-md-12 col-sm-12" id="response"></div></div>
                   <!-- responsiv delete -->

                    <div class="panel-heading"><h3>Data Grafik (rol)</h3></div>
                    <div class="panel-body">
                     <!--  <h5 class="left ">(rol)</h5> -->
                     <canvas id="canvas" class="col-md-12 left"></canvas>



                   </div>
                </div>
              </div>  
              </div>
            </div>
<!-- end: content -->

<!-- start: Javascript -->
    <script>

            var lineChartData = {
                labels : <?php echo json_encode($name);?>,
                datasets : [
                    {   label : "(rol)",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($jumlah);?>
                    }
                ]
                
            }


        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(lineChartData);
        
    </script>
  
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.validate.min.js'); ?> />"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>

<!-- end: Javascript -->
</body>

</html>