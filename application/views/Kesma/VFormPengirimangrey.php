<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pengiriman Grey</title>

  <!-- start: Css -->
  

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
  <!-- plugins -->
  
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
  <script src="<?php echo base_url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'); ?>"></script>
  
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

    function validasi()
     {
//        menangkap variabel nip dari form, 
//        my form adalah id dari form, lihat baris 5
//        nip adalah id inputan, lihat baris 6
        var no_mobil=document.forms["myform"]["no_mobil"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (no_mobil==null || no_mobil=="")
          {
          alert("Nomor Mobil harus diisi !");
          return false;
          };
  
        var nm_supir=document.forms["myform"]["nm_supir"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (nm_supir==null || nm_supir=="")
          {
          alert("Nama Supir harus diisi !");
          return false;
          };
     }

  </script>
</head>
<body id="mimin" class="dashboard" onload="setInterval('displayServerTime()', 1000);">
      <!-- start: Header -->
      <?php $this->load->view('menu2'); ?>

           <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-15">
                        <h3 class="animated fadeInDown">
                          Tabel  <span class="fa-angle-right fa"></span> Data Pengiriman Maklon
                        </h3>
                    </div>
                  </div>
              </div>
              <div class="panel-body">
                <h1>Pengiriman Grey</h1>
              </div>

                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                         <form class="form-horizontal" action="<?php echo base_url('Pengiriman_grey/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST"> 

                              <div class="form-group">
                                <div class="col-sm-12">
                                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal">Isi Data</button><br/>
                                </div>
                              </div>

                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th class="col-md-1">Kode Partai</th>
                          <th >Nama Kain</th>
                          <th class="col-md-1">Hapus</th>                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        if($result4->num_rows()>0)
                        {
                          foreach ($result4->result() as $row)
                          {
                          ?>
                           <tr>
                            <td>
                              <a href="<?php echo base_url('Partai/detailPartai/'.$row->kd_partai.''); ?>" >
                              <?php echo $row->kd_partai; ?>
                              </a>
                            </td>
                            <td><?php echo $row->nm_kain.'&nbspGramasi&nbsp'.$row->gramasi; ?></td>
                            <td>
                             <a href="<?php echo base_url('Partai/deleteByKd_partai/'.$row->kd_partai.''); ?>" data-confirm="anda yakin ingin menghapus?" data-toogle="tooltip" title="Hapus transaksi">
                             <!--  <button class=" btn btn-circle btn-mn btn-danger" value="primary"> -->
                               <span class="fa fa-trash"></span> Hapus
                              <!--</button>-->
                             </a>
                          
                            </td>
                          </tr>
                        

                          <?php $no++;
                        }
                      }
                      ?>
                        </table>
                        
                      </div>
                      <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nomor Transaksi</label>
                                   <input class="form-control" id="no_tr_maklun" type="text" name="no_tr_maklun" placeholder="" value="<?php echo $result1;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nama Subcon</label>
                                   <select  class="form-control" name="kd_subcon" id="kd_subcon">
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($result3->result() as $row) {
                                    echo "<option value='".$row->kd_subcon."'>".$row->nm_subcon."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                                </div>
                              </div>

                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">No Mobil</label>
                                   <input class="form-control" id="no_mobil" type="text" name="no_mobil" placeholder="Diisi" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nama Supir</label>
                                   <input class="form-control" id="nm_supir" type="text" name="nm_supir" placeholder="Diisi" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Keterangan</label>
                                   <textarea class="form-control" id="ket" type="text" name="ket" placeholder="Diisi" value=""></textarea>
                                </div>
                            </div>
                      <input class="submit btn btn-primary" type="submit" value="Simpan"> 
                      
                     <a href="<?php echo base_url('Partai/deleteByTrMaklun/'.$result1.''); ?>" data-confirm="anda yakin ingin menghapus?" data-toogle="tooltip" title="Hapus transaksi">
                            <button type="button" class="btn btn-danger">Cancel</button>
                             </a> 
                          
                  </form>

                </div>
              </div>


  

              <!-- Modal untuk tampil create partai -->
              <form action="<?php echo base_url('Partai/createProses'); ?>" method="post">
                <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Isi Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kode Partai</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="no_tr_maklun" class="form-control" placeholder="Diisi" value="<?php echo $result1; ?>" readonly>
                          <input type="text" name="kd_partai" class="form-control" placeholder="Diisi" value="<?php echo $result2; ?>"readonly>
                        </div>
                    </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Kain</label>
                        <div class="col-sm-10">
                                   <select  class="form-control" name="kd_kain" id="kd_kain" data-live-search="true" required>
                                    <option value="">--Pilih--</option>
                                    <?php
                                  foreach ($result6->result() as $row) {
                                    echo "<option value='".$row->kd_kain.$row->gramasi."'>".$row->nm_kain."&nbspGramasi&nbsp".$row->gramasi."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                        </div>
                    </div>
                    <!--
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nomor WO</label>
                        <div class="col-sm-10">
                                   <select  class="form-control" name="no_wo" id="no_wo" data-live-search="true">
                                    <option value="">--Pilih--</option>
                                  </select>
                        </div>
                    </div>
                  -->

                    
                  
                    <div class="form-group row">
                         <label class="col-sm-2 col-form-label">Nomor Gulung</label>
                         <div class="col-sm-10" id="no_tr_grey">
                          <!--
                            <select class="form-control" name="no_tr_grey" id="no_tr_grey" data-width="100%" multiple required>
                            <option value="">--Pilih--</option>
                            </select>
                          -->
                         </div>
                    </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>


  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js');?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('view/assets/js/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('view/assets/js/jquery.ui.min.js')?>"></script>
  <script src="<?php echo base_url('view/assets/js/bootstrap.min.js')?>"></script>
  <!-- plugins -->
  
  <script src="<?php echo base_url('assets/js/plugins/jquery.datatables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/datatables.bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/moment.min.js')?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/jquery.nicescroll.js') ;?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/jquery.mask.min.js'); ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/select2.full.min.js') ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/nouislider.min.js') ?>"></script>
  <script src="<?php echo base_url('view/assets/js/plugins/jquery.validate.min.js'); ?> />"></script>
  <!--Load JavaScript File-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.bootstrap-select').selectpicker();
    });

    function copytextbox() {
    document.getElementById('no_tr_maklun').value = document.getElementById('no_tr_maklun1').value;
    }
  </script>

  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
  <!-- Script Ajax Filter No Tr Grey-->
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_kain").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_tr_grey").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Pengiriman_grey/listGrey"); ?>", // Isi dengan url/path file php yang dituju
        data: {kd_kain : $("#kd_kain").val() }, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#no_tr_grey").html(response.list_no_tr_grey).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>

    <!-- Script Ajax Detail No Tr Grey-->
  <!--
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_partai").ready(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#list_partai").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Pengiriman_grey/listPartai"); ?>", // Isi dengan url/path file php yang dituju
        data: {kd_partai : $("#kd_partai").val() }, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#list_partai").html(response.list_no_tr_grey).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
  });
  </script>
-->

</body>
</html>