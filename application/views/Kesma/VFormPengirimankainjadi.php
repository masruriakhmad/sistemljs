<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pengiriman Kain Jadi</title>

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
                          Tabel  <span class="fa-angle-right fa"></span> Data Penerimaan Kain Jadi
                        </h3>
                    </div>
                  </div>
              </div>

              <div class="panel-body">
                <h1>Pengiriman Kain Jadi</h1>
              </div>
               <div class="col-md-12">
                <?php echo $this->session->flashdata('notif');?>
                <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo base_url('Pengiriman_kainjadi/createListJual'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST"> 
                <div class="form-group">
                  <div class="col-sm-5">
                    <input class="form-control" type="text" name="no_grey" value="" placeholder="Isikan nomor gulung" required autofocus /><br>
                    <input class="submit btn btn-sm btn-primary" type="submit" value="Tambah"> 
                  </div>
                </div>
              </form>
            </div>
              </div>

                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                         <form class="form-horizontal" action="<?php echo base_url('Pengiriman_kainjadi/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST"> 
                          <?php if($this->session->userdata('level')!='operator'){ ?>
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal">Tambahkan Masal</button><br/>
                                </div>
                              </div>
                            <?php } ?>

                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th>No.</th>
                          <th class="col-md-1">Nomor Gulung</th>
                          <th >Nama Kain</th>
                          <th >Gramasi</th>
                          <th >Setting</th>
                          <th >Warna</th>
                          <th >Kg</th>
                          <th >Nomor Wo</th>
                          <th >Customer</th>
                          <th class="col-md-1">Hapus</th>              
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total=0;
                        if($result>0)
                        {
                          foreach ($result as $row)
                          {
                          ?>
                            <tr>
                            <td><?php echo $no; ?></td>  
                            <td><?php echo $row->no_tr_grey; ?></td>
                            <td><?php echo $row->nm_kain;?></td>
                            <td><?php echo $row->gramasi;?></td>
                            <td><?php echo $row->setting;?></td>
                            <td><?php echo $row->nm_warna;?></td>
                            <td><?php 
                              echo $row->kg_fin;
                              $total += $row->kg_fin;
                              ?></td>
                            <td><?php echo $row->no_wo;?></td>
                            <td><?php echo $row->nm_customer;?></td>
                            <td>
                             <a href="<?php echo base_url('Pengiriman_kainjadi/deleteListJual/'.$row->no_tr_grey.''); ?>" data-confirm="anda yakin ingin menghapus?" data-toogle="tooltip" title="Hapus transaksi">
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
                            <tr>
                              <td colspan="6" align="right"><b>Total</b></td>
                              <td><b><?php echo $total;?></b></td>
                              <td colspan="4"></td>
                            </tr>
                        </table>
                        
                      </div>

                      <div class="form-group">
                                 <div class="col-sm-5">
                                  <label class="control-label">Nomor Transaksi</label>
                                  <br/>
                                   <input class="form-control" id="no_jual" type="text" name="no_jual" placeholder="Diisi" value="<?php echo $no_jual;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                  <div class="col-sm-5">
                                  <label class="control-label">Customer</label>
                                  <br/>
                                  <select  class="form-control" name="kd_customer1" id="kd_customer1" required>
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($customer->result() as $row) {
                                    echo "<option value='".$row->kd_customer."'>".$row->nm_customer."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                                </div>
                              </div>
                            <div class="form-group">
                                  <div class="col-sm-5">
                                  <label class="control-label">Nomor Mobil</label>
                                  <br/>
                                   <input class="form-control" id="no_mobil" type="text" name="no_mobil" placeholder="Diisi" required>
                                </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-5">
                                  <label class="control-label">Nama Supir</label>
                                  <br/>
                                   <input class="form-control" id="supir" type="text" name="supir" placeholder="Diisi" required>
                                </div>
                              </div>
                              <div class="form-group">
                                   <div class="col-sm-5">
                                  <label class="control-label">Keterangan</label>
                                  <br/>
                                     <textarea class="form-control" id="ket" type="text" name="ket" placeholder="Diisi"></textarea>
                                </div>
                              </div>

                      <input class="submit btn btn-primary" type="submit" value="Simpan"> 
                      
                      <a href="<?php echo base_url('Pengiriman_kainjadi/deleteListJualMasal/'); ?>" data-confirm="anda yakin ingin membatalkan transaksi?" data-toogle="tooltip" title="Hapus transaksi">
                            <button type="button" class="btn btn-danger">Cancel</button>
                             </a> 
                          
                  </form>

                </div>
              </div>
            </div>

              <!-- Modal untuk tampil create partai penerimaan -->
              
                <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form action="<?php echo base_url('Pengiriman_kainjadi/createListJualMasal'); ?>" method="post">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Isi Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form col-md-12 ">
                        <div class="form-group row">
                           <label class="control-label">Nomor Partai</label><BR>

                                   <select  class="selectpicker" data-live-search="true" name="no_partai" id="no_partai" required>
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($partai->result() as $row) {
                                    echo "<option value='".$row->no_partai."'>".$row->no_partai."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                        </div>
                        <!--
                        <div class="form-group row">
                          <label class="control-label">Nomor WO</label>
                                  <br/>
                                   <select class="form-control"  name="no_wo" id="no_wo" required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                        <!--
                        <div class="form-group row">
                           <label class="control-label">Nama Kain</label>
                                  <br/>
                                    <select class="form-control"  name="kd_kain" id="kd_kain"  required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                      -->
                        <div class="form-group row">
                           <label class="control-label"> List Nomor Gulung  --> no. Gulung | nama kain | Gramasi | Setting | Kg | Warna</label>
                                   <div id="no_tr_grey" class="col-md-12"></div>
                        </div>

                        </div>
                      
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                      </div>
                    </div>
                  </div>
                     </form>
                </div>
           


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
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <!--Load JavaScript File-->
  <!--
  <script type="text/javascript">
    $(document).ready(function(){
      $('.bootstrap-select').selectpicker();
    });

    function copytextbox() {
    document.getElementById('no_tr_maklun').value = document.getElementById('no_tr_maklun1').value;
    }
  </script>
-->
<!--
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_customer").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_wo").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Pengiriman_kainjadi/listWo"); ?>", // Isi dengan url/path file php yang dituju
        data: {kd_customer : $("#kd_customer").val() }, // data yang akan dikirim ke file yang dituju
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
          $("#no_wo").html(response.list_no_wo).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>

  <!-- cadangan

  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#no_wo").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kd_kain").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Pengiriman_kainjadi/listKain"); ?>", // Isi dengan url/path file php yang dituju
        data: {no_wo : $("#no_wo").val() }, // data yang akan dikirim ke file yang dituju
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
          $("#kd_kain").html(response.list_kain).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>
-->


   <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#no_partai").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_tr_grey").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya

      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Pengiriman_kainjadi/listTrGrey"); ?>", // Isi dengan url/path file php yang dituju
        data: {no_partai : $("#no_partai").val() }, // data yang akan dikirim ke file yang dituju
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

</body>
</html>