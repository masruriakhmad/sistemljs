<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Tim</title>

    

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/datatables.bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
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

<body id="mimin" class="dashboard" onload="setInterval('displayServerTime()', 1000);">
      <!-- start: Header -->
      <?php $this->load->view('menu'); ?>
          <!-- end: Left Menu -->
            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Nilai Tim
                        </h3>
                    </div>
                  </div>
              </div>
           
                <?php echo $this->session->flashdata('notifedit');?>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                   <div class="row clear_fix"><div class="col-md-12" id="respose"></div></div>
                   <!-- responsiv delete -->
                    <div class="panel-heading"><h3>Data Penilaian Tim Peserta PMW <?php echo $tahun;?></h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                     
                     <!-- Content Wrapper. Contains page content -->

<!-- Kelola Nilai -->

<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
   
    
    <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead style = "background-color :  #d6eaf8">
          <tr>
            <th class = "text-center">No.Tim</th>
            <th class = "text-center">Nama</th>
            
            <?php foreach($listKriteria as $key=> $kriteria){

            ?>

            <th class = "text-center"><?php echo $kriteria->nama_kriteria?></th>
            <?php

            }//end foreach listKriteria
            ?>
            
            <th class = "text-center">Proses</th>
          </tr>
                </thead>
        
                <tbody>
          <?php foreach($listTim as $key => $eachTim){?>
            <tr class = "text-center">
              
              <td><?php echo $eachTim->no_tim;?></td>
              <td><?php echo $eachTim->judul_proposal;?></td>
              <form action = "<?php echo site_url("Nilai/editNilai/".$eachTim->id_tim."");?>" method = "POST">

              <?php
                foreach($eachTim->listNilai as $key2 => $eachNilai){

              ?>
              <td>
                <input type = "number" step="0.1" value ="<?php echo $eachNilai;?>" name = "k[<?php echo $key2;?>]" min = "0" max="1000">
                
              </td>

              <?php

                }
              ?>
              
                <input type = "hidden"  value = "<?php echo $eachTim->judul_proposal;?>" name = "judul_proposal">
                <input type="hidden" name="tahun" value="<?php echo $tahun?>">
                
              <td>
                <button type="submit" class="btn btn-xs btn-primary btn-flat">Simpan</button>
              </td>
              </form>
            </tr>
          <?php }?>
                </tbody>
              </table>
            </div>
      
            <!-- /.box-body -->
          </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.cont
                      
                      
                      </div>
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
                        url: '<?php echo base_url() ?>Tim/delete',
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
<!-- end: Javascript -->
</body>
</html>