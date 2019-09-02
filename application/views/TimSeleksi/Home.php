<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
 
    <!-- start: Css -->
      <link href="<?php echo base_url ('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
      <!-- plugins -->
      <link href="<?php echo base_url ('assets/css/plugins/font-awesome.min.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/simple-line-icons.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/animate.min.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/fullcalendar.min.css');?>" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url ('assets/css/style.css');?>" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url ('assets/img/logomi.png');?>">
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

      
          <!-- start: content -->         
          <div id="content">
            <div class="tabs-wrapper text-center">             
             <div class="panel box-shadow-none text-left content-header">
                  <div class="panel-body" style="padding-bottom:0px;">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Sistem Pemilihan  Guru Terbaik </h3>
                    </div>
                    <ul id="tabs-demo" class="nav nav-tabs content-header-tab" role="tablist" style="padding-top:10px;">
                      <li role="presentation" class="active">
                        <a href="#tabs-area-demo" id="tabs2" data-toggle="tab">Home</a>
                      </li>
                   
                    </ul>
                  </div>
              </div>
            <div class="col-md-12 tab-content">



           <div role="tabpanel" class="tab-pane fade active in" id="tabs-area-demo" aria-labelledby="tabs1">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="col-md-12 tabs-area">
                      <div class="liner"></div>
                      <ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
                        <li class="active">
                         <a href="#tabs-demo6-area1" data-toggle="tab" title="welcome">
                          <span class="round-tabs one">
                            <i class="glyphicon glyphicon-home"></i>
                          </span> 
                        </a>
                      </li>

                     <li>
                      <a href="#tabs-demo6-area3" data-toggle="tab" title="Sistem Pendukung Keputusan">
                       <span class="round-tabs three">
                        <i class="glyphicon glyphicon-gift"></i>
                      </span> </a>
                    </li>

                      <li>
                        <a href="#tabs-demo6-area2" data-toggle="tab" title="Program Mahasiswa Wirausaha">
                         <span class="round-tabs two">
                           <i class="glyphicon glyphicon-user"></i>
                         </span> 
                       </a>
                     </li>

                    <li>
                      <a href="#tabs-demo6-area4" data-toggle="tab" title="blah blah">
                       <span class="round-tabs four">
                         <i class="glyphicon glyphicon-comment"></i>
                       </span> 
                     </a>
                   </li>

                   <li><a href="#tabs-demo6-area5" data-toggle="tab" title="completed">
                     <span class="round-tabs five">
                      <i class="glyphicon glyphicon-ok"></i>
                    </span> </a>
                  </li>
                </ul>
                <div class="tab-content tab-content-v5">
                  <div class="tab-pane fade in active" id="tabs-demo6-area1">

                    <center><h3 class="animated fadeInLeft">SELAMAT DATANG <span style="color:#f48250;"></span></h3></center>
                    <center>
                    <h4 class="animated fadeInLeft">
                      Sistem Pendukung Keputusan Seleksi Program Mahasiswa Wirausaha(PMW) Universitas Diponegoro Menggunakan Metode MOORA
                    </h4>
                    </center>
                    <p class="text-center">
                      <a href="" class="">_____________________<span style="margin-left:10px;" class="glyphicon glyphicon-money"></span></a>
                    </p>
                  </div>
                  <div class="tab-pane fade" id="tabs-demo6-area2">
                    <center>
                    <h3 class="animated fadeInLeft">PMW (Program Mahasiswa Wirausaha) </h3>
                    </center>
                    <p class="narrow text-center">
                     PMW adalah suatu program yang digagas oleh Dikti untuk dikembangkan ke dalam kehidupan kampus guna merangsang jiwa enterpreneurship (kewirausahaan) dalam diri mahasiswa. Program ini dilaksanakan setiap tahun pada hampir seluruh Universitas negeri dan Swasta di Indonesia. PMW bertujuan untuk memberikan bekal pengetahuan,keterampilan dan sikap atau jiwa wirausaha (entrepreneurship) berbasis Iptek kepada pada mahasiswa agar dapat mengubah pola pikir (mindset) dari pencari kerja (job seeker) menjadi pencipta lapangan pekerjaan (job creator) serta menjadi calon pengusaha yang tangguh dan sukses menghadapi persaingan global.
                    </p>

                    <p class="text-center">
                      <a href="" class="">_____________________<span style="margin-left:10px;" class=""></span></a>
                    </p>

                  </div>
                  <div class="tab-pane fade" id="tabs-demo6-area3">
                    <center>
                    <h3 class="animated fadeInLeft">SPK (Sistem Pendukung Keputusan)</h3>
                    </center>
                    <p class="narrow text-center">
                     SPK (Sistem Pendukung Keputusan) adalah pendekatan berbasis komputer atau metodologi untuk mendukung pengambilan keputusan. Bagian paling penting dari SPK khas adalah data warehouse, yang merupakan subjek berorientasi, terpadu, waktu-varian, non-normalisasi, koleksi non-volatile data yang memungkinkan menganalisis sejumlah besar data dari berbagai sumber dengan hasil yang cepat  (Turban 2005).
                    </p>

                    <p class="text-center">
                      <a href="" class="">_____________________<span style="margin-left:10px;" class=""></span></a>
                    </p>
                  </div>
                  <div class="tab-pane fade" id="tabs-demo6-area4">
                    <center>
                    <h3 class="animated fadeInLeft">Metode MOORA</h3>
                    </center>
                    <p class="narrow text-center">
                      Metode MOORA singkatan dari Multi Objective Optimization on the Basis of Ratio Analysis. Pertama kali diperkenalkan oleh Brauers dan Zavadskas pada tahun 2006 sebagai multiobjektif sistem yaitu mengoptimalkan dua atau lebih atribut yang saling bertentangan secara bersamaan. Metode ini diterapkan untuk memecahkan berbagai jenis masalah dengan perhitungan matematika yang kompleks.
                    </p>

                    <p class="text-center">
                      <a href="" class="">_____________________<span style="margin-left:10px;" class=""></span></a>
                    </p>

                  </div>
                  <div class="tab-pane fade" id="tabs-demo6-area5">
                    <div class="text-center">
                      <i class="img-intro icon-checkmark-circle"></i>
                    </div>
                    <center>
                    <h3 class="animated fadeInLeft">Hasil Seleksi</h3>
                    </center>
                    <p class="narrow text-center">
                     Sistem ini akan menghasilkan sebuah perangkingan dari penilaian data-data pendaftar PMW yang telah dimasukkan. Sistem ini dapat membantu Bagian Kesejahteraan Mahasiswa dalam menentukan tim yang lolos seleksi sejumlah kuota yang telah ditentukan sebelumnya berdasarkan kriteria-kriteria yang diberikan. 
                    </p>
                    <p class="text-center">
                      <a href="" class="">_____________________<span style="margin-left:10px;" class=""></span></a>
                    </p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>  





         <!-- start:dashboard -->
          <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-12 padding-0">
                            <div class="col-md-12 padding-0">
                             

                                <div class="col-md-5">
                                 
                                <div class="panel">
                                  <div class="panel-heading-white panel-heading text-center">
                                  <h4>Peminat PMW</h4>
                                </div>
                                  <div class="panel-body">
                                    <div class="col-md-10">
                                  <canvas class="bar-chart"></canvas>
                                </div>
                              </div>
                           </div>
                        </div>

                           <div class="col-md-3">
                                    <div class="panel box-v1">
                                   <div class="panel">
                                  <div class="panel-heading-white panel-heading text-center">
                                          <h4><span class="fa fa-user"></span> Tim Peserta </h4>  
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <h1>  
                                        <?php if($result1->num_rows()>0)
                                        { foreach ($result1->result() as $row){
                                         echo $row->jumlahTim; }}?>
                                        </h1>
                                        <h4>Tim</h4>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                 
                        <div class="col-md-4">
                        <div class="panel">
                             <div class="panel-heading-white panel-heading text-center">
                                <h5>Jenis Usaha</h5>
                              </div>
                              <div class="panel-body">
                                  <center>
                                  <canvas class="pie-chart"></canvas>
                                  </center>
                              </div>
                        </div>
                    </div>
                  
                    </div>

                  </div>

                  </div>


         
          </div>
          <!-- end: content -->



             
          <!-- end: content -->
  

    <!-- start: Javascript -->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.ui.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
   
    
    <!-- plugins -->

    <script src="<?php echo base_url('assets/js/plugins/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/jquery.vmap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/maps/jquery.vmap.world.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/jquery.vmap.sampledata.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/chart.min.js'); ?>"></script>


    <!-- custom -->
    
     <script type="text/javascript">

          (function(jQuery){
      
        var barData = {
             labels: ["FT", "FSM", "FK", "FKM", "FH", "FEB", "FISIP","FPIK","FPP","FIB","FPsi"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(21,186,103,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [<?php if($result7->num_rows()>0)
                          { foreach ($result7->result() as $row){
                           echo $row->jumlahFT; }}?>,
                            <?php if($result8->num_rows()>0)
                          { foreach ($result8->result() as $row){
                           echo $row->jumlahFSM; }}?>,
                            <?php if($result9->num_rows()>0)
                          { foreach ($result9->result() as $row){
                           echo $row->jumlahFK; }}?>,
                            <?php if($result10->num_rows()>0)
                          { foreach ($result10->result() as $row){
                           echo $row->jumlahFKM; }}?>,
                            <?php if($result11->num_rows()>0)
                          { foreach ($result11->result() as $row){
                           echo $row->jumlahFH; }}?>,
                            <?php if($result12->num_rows()>0)
                          { foreach ($result12->result() as $row){
                           echo $row->jumlahFEB; }}?>, 
                            <?php if($result13->num_rows()>0)
                          { foreach ($result13->result() as $row){
                           echo $row->jumlahFISIP; }}?>, 
                            <?php if($result14->num_rows()>0)
                          { foreach ($result14->result() as $row){
                           echo $row->jumlahFPIK; }}?>, 
                            <?php if($result15->num_rows()>0)
                          { foreach ($result15->result() as $row){
                           echo $row->jumlahFPP; }}?>, 
                            <?php if($result16->num_rows()>0)
                          { foreach ($result16->result() as $row){
                           echo $row->jumlahFIB; }}?>,
                            <?php if($result17->num_rows()>0)
                          { foreach ($result17->result() as $row){
                           echo $row->jumlahFPsi; }}?>]
                }
            ]
        };

     


        var doughnutData = [
                {
                    value:  <?php if($result3->num_rows()>0)
                          { foreach ($result3->result() as $row){
                           echo $row->jumlahBoga; }}?>,
                    color:"#4ED18F",
                    highlight: "#15BA67",
                    label: "Boga"
                },
                {
                    value: <?php if($result4->num_rows()>0)
                          { foreach ($result4->result() as $row){
                           echo $row->jumlahJasa; }}?>,
                    color: "#15BA67",
                    highlight: "#15BA67",
                    label: "Jasa"
                },
                {
                    value: <?php if($result5->num_rows()>0)
                          { foreach ($result5->result() as $row){
                           echo $row->jumlahProduksi; }}?>,
                    color: "#5BAABF",
                    highlight: "#15BA67",
                    label: "Produksi"
                },
                {
                    value: <?php if($result6->num_rows()>0)
                          { foreach ($result6->result() as $row){
                           echo $row->jumlahBudidaya; }}?>,
                    color: "#94D7E9",
                    highlight: "#15BA67",
                    label: "Budidaya"
                }

            ];

             window.onload = function(){
                
                var ctx2 = $(".pie-chart")[0].getContext("2d");
                window.myPie = new Chart(ctx2).Pie(doughnutData, {
                    responsive : true,
                    showTooltips: true
                });

             
                var ctx4 = $(".bar-chart")[0].getContext("2d");
                window.myBar = new Chart(ctx4).Bar(barData, {
                    responsive : true,
                    showTooltips: true
                });

             

            };
        })(jQuery);
    
      
     </script>
  <!-- end: Javascript -->
  </body>
</html>