<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit  Detail Nomor Gulung Penerimaan Kain Jadi</title>

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
      $('body').append('<div id="dataConfirmModal" class="modal col-sm-3" style="background: white;" role="dialog" aria-hidden=""><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Konfirmasi</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Tidak</button><a class="btn btn-primary" id="dataConfirmOK">Ya</a></div></div>');
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
            <div id="content" >
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12 ">
                      
                        <h3>
                          Tabel  <span class="fa-angle-right fa"></span> Edit Detail Nomor Gulung
                        </h3>
                     
                    </div>
                  </div>
              </div>
              <!--
               <div class="col-sm-12">
                <a href="<?php echo base_url('Penerimaan_kainjadi'); ?>" >
                  <button type="button" class="btn btn-primary btn-sm">Kembali</button><br/>
                </a>
                  </div>
                -->
              <div class="col-md-12 " style="margin-top:5px;">
    
              </div>
              <div class="col-md-12 col-sm-12 top-10 padding-0">
                <div class="col-md-12 col-sm-12">
                  <div class="panel">
                  <?php echo $this->session->flashdata('notif');?>
                  <?php echo $this->session->flashdata('notifhapus');?>
                  <?php echo $this->session->flashdata('notifedit');?>

                      <!-- start: delete-->
                  <!-- <div class="row"><div class="col-md-12 col-sm-12" id="responsive"></div></div>-->
                   <!-- responsiv delete -->

                    <div class="panel-heading"><h3>Edit Detail Nomor Gulung</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive" >
                      <form action="<?php echo base_url('Penerimaan_kainjadi/editPerGulungProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0" class="col-sm-5">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th class="col-md-1">No. Gulung</th>
                          <th class="col-md-3">Nama Kain</th>
                          <th >Gramasi</th>
                          <th >Setting</th>
                          <th >Warna</th>
                          <th >Kg Grey</th>
                          <th >Kg</th>
                          <th >Nama Customer</th>
                          <th >Nomor Wo</th>
                          <th >Edit</th>
                        </tr>
                      </thead>
                      
                           <tr>
                            <td>
                              <?php echo $result->no_tr_grey; ?>
                              <input type="hidden" name="no_tr_grey" value="<?php echo $result->no_tr_grey; ?>">
                              </td>
                            <td>
                                <div class="form-group">
                                <select name="kd_kain" id="kd_kain"data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                    <option value="<?php echo $result->kd_kain; ?>"><?php echo $result->nm_kain; ?></option>
                                  <?php
                                  foreach ($kain  as $row) {
                                    echo "<option value='".$row->kd_kain."'>".$row->nm_kain."</option>";
                                  }    
                                ?>
                                </select>
                              </div>
                                
                              </td>
                            <td><?php echo $result->gramasi; ?></td>
                            <td>
                              <input type="text" name="setting" value="<?php echo number_format($result->setting,2); ?>">
                                
                              </td>
                            <td>
                              <div class="form-group">
                                <select name="kd_warna" id="kd_warna"data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                    <option value="<?php echo $result->kd_warna; ?>"><?php echo $result->nm_warna; ?></option>
                                  <?php
                                  foreach ($warna  as $row) {
                                    echo "<option value='".$row->kd_warna."'>".$row->nm_warna."</option>";
                                  }    
                                ?>
                                </select>
                              </div>
                            </td>
                            <td><?php echo $result->kg_grey; ?></td>
                            <td>
                              <input type="text" name="kg_fin" value="<?php echo number_format($result->kg_fin,2); ?>">
                            </td>
                            <td><?php echo $result->nm_customer; ?></td>
                            <td><?php echo $result->no_wo; ?></td>
                            <td><input type="submit" class="btn btn-xs btn-success" value="Simpan"></td>
                           </tr>
                  
                        </table>
                        </form>
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
<!-- end: Javascript -->
</body>
</html>