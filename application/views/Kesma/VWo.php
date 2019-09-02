<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Master WO</title>

  <!-- start: Css -->
  <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">

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
                          Tabel  <span class="fa-angle-right fa"></span> Data Master Benang
                        </h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-6" style="margin-top:5px;">
                  <a href="<?php echo base_url('Wo/create'); ?>">
                  <button class="btn ripple-infinite btn-gradient btn-info">
                    <div>
                    <span>Isi Data</span>
                    </div>
                  </button>
                  </a>
              </div>
              <div class="col-md-20 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                  <?php echo $this->session->flashdata('notif');?>
                  <?php echo $this->session->flashdata('notifhapus');?>
                  <?php echo $this->session->flashdata('notifedit');?>

                      <!-- start: delete-->
                   <div class="row clear_fix"><div class="col-md-12 col-sm-12" id="respose"></div></div>
                   <!-- responsiv delete -->

                    <div class="panel-heading"><h3>Data WO</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th  class="col-md-1" >Tanggal</th>
                          <th  class="col-md-1" >No WO</th>
                          <th >Nama Customer</th>
                          <th  class="col-md-2">Jumlah Rol</th>
                          <th  class="col-md-2">Status</th>
                          <th  class="col-md-1">Tutup WO</th>
                          <th  class="col-md-1">Cetak</th>                        
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
                            <td><?php echo $row->tgl;?></td>
                            <td><a href="<?php echo base_url('Wo/detailWo/'.$row->no_wo.''); ?>">
                                <?php echo $row->no_wo;?>
                                </a>
                            </td>
                            <td><?php echo $row->nm_customer;?></td>
                            <td><?php echo $row->subtotal_rol;?></td>
                            <td><?php echo $row->nm_status;?></td>
                            <td>
                       
                             <a href="<?php echo base_url('Wo/closeWO/'.$row->no_wo.''); ?>" data-confirm="anda yakin ingin menghapus?" data-toogle="tooltip" title="Hapus transaksi">
                               <button class=" btn btn-circle btn-mn btn-success" value="primary">
                                <span class="fa fa-check-square-o"></span>
                              </button>
                          </a>
                          
                            </td>
                               <td>
                             <a href="<?php echo base_url('Wo/cetakWo/'.$row->no_wo.''); ?>" data-confirm="anda yakin ingin mencetak Wo ini?" data-toogle="tooltip" title="Cetak transaksi">
                               <button class=" btn btn-circle btn-mn btn-warning" value="primary">
                                <span class="fa fa-print"></span>
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


              <!-- Modal Add New Package-->
             
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Work Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                      <div class="modal-data" id="data_detail">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
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
  // ini menyiapkan dokumen agar siap grak :)
  $(document).ready(function(){
    // yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
    $('.view_data').click(function(){
      // membuat variabel id, nilainya dari attribut id pada button
      // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
      var no_wo = $(this).attr("id");
      
      // memulai ajax
      $.ajax({
        url: '<?php echo base_url("Wo/detailWo"); ?>',  // set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',   // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {no_wo:no_wo},    // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){   // kode dibawah ini jalan kalau sukses
          $('#data_detail').html(data);  // mengisi konten dari -> <div class="modal-body" id="data_siswa">
          $('#myModal').modal("show");  // menampilkan dialog modal nya
        }
      });
    });
  });
</script>

<!-- end: Javascript -->
</body>
</html>