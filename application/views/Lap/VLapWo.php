<!DOCTYPE html>
<html lang="en">
<head>
<style >
@page { 
  margin: 25px 20px 20px 20px; 
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
                      <p align="center" font-size="14"> <b>Work Order</b></p>
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
                        <td>No. Transaksi</td>
                        <td>:</td>
                        <td><b><?php echo $result->no_wo; ?></b></td>
                        <td width="100px">   </td>
                        <td>Pelanggan</td>
                        <td>:</td>
                        <td><?php echo $result->nm_customer; ?></td>
                        </tr>
                        <!-- baris kedua-->
                        <tr>
                        <td>Tgl.</td>
                        <td>:</td>
                        <td ><?php echo $result->tgl; ?></td>
                        <td></td>
                        <td>Dibuat Oleh</td>
                        <td>:</td>
                        <td ><?php echo $result->nm_user; ?></td>
                        </tr>
                    
                        </table>
                 
                  </div>    
                <div class="col-md-12">
                   
                      <div class="table-responsive">
                      <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0" border="1">
                      <thead>
                        <tr>
                       
                          <th class="col-sm-1">No.</th>
                          <th >Nama Kain</th>
                          <th >Gramasi</th>
                          <th >Setting</th>
                          <th >Warna</th>
                          <th class="col-sm-2">Jumlah Rol</th>
                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total = 0;
                        foreach($detail AS $row){
                          ?>
                           <tr>
                            <td><?php echo $no; ?> </td>
                            <td><?php echo $row->nm_kain; ?> </td>
                            <td><?php echo $row->gramasi; ?> </td>
                            <td><?php echo $row->setting; ?> </td>
                            <td><?php echo $row->warna; ?> </td>
                            <td>
                              <?php 
                              echo $row->jml_rol; 
                              $total +=$row->jml_rol
                              ?> 
                            </td>
                          </tr>

                          <?php $no++;
                        }
                      ?>
                        <tr>
                            <td colspan="5"><b>Total</b></td> 
                            <td><b><?php echo $total; ?></b></td>
                          </tr>
                        </table>
                        
                      </div>
                      <b><i> Nb : <?php echo $result->ket; ?> </i></b>
                        <div class="col-md-12">
                            <table>
                              <thead>
                              <tr>
                                <td width="240px">Admin</td>
                                <td width="240px">Pelanggan</td>
                                <td width="240px">Mengetahui,</td>
                              </tr>
                            </thead>
                              <tr>
                                <td><br><br></td>
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
</html>