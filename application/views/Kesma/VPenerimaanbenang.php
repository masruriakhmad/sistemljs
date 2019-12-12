<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Penerimaan Benang</title>

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
                    <div class="col-md-15">
                        <h3 class="animated fadeInDown">
                          Tabel  <span class="fa-angle-right fa"></span> Data Penerimaan Benang
                        </h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12" style="margin-top:5px;">
                  <a href="<?php echo base_url('Penerimaan_benang/create'); ?>">
                  <button class="btn ripple-infinite btn-gradient btn-info">
                    <div>
                    <span>Isi Data</span>
                    </div>
                  </button>
                  </a>
              </div>



              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                  <?php echo $this->session->flashdata('notif');?>
                  <?php echo $this->session->flashdata('notifhapus');?>
                  <?php echo $this->session->flashdata('notifedit');?>

                      <!-- start: delete-->
                   <div class="row clear_fix"><div class="col-md-12" id="respose"></div></div>
                   <!-- responsiv delete -->

                    <div class="panel-heading"><h3>Data Penerimaan Benang</h3></div>
                    <div class="panel-body">

                      <div class="table-responsive">
                        <!--
                         <div class="col-md-12">
                        <form action="<?php echo base_url('Penerimaan_benang/laporan'); ?>" method="POST">
                        <div class="form-group">
                        <label> Tanggal Awal </label>
                        <input type="text" id="tgl_awal" name="tgl_awal" class="tgl_awal">
                        <br><br>
                      </div>
                      <div class="form-group">
                        <label> Tanggal Akhir </label>
                        <input type="text" id="tgl_akhir" name="tgl_akhir" class="tgl_akhir">
                      <br><br>
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-warning" id="submit" name="submit" value="Cari">
                      </div>
                    </form>
                      <br>
                     </div>
                   -->

                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>                       
                          <th class="col-sm-1">No.Penerimaan</th>
                          <th class="col-sm-2">Tanggal</th>
                          <th class="col-sm-2">Jenis Benang</th>
                          <th class="col-sm-3">Vendor</th>
                          <th class="col-sm-1">Gudang</th>
                          <th class="col-sm-1">Jumlah (Bale)</th>
                          <th class="col-sm-2">Keterangan</th>
                          <th class="col-md-1">User</th>
                          <th class="col-sm-1">Cetak</th>
                          <th class="col-sm-1">Batalkan</th>
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        if($result->num_rows()>0)
                        {
                          foreach ($result->result() as $row)
                          {
                          ?>
                           <tr>
                            <td><?php echo $row->no_tr_benang; ?></td>
                            <td><?php echo $row->tgl; ?></td> 
                            <td><?php echo $row->jenis_benang; ?></td>
                            <td><?php echo $row->nm_vendor; ?></td>
                            <td><?php echo $row->nm_gudang; ?></td>
                            <td><?php echo number_format($row->jumlah,2); ?></td>
                            <td><?php echo $row->ket; ?></td>
                            <td><?php echo $row->nm_user; ?></td>
                              <td>
                            <a href="<?php echo base_url('Penerimaan_benang/cetakProses/'.$row->no_tr_benang.''); ?>" data-confirm="Cetak Penerimaan ini?" data-toogle="tooltip" title="cetak transaksi">
                               <button class="btn btn-circle btn-mn btn-warning" value="primary">
                                <span class="fa fa-print"></span>
                              </button>
                            </a>
                            </td>

                            <td>
                              <!--<a href="<?php echo base_url('Penerimaan_benang/batalProses/'.$row->no_tr_benang.''); ?>" data-toogle="tooltip" title="Edit">
                              <button class=" btn btn-circle btn-mn btn-primary" value="primary">
                                <span class="fa fa-edit"></span>
                              </button>
                            </a>
                          -->
                            <a href="<?php echo base_url('Penerimaan_benang/batalProses/'.$row->no_tr_benang.''); ?>" data-confirm="Batalkan Penenerimaan ini?" data-toogle="tooltip" title="Hapus transaksi">
                               <button class="btn btn-circle btn-mn btn-danger" value="primary">
                                <span class="fa fa-trash"></span>
                              </button>
                            </a>
                           
                            </td>
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>
                        </table>
                        
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
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

<script type="text/javascript">
   $(document).ready(function(){
    $('#datatables-example').DataTable(
    {
      "order":[1,"DESC"]
    });
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
<!--
<script type="text/javascript">
   $(document).ready(function () {
                $('.tgl_awal').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose:true
                });
            });

    $(document).ready(function () {
                $('.tgl_akhir').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose:true
                });
            });
</script>-->
 
<!-- end: Javascript -->
</body>
</html>