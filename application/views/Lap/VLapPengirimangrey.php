<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Pengiriman Grey</title>
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

<body>
                  
                      <b font-size="11">CV. Langgeng Jaya Santoso</b><br>
                      Jalan Soekarno Hatta No. 16 Magelang
                      <hr>
                      <p align="center" font-size="11"> <b>SURAT JALAN</b></p>
                  <div class="col-md-12" align="right">
                        <b>
                        Magelang,
                        <?php echo date('d-m-Y'); ?>
                      </b>
                  </div>
                  <div class="col-md-12">
                     <table cellpading="1">
                        <!-- baris pertama-->
                        <tr>
                        <td>No. Pengiriman</td>
                        <td>:</td>
                        <td><b><?php echo $detail->no_tr_maklun; ?></b></td>
                        <td width="130px">           </td>
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
                        <td ></td>
                        <td>Supir</td>
                        <td>:</td>
                        <td ><?php echo $detail->nm_supir; ?></td>
                        </tr>
                    </table>
                  </div>    
                <div class="col-md-12">
                   
                      <div class="table-responsive">
                      <table  width="100%" cellspacing="0" cellpading="2" border="1">
                      <thead>
                        <tr>
                          <th width="17%" align="center">No. Partai</th>
                          <th align="center">Nama Kain</th>
                          <th width="15%" align="center">Jumlah Rol</th>
                          <th width="10%" align="center">Kg</th>
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        $total_rol = 0;
                        $total_kg = 0;
                        foreach($partai->result() AS $row){
                          ?>
                           <tr>
                            <td align="center" ><?php echo $row->kd_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi; ?></p></td>  
                            <td  align="center" >
                              <?php 
                              echo $row->jumlah_rol; 
                              $total_rol += $row->jumlah_rol;
                              ?>
                            </td>
                            <td align="center">
                               <?php echo number_format($row->jumlah_kg_grey,2); 
                               $total_kg += $row->jumlah_kg_grey;
                              ?>
                            </td>
                          </tr>
                          <?php $no++;
                        }
                      ?>
                        <tr>
                            <td align="center" colspan="2"><b>Total</b></td>
                            <td  align="center" ><b><?php echo $total_rol; ?></b></td> 
                            <td  align="center" ><b><?php echo number_format($total_kg,2); ?></b></td>
                        </tr>
                        </table>
                      </div>
                      <p><b><i>NB : <?php echo $detail->ket; ?></i></b></p>
                        <div class="col-md-12">
                            <table>
                              <thead>
                              <tr>
                                <td width="240px">   Penerima</td>
                                <td align="center" width="240px">Supir</td>
                                <td align="center" width="240px">Mengetahui,</td>
                              </tr>
                            </thead>
                              <tr>
                                <td> <br><br></td>
                                <td> </td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>(.........................)</td>
                                <td align="center">(.........................)</td>
                                <td align="center">(.........................)</td>
                              </tr>
                            </table>

                        </div>
                  
                </div>     
         
</body>            
</html>