<!DOCTYPE html>
<html lang="en"> 
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Penerimaan Benang</title>

  <!-- start: Css -->
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
        var jumlah=document.forms["myform"]["jumlah"].value;
        
//        membuat variabel numbers bernilai angka 0 s/d 9
        var numbers=/^[0-9]+$/;
        
//        validasi nip tidak boleh kosong (required)
        if (jumh==null || jumh=="")
          {
          alert("Jumlah tidak boleh kosong !");
          return false;
          };

        if (!jumh.match(numbers))
          {
          alert("Jumlah harus angka  !");
          return false;
          };



//        ...
     }

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
                      <!---->
                      <h3 class="animated fadeInLeft">
                          Form <span class="fa-angle-right fa"></span> Form Data Penggunaan Jarum
                        </h3>
                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th class="col-md-1">Kode Penggunaan</th>
                          <th >Nama Jarum</th>
                          <th >Jumlah</th>
                          <th >Kode Mesin</th>
                                                
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total=0;
                        
                        if($list_transaksi->num_rows()>0)
                        {
                          foreach ($list_transaksi->result() as $row)
                          {
                          ?>
                           <tr>
                            <td>
                              
                              <?php echo $row->no_tr_pakaijarum; ?>
                              
                            </td>
                            <td><?php echo $row->nm_jarum; ?></td>
                            <td>
                              <?php echo $row->subjumlah; 
                                    $total +=$row->subjumlah;
                              ?>
                            </td>
                            <td>
                              <?php echo $row->kd_mesin; 
                                    
                              ?>
                            </td>
                            
                          </tr>
                        

                          <?php $no++;
                        }
                      }
                      ?>
                         <tr>
                          <th colspan="2"><B>Total</B></th>
                          <th ><?php echo $total; ?></th>
                          <th > </th>
                          
                          </tr>
                        </table>
                        
                      </div>
                      <!---->
                    <form action="<?php echo base_url('PenggunaanJarum/createProses'); ?>" id="myform" onSubmit="return validasi()"autocomplete="on" method="POST">
                        
                    </div>
                  <div class="col-md-10">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading">
                      <h4>Tambah Data Penggunaan Jarum</h4>
                    </div>

                      
                    <!-- -->
                    <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                         <!--<form action="" class="form-horizontal"> -->                           
                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">No. Penggunaan</label> <br>
                                  <input class="form-control" id="no_tr_pakaijarum" type="text" name="no_tr_pakaijarum" placeholder="" value="<?php echo $no_tr_pakaijarum;?>" readonly>  

                                </div>
                              </div>
                              <br/><br/> <br/><br/>


                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nama Jarum</label> <br>
                                  <select class="selectpicker" data-live-search="true" name="kd_jarum" id="kd_jarum" required>
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($result1->result() as $row) {
                                    echo "<option value='".$row->kd_jarum."'>".$row->Merek_jarum.' '.$row->nm_jarum."</option>";
                                  }    
                                

                                 echo "</select>"; ?>

                                </div>
                              </div>
                              <br/><br/> <br/><br/>

                              

                             <!-- <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Nama Gudang</label>
                                  <select  name="kd_gudang" id="kd_vendor" required>
                                    <option value="G001">GUDANG BENANG</option>
                                  <?php
                                  //foreach ($result3->result() as $row) {
                                   // echo "<option value='".$row->kd_gudang."'>".$row->nm_gudang."</option>";
                                  //}    
                                ?>
                                <?php
                                 //echo "</select>"; ?>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>

                               <div class="form-group">
                                <div class="col-sm-2">
                                  <label class="control-label">Kode User</label>
                                  <input class="form-control" id="kd_user" type="text" name="kd_user" placeholder="Diisi ">
                                </div>
                              </div>
                              <br/><br/> <br/><br/> -->

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Jumlah </label>
                                  <input class="form-control" id="jumlah" type="text" name="jumlah" placeholder="Diisi"  required>
                                </div>
                              </div>
                              <br/><br/> 
                              <br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Mesin </label> <br>
                                  <select class="selectpicker" data-live-search="true" name="kd_mesin" id="kd_mesin" required>
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($result2->result() as $row) {
                                    echo "<option value='".$row->kd_mesin."'>".$row->no_mesin."</option>";
                                  }    
                                
                                 echo "</select>"; ?>
                                </div>
                              </div>
                              <br/><br/> 
                              <br/><br/>

                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label class="control-label">Pengguna</label> <br>
                                  <input class="form-control" id="pengguna" type="text" name="pengguna" placeholder="Diisi">  

                                </div>
                              </div>
                              <br/><br/> <br/><br/>

                              <div class="form-group">
                                <div class="col-sm-10">
                                  <label class="control-label">Keterangan</label>
                                  <textarea class="form-control" id="ket" type="text" name="ket" placeholder="Diisi "></textarea>
                                </div>
                              </div>
                              <br/><br/> <br/><br/>
                            <div class="col-md-12">
                              <input class="submit btn btn-danger" type="submit" value="Tambah">
                              <a href="<?php echo base_url('PenggunaanJarum'); ?>">
                              <button type="button" class="btn  btn-warning">Simpan</button>
                              </a>
                           </div>
                  </form>
                </div>
              </div>
            </div>
          <!-- end: content -->
      </div>


<!-- start: Javascript -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/number-validation.js')?>"></script>
<!-- plugins -->


<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.validate.min.js'); ?> />"></script>
<script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>


<!-- custom -->


<!-- end: Javascript -->
</body>
</html>
