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
                      <p align="center" font-size="14"> <h4><b>Detail Packing List</b></h4></p>
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
                        <td><b><?php echo $detail->no_tr_kainjadi; ?></b></td>
                        <td width="100px">  </td>
                        <td>Asal</td>
                        <td>:</td>
                        <td><b><?php echo $detail->nm_subcon; ?></b></td>
                        </tr>
                 
                  </div>    
              
                <div class="col-md-12">
                   
                     <!-- <div class="table-responsive">-->
                      <table  class="table table-bordered" width="100%" cellspacing="0" border="2">
                      <thead>
                        <tr>
                       
                          <th class="col-sm-1">No. Partai</th>
                          <th class="col-sm-1">Nama Kain</th>
                          <th >Nomor Gulung</th>
                          <th class="col-sm-2">Jumlah Rol</th>
                          <th >Kg</th>
                          <th > Subtotal Kg</th>
                          
                        
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
                            <td><?php echo $row->no_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi.'  '.$row->gramasi.' Setting '.$row->setting.'"<br> W/'.$row->nm_warna; ?></p></td> 
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
                              echo $row->jumlah_rol; 
                              $total_rol += $row->jumlah_rol;
                              ?>
                            </td>
                              <td>
                              <?php
                               $data_kg=explode(',',$row->list_kg); 
                                foreach($data_kg AS $kg)
                                {
                                  echo number_format($kg,2);
                                  echo "<br>";
                                } 
                              $total_kg += $row->jumlah_kg;
                              ?>
                            </td>
                            <td ><?php echo number_format($row->jumlah_kg,2);?></td>
                          </tr>
                          <?php $no++;
                        }
                      ?>
                       
                        <tr>
                            <td colspan="3" align="center"><b>Total</b></td>
                            <td> <b><?php echo $total_rol; ?></b></td>
                            <td></td>
                            <td> <b><?php echo number_format($total_kg,2); ?></b></td> 
                          </tr>
                        </tbody>
                        </table>
                        
                      </div>
                        <div class="col-md-12">
                    <!--    </div> -->
                  
                </div>
            
 </div>
</body>
</html>