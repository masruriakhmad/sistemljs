<!DOCTYPE html>
<html lang="en">
<head>
<style >
@page { 
  margin: 20px 20px 20px 20px; 
  font-family: "Helvetica";
  font-size: 12px; 
}
body { 
  font-family:"Helvetica";
  font-size: 12px;  
}
</style>


</head>

<body id="" class="dashboard" >
 <div class="col-md-12">      
               
                   <b font-size="11">CV. Langgeng Jaya Santoso</b><br>
                      Jalan Soekarno Hatta No. 16 Magelang
                      <hr>
                      <p align="center" font-size="14"> <b>Bukti Penerimaan Benang</b></p>
                    </p>

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
                        <td><b><?php echo $detail->no_tr_benang; ?></b></td>
                        <td></td>
                        <td>Tujuan</td>
                        <td>:</td>
                        <td><?php echo $detail->nm_vendor; ?></td>
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
                      <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0" border="1">
                      <thead>
                        <tr>
                       
                          <th class="col-sm-1">No.</th>
                          <th >Jenis Benang</th>
                          <th class="col-sm-1">Jumlah Bale</th>
                          <th class="col-sm-2">Kg</th>
                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total_jumlah = 0;
                        $total_kg = 0;
                        foreach($partai->result() AS $row){
                          ?>
                           <tr>
                            <td><?php echo $row->no_tr_benang; ?></td>
                            <td><p><?php echo $row->jenis_benang; ?></p></td>
                            <td>
                              <?php echo $jumlah=$row->jumlah; 
                                $total_jumlah += $jumlah;
                              ?>
                              
                            </td>
                            <td>
                               <?php 
                              echo number_format($kg=$row->jumlah*181.44,2); 
                              $total_kg += $kg;
                              ?>

                            </td>  
                          </tr>

                          <?php $no++;
                        }
                      ?>
                        <tr>
                            <td colspan="2"><b>Total</b></td> 
                            <td><b><?php echo $total_jumlah; ?></b></td>
                            <td><b><?php echo number_format($total_kg,2); ?></b></td>
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