<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Pengiriman Kain Jadi</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/script.js"></script>
	<link href="<?php echo base_url ('assets/css/bootstrap.min.css'); ?>"  rel="stylesheet" type="text/css">
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/nouislider.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/select2.min.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/bootstrap-material-datetimepicker.css') ;?>"/>
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
   <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
  <!-- end: Css -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      <?php $this->load->view('menu2'); ?>

           <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-15">
                        <h3 class="animated fadeInDown">
                          Tabel  <span class="fa-angle-right fa"></span> Data Pengiriman Kain Jadi
                        </h3>
                    </div>
                  </div>
              </div>
                        <?php echo $this->session->flashdata('notif');?>
              <div class="panel-body">
                <h1>Pengiriman Kain Jadi</h1>
              </div>
                        <div class="col-md-12">
                        <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
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
                        if($result>0)
                        {
                          foreach ($result as $row)
                          {
                          ?>
                           <tr>
                            <td><?php echo $row->no_tr_grey; ?></td>
                            <td><?php echo $row->nm_kain;?></td>
                            <td><?php echo $row->gramasi;?></td>
                            <td><?php echo $row->setting;?></td>
                            <td><?php echo $row->nm_warna;?></td>
                            <td><?php echo $row->kg_fin;?></td>
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
                        </table>
                        
                      </div>
                    </div>
               
                   <form action="<?php echo base_url('Penerimaan_kainjadi/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">          
                               <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nomor Mobil</label>
                                  <br/>
                                   <input class="form-control" id="no_mobil" type="text" name="no_mobil" placeholder="Diisi" value="" required>
                                </div>
                              </div>
                    

                      <div class="form-group">
                        <div class="col-sm-12">
                          <br/>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <a href="<?php echo base_url('Pengiriman_kainjadi/deleteListJualMasal/'); ?>" data-confirm="anda yakin ingin membatalkan transaksi?" data-toogle="tooltip" title="Hapus transaksi">
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </a> 
                      </div>
                      </div>
                        </div>
                    </div>
                       </form>

                        <div class="col-md-12">
                        <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
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
                        if($result>0)
                        {
                          foreach ($result as $row)
                          {
                          ?>
                           <tr>
                            <td><?php echo $row->no_tr_grey; ?></td>
                            <td><?php echo $row->nm_kain;?></td>
                            <td><?php echo $row->gramasi;?></td>
                            <td><?php echo $row->setting;?></td>
                            <td><?php echo $row->nm_warna;?></td>
                            <td><?php echo $row->kg_fin;?></td>
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
                        </table>
                        
                      </div>
                    </div>

                       <form action="<?php echo base_url('Penerimaan_kainjadi/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                      <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nomor Transaksi</label>
                                  <br/>
                                   <input class="form-control" id="no_mobil" type="text" name="no_mobil" placeholder="Diisi" value="<?php echo $no_jual;?>" readonly>
                                </div>
                              </div>
                              <br/><br/><br/><br/>             
                               <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nomor Mobil</label>
                                  <br/>
                                   <input class="form-control" id="no_mobil" type="text" name="no_mobil" placeholder="Diisi" value="" required>
                                </div>
                              </div>
                              <br/><br/><br/><br/>

                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nama Supir</label>
                                  <br/>
                                   <input class="form-control" id="supir" type="text" name="supir" placeholder="Diisi" value="" required>
                                </div>
                              </div>
                              <br/><br/><br/><br/>  
                            
                              <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Keterangan</label>
                                  <br/>
                                     <textarea class="form-control" id="ket" type="text" name="ket" placeholder="Diisi" value=""></textarea>
                                </div>
                              </div>
                              <br/><br/><br/><br/>

                   

                      <div class="form-group">
                        <div class="col-sm-12">
                          <br/><br/>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <a href="<?php echo base_url('Pengiriman_kainjadi/deleteListJualMasal/'); ?>" data-confirm="anda yakin ingin membatalkan transaksi?" data-toogle="tooltip" title="Hapus transaksi">
                            <button type="button" class="btn btn-danger">Cancel</button>
                             </a> 
                      </div>
                      </div>
                         </div>
                    </div>
                       </form>


                  </div>
                </div>
              


                <!-- Modal untuk tampil create partai penerimaan -->
              <form action="<?php echo base_url('Partai/createListTerima'); ?>" method="post">
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
                        <div class="form col-md-12 ">
                        <div class="form-group row">
                           <label class="control-label">Nama Subcon</label>
                                   <select  class="form-control" name="kd_subcon" id="kd_subcon">
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($result2->result() as $row) {
                                    echo "<option value='".$row->kd_subcon."'>".$row->nm_subcon."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                        </div>
                        <div class="form-group row">
                          <label class="control-label">Nomor Pengiriman</label>
                                  <br/>
                                   <select class="form-control"  name="no_tr_maklun" id="no_tr_maklun" required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                        <div class="form-group row">
                          <label class="control-label">Kode Partai</label>
                                  <br/>
                                    <select class="form-control"  name="kd_partai" id="kd_partai"  required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                        <div class="form-group row">
                           <label class="control-label">Nama Kain</label>
                                  <br/>
                                    <select class="form-control"  name="kd_kain" id="kd_kain"  required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                        <div class="form-group row">
                          <label class="control-label">Warna</label>
                                  <br/>
                                    <select class="form-control"  name="kd_warna" id="kd_warna"  required>
                                    <option value="">Pilih</option>
                                  </select>
                        </div>
                        <div class="form-group row">
                           <label class="control-label"> List Nomor Gulung</label>
                                   <div id="no_tr_grey" class="col-md-12"></div>
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
           
	
</body>
</html>

<!-- start: Javascript -->
<script src="<?php echo base_url('view/assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/jquery-1.8.3.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/script.js')?>"></script>
<script src="<?php echo base_url('asset/js/jquery-1.8.3.js')?>"></script>
<script src="<?php echo base_url('asset/js/script.js')?>"></script>


<!-- plugins -->
<script src="<?php echo base_url('view/assets/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.nicescroll.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/nouislider.min.js') ?>"></script>
<script>
	 $(function()
	  {
	   $(document).on('click', '.btn-add', function(e)
	   {
		e.preventDefault();

		var controlForm = $('.controls:first'),
		 currentEntry = $(this).parents('.entry:first'),
		 newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .btn-add')
		 .removeClass('btn-add').addClass('btn-remove')
		 .removeClass('btn-success').addClass('btn-danger')
		 .html('<span class="glyphicon glyphicon-minus"></span>');
	   }).on('click', '.btn-remove', function(e)
	   {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	   });
	  }
	 );

	</script>


  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_subcon").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_tr_maklun").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_kainjadi/listMaklun"); ?>", // Isi dengan url/path file php yang dituju
        data: {kd_subcon : $("#kd_subcon").val() }, // data yang akan dikirim ke file yang dituju
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
          $("#no_tr_maklun").html(response.list_no_tr_maklun).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>


    <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#no_tr_maklun").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kd_partai").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_kainjadi/listPartai"); ?>", // Isi dengan url/path file php yang dituju
        data: {no_tr_maklun : $("#no_tr_maklun").val() }, // data yang akan dikirim ke file yang dituju
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
          $("#kd_partai").html(response.list_partai).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>

  <!---->
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_partai").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kd_kain").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_kainjadi/listKain"); ?>", // Isi dengan url/path file php yang dituju
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
          $("#kd_kain").html(response.list_kain).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>


   <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_partai").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#no_tr_grey").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_kainjadi/listTrGrey"); ?>", // Isi dengan url/path file php yang dituju
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
          $("#no_tr_grey").html(response.list_no_tr_grey).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>

   <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
    $("#kd_kain").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kd_warna").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Penerimaan_kainjadi/listWarna"); ?>", // Isi dengan url/path file php yang dituju
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
          $("#kd_warna").html(response.list_warna).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    
  });
  </script>