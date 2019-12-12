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
                      <p align="center" font-size="14"> <b>SURAT JALAN</b></p>
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
                        <td>No. Pengiriman</td>
                        <td>:</td>
                        <td><b><?php echo $detail->no_jual; ?></b></td>
                        <td  width="100px">   </td>
                        <td>Pelanggan</td>
                        <td>:</td>
                        <td><?php echo $detail->nm_customer; ?></td>
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
                        <td ><?php echo $detail->supir; ?></td>
                        </tr>
                        </table>
                 
                  </div>    
                <div class="col-md-12">
                   
                      <div class="table-responsive">
                      <table id="" class="table table-striped table-bordered" width="100%" cellspacing="0" border="1">
                      <thead>
                        <tr>
                       
                          <th  align="center" class="col-sm-1">No. Partai</th>
                          <th >Nama Kain</th>
                          <th  align="center" class="col-sm-1">Jumlah Rol</th>
                          <th  align="center" class="col-sm-1">Kg</th>
                        
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total_rol = 0;
                        $total_kg = 0;
                        foreach($partai->result() AS $row){
                          ?>
                           <tr>
                            <td align="center" ><?php echo $row->no_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi.'  '.$row->gramasi.' Setting '.$row->setting.'"<br> W/'.$row->nm_warna; ?></p></td>
                            <td align="center" >
                              <?php 
                              echo $row->jumlah_rol; 
                              $total_rol += $row->jumlah_rol;
                              ?>

                            </td>
                            <td align="center" >
                               <?php 
                              echo number_format($row->jumlah_kg,2); 
                              $total_kg += $row->jumlah_kg;
                              ?>

                            </td>  
                          </tr>

                          <?php $no++;
                        }
                      ?>
                        <tr>
                            <td colspan="2"><b>Total</b></td>
                            <td align="center"><b><?php echo $total_rol; ?></b></td> 
                            <td align="center" ><b><?php echo number_format($total_kg,2); ?></b></td>
                          </tr>
                        </table> 
                      </div>
                     <b><i> NB: <?php echo $detail->ket; ?></i></b>
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