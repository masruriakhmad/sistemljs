<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pengiriman Grey</title>

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

</head>

<body id="" class="dashboard" > 
 <div class="col-md-12">      
            
                  <div class="header col-md-12">
                    <br>
                    <p>
                      <!--
                      <h3>CV. Langgeng Jaya Santoso</h3>
                      Jalan Soekarno Hatta No. 16 Magelang
                    
                      _________________________________________________________________________________________
                    -->
                      <p align="center" font-size="14"> <h4><b>Detail Packing List</b></h4></p>
                    </p>
                   
                  </div>

                  <div class="col-md-12" align="right">
                        <b>
                        Magelang,
                        <?php echo date('d-m-Y'); ?>
                      </b>
                     
                  
                  </div>
                  <div class="col-md-12">
                     <table>
                      
                        
                    
                        <!-- baris pertama-->
                        <tr>
                        <td>No. Penerimaan</td>
                        <td>:</td>
                        <td><b><?php echo $detail->no_tr_kainjadi; ?></b></td>
                        <td></td>
                        <td>Asal</td>
                        <td>:</td>
                        <td><?php echo $detail->nm_subcon; ?></td>
                        </tr>
                 
                  </div>    
              
                <div class="col-md-12">
                   
                     <!-- <div class="table-responsive">-->
                      <table  class="table table-bordered" width="100%" cellspacing="0" border="5">
                      <thead>
                        <tr>
                       
                          <th class="col-sm-1">No. Partai</th>
                          <th class="col-sm-1">Nama Kain</th>
                          <th >Nomor Gulung</th>
                          <th >Kg</th>
                          <th class="col-sm-2">Jumlah Rol</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $no = 1;
                        $total_kg = 0;
                        $total_rol = 0;
                        foreach($partai->result() AS $row){
                          ?>
                          
                           <tr>
                            <td><?php echo $row->kd_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi; ?></p></td> 
                            <td>
                              <?php 
                              $data=explode(',',$row->list_grey); 
                                foreach($data AS $x)
                                {
                                  echo $x;
                                  echo "<br>";
                                }
                                ?>
                              </td> 
                              <td>
                              <?php
                               $data_kg=explode(',',$row->list_kg); 
                                foreach($data_kg AS $kg)
                                {
                                  echo $kg;
                                  echo "<br>";
                                } 
                              $total_kg += $row->jumlah_kg;
                              ?>
                            </td>
                            <td>
                              <?php 
                              echo $row->jumlah_rol; 
                              $total_rol += $row->jumlah_rol;
                              ?>
                            </td>

                          </tr>
                             
                          <?php $no++;
                        }
                      ?>
                       
                        <tr>
                            <td colspan="3" align="center"><b>Total</b></td>
                            <td> <b><?php echo $total_kg; ?></b></td> 
                            <td> <b><?php echo $total_rol; ?></b></td>
                          </tr>
                        </tbody>
                        </table>
                        
                      </div>
                        <div class="col-md-12">
                    <!--    </div> -->
                  
                </div>
            
 </div>
     
</body>            


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

  </script>
</body>
</html>