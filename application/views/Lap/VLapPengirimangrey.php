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
                      <h3>CV. Langgeng Jaya Santoso</h3>
                      Jalan Soekarno Hatta No. 16 Magelang
                      _________________________________________________________________________________________
                      <p align="center" font-size="14"> <b>SURAT JALAN</b></p>
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
                        <td>No. Pengiriman</td>
                        <td>:</td>
                        <td><b><?php echo $detail->no_tr_maklun; ?></b></td>
                        <td></td>
                        <td>Tujuan</td>
                        <td>:</td>
                        <td><?php echo $detail->nm_subcon; ?></td>
                        </tr>
                        <!-- baris kedua-->
                        <tr>
                        <td>Tgl.</td>
                        <td>:</td>
                        <td ><?php echo $detail->tgl; ?></td>
                        <td></td>
                        <td>Nomor Kendaraan</td>
                        <td>:</td>
                        <td ><?php echo $detail->no_mobil; ?></td>
                        </tr>
                        <!-- baris ketiga-->
                        <tr>
                        <td>Dibuat Oleh</td>
                        <td>:</td>
                        <td ><?php echo $detail->nm_user; ?></td>
                        <td></td>
                        <td>Supir</td>
                        <td>:</td>
                        <td ><?php echo $detail->nm_supir; ?></td>
                        </tr>
                        </table>
                 
                  </div>    
              
                <div class="col-md-12">
                   
                      <div class="table-responsive">
                      <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                       
                          <th class="col-sm-1">No. Partai</th>
                          <th >Nama Kain</th>
                          <th class="col-sm-1">Kg</th>
                          <th class="col-sm-2">Jumlah Rol</th>
                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total_rol = 0;
                        $total_kg = 0;
                        foreach($partai->result() AS $row){
                          ?>
                           <tr>
                            <td><?php echo $row->kd_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi; ?></p></td>
                            <td>
                               <?php 
                              echo $row->jumlah_kg; 
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
                            <td colspan="2"><b>Total</b></td> 
                            <td><b><?php echo $total_kg; ?></b></td>
                            <td><b><?php echo $total_rol; ?></b></td>
                          </tr>
                        </table>
                        
                      </div>
                        <div class="col-md-12">
                            <table>
                              <thead>
                              <tr>
                                <td width="240px">Pengirim</td>
                                <td width="240px">Supir</td>
                                <td width="240px">Mengetahui,</td>
                              </tr>
                            </thead>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>(.........................)</td>
                                <td>(.........................)</td>
                                <td>(.........................)</td>
                              </tr>
                            </table>

                        </div>
                  
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