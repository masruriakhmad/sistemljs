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
                      <p align="center" font-size="14"> <b>BUKTI PENERIMAAN BENANG</b></p>
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
                        <td><b><?php echo $result->no_tr_benang; ?></b></td>
                        <td width="100px">  </td>
                        <td>Vendor</td>
                        <td>:</td>
                        <td><?php echo $result->nm_vendor; ?></td>
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
                       
                          <th width="500px">Jenis Benang</th>
                          <th width="100px">Jumlah (Bale)</th>
                          <th width="100px">Kg</th>
                        </tr>
                      </thead>
                           <tr height="50px">
                            <td>
                              <br>
                              <?php echo $result->jenis_benang; ?>
                                <br><br>
                              </td>
                            <td><br>
                              <?php echo $result->jumlah; 


                              ?>  <br><br>
                              </td>
                             <td><br><?php echo number_format($result->jumlah*181.44,2); ?><br><br></td>
                          </tr>
                        <tr>
                            <td><b>Total</b></td> 
                            <td><b><?php echo $result->jumlah; ?></b></td>
                            <td><b><?php echo number_format($result->jumlah*181.44,2) ?></b></td>  
                          </tr>
                        </table>
                        <b><i>NB : <?php echo $result->ket; ?></i></b>
                      </div>
                        <div class="col-md-12">
                            <table>
                              <thead>
                              <tr>
                                <td width="240px">Penerima</td>
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
                                <td><br><br></td>
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