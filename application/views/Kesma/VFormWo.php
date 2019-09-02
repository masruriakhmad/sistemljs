<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FORM WO</title>

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
                          Tabel  <span class="fa-angle-right fa"></span> Data Work Order
                        </h3>
                    </div>
                  </div>
              </div>
              <div class="panel-body">
                <h1>Create Work Order</h1>
              </div>

                  <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                         <form class="form-horizontal" action="<?php echo base_url('Wo/createProses'); ?>" method="post"> 
                              <div class="form-group">
                                <div class="col-sm-12">
                                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal">Isi Barang Order</button><br/>
                                </div>
                              </div>

                      <div class="table-responsive">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th >Nama Kain</th>
                          <th >Warna</th>
                          <th >Gramasi</th>
                          <th >setting</th>
                          <th >Jumlah Rol</th>
                          <th >Hapus</th>

                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total = 0;
                        if($result->num_rows()>0)
                        {
                          foreach ($result->result() as $row)
                          {
                          ?>
                           <tr>
                            <td><?php echo $row->nm_kain; ?></td>
                            <td><?php echo $row->warna; ?></td>
                            <td><?php echo $row->gramasi; ?></td>
                            <td><?php echo $row->setting; ?></td>
                            <td><?php 
                            echo $row->jml_rol; 

                            $jml_rol   = $row->jml_rol; 
                            $total    += $jml_rol;
                            ?>
                            </td>
                            <td>
                          
                             <a href="<?php echo base_url('Wo/deleteList/'.$row->id.''); ?>" data-confirm="anda yakin ingin menghapus?" data-toogle="tooltip" title="Hapus transaksi">
                             <!--  <button class=" btn btn-circle btn-mn btn-danger" value="primary"> -->
                               <span class="fa fa-trash"></span> Hapus
                              <!--</button>-->
                          </a>
                          
                            </td>
                           <input type="hidden" id="id" name="id[]" class="form-control" placeholder="Diisi" value="<?php echo $row->id; ?>"> 
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>
                          <tr>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ><B>Total</B></th>
                          <th ><?php echo $total; ?></th>
                          <th ></th>
                          </tr>
                        </table>
                        
                      </div>

                          <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nomor Work Order</label>
                                   <input class="form-control" id="no_wo" type="text" name="no_wo" placeholder="" value="<?php echo $result4;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Nama Customer</label>
                                   <select  class="form-control" name="kd_customer" id="kd_customer" /required>
                                    <option value="">--Pilih--</option>
                                  <?php
                                  foreach ($result1->result() as $row) {
                                    echo "<option value='".$row->kd_customer."'>".$row->nm_customer."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                                </div>
                              </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                  <label class="control-label">Keterangan</label>
                                   <textarea class="form-control" id="ket" type="text" name="ket" placeholder="Diisi" value=""></textarea>
                                </div>
                            </div>





                    <input class="submit btn btn-primary" type="submit" value="Simpan">  
                    
          <a href="<?php echo base_url('Wo/deleteAllList/'.''); ?>" data-confirm="Batalkan Transaksi ini?" data-toogle="tooltip" title="Hapus transaksi">
                   <button type="button" class="btn btn-danger">Cancel</button>
                    </a>   
                      

                  </form>

                </div>
              </div>

              <!-- Modal Add New Package-->
              <form action="<?php echo base_url('Wo/createListWo'); ?>" method="post">
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
                        <label class="col-sm-2 col-form-label">Jenis Benang</label>
                        <div class="col-sm-10">
                                   <select  class="form-control" name="kd_kain" id="kd_kain" required>
                                    <option value="">--Pilih--</option>
                                    <?php
                                  foreach ($result2->result() as $row) {
                                    echo "<option value='".$row->kd_kain."'>".$row->nm_kain."</option>";
                                  }    
                                ?>
                                <?php
                                 echo "</select>"; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Warna</label>
                        <div class="col-sm-10">
                          <input type="text" id="kd_warna" name="kd_warna" class="form-control" placeholder="Diisi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Gramasi</label>
                        <div class="col-sm-10">
                          <input type="text" id="gramasi" name="gramasi" class="form-control" placeholder="Diisi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Setting</label>
                        <div class="col-sm-10">
                          <input type="text" id="setting" name="setting" class="form-control" placeholder="Diisi" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Jumlah Rol</label>
                        <div class="col-sm-10">
                          <input type="text" id=jml_rol name="jml_rol" class="form-control" placeholder="Diisi" required>
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
  <!-- plugins -->
  
  <script src="<?php echo base_url('assets/js/plugins/jquery.datatables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/datatables.bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll.js'); ?>"></script>
  <!--Load JavaScript File-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.bootstrap-select').selectpicker();
    });

    function copytextbox() {
    document.getElementById('no_tr_maklun').value = document.getElementById('no_tr_maklun1').value;
    }
  </script>
</body>
</html>