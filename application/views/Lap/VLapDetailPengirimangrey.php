<!DOCTYPE html>
<html lang="en">
<head>
<style >
body {
  padding:0px;
  font:12px/1.5 Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
  color:#00000;
  font-weight:300;
}

h1, h2, h3, h4, h5, h6 {
  color:#222;
  margin:0 0 20px;
}

p, ul, ol, table, pre, dl {
  margin:0 0 20px;
}

h1, h2, h3 {
  line-height:1.1;
}

h1 {
  font-size:28px;
}

h2 {
  color:#393939;
}

h3, h4, h5, h6 {
  color:#494949;
}

a {
  color:#39c;
  font-weight:400;
  text-decoration:none;
}

a small {
  font-size:11px;
  color:#777;
  margin-top:-0.6em;
  display:block;
}

.wrapper {
  width:860px;
  margin:0 auto;
}

blockquote {
  border-left:1px solid #e5e5e5;
  margin:0;
  padding:0 0 0 20px;
  font-style:italic;
}

code, pre {
  font-family:Monaco, Bitstream Vera Sans Mono, Lucida Console, Terminal;
  color:#333;
  font-size:12px;
}

pre {
  padding:8px 15px;
  background: #f8f8f8;  
  border-radius:5px;
  border:1px solid #e5e5e5;
  overflow-x: auto;
}

table {
  width:100%;
  border-collapse:collapse;
}

th, td {
  text-align:left;
  padding:0px 10px;
  border-bottom:0px solid #e5e5e5;
}

dt {
  color:#444;
  font-weight:700;
}

th {
  color:#444;
}

img {
  max-width:100%;
}

header {
  width:270px;
  float:left;
  position:fixed;
}

header ul {
  list-style:none;
  height:40px;
  
  padding:0;
  
  background: #eee;
  background: -moz-linear-gradient(top, #f8f8f8 0%, #dddddd 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f8f8f8), color-stop(100%,#dddddd));
  background: -webkit-linear-gradient(top, #f8f8f8 0%,#dddddd 100%);
  background: -o-linear-gradient(top, #f8f8f8 0%,#dddddd 100%);
  background: -ms-linear-gradient(top, #f8f8f8 0%,#dddddd 100%);
  background: linear-gradient(top, #f8f8f8 0%,#dddddd 100%);
  
  border-radius:5px;
  border:1px solid #d2d2d2;
  box-shadow:inset #fff 0 1px 0, inset rgba(0,0,0,0.03) 0 -1px 0;
  width:270px;
}

header li {
  width:89px;
  float:left;
  border-right:1px solid #d2d2d2;
  height:40px;
}

header ul a {
  line-height:1;
  font-size:11px;
  color:#999;
  display:block;
  text-align:center;
  padding-top:6px;
  height:40px;
}

strong {
  color:#222;
  font-weight:700;
}

header ul li + li {
  width:88px;
  border-left:1px solid #fff;
}

header ul li + li + li {
  border-right:none;
  width:89px;
}

header ul a strong {
  font-size:14px;
  display:block;
  color:#222;
}

section {
  width:500px;
  float:right;
  padding-bottom:50px;
}

small {
  font-size:11px;
}

hr {
  border:0;
  background:#e5e5e5;
  height:1px;
  margin:0 0 20px;
}

footer {
  width:270px;
  float:left;
  position:fixed;
  bottom:50px;
}

@media print, screen and (max-width: 960px) {
  
  div.wrapper {
    width:auto;
    margin:0;
  }
  
  header, section, footer {
    float:none;
    position:static;
    width:auto;
  }
  
  header {
    padding-right:320px;
  }
  
  section {
    border:1px solid #e5e5e5;
    border-width:1px 0;
    padding:20px 0;
    margin:0 0 20px;
  }
  
  header a small {
    display:inline;
  }
  
  header ul {
    position:absolute;
    right:50px;
    top:52px;
  }
}

@media print, screen and (max-width: 720px) {
  body {
    word-wrap:break-word;
  }
  
  header {
    padding:0;
  }
  
  header ul, header p.view {
    position:static;
  }
  
  pre, code {
    word-wrap:normal;
  }
}

@media print, screen and (max-width: 480px) {
  body {
    padding:15px;
  }
  
  header ul {
    display:none;
  }
}

@media print {
  body {
    padding:0.4in;
    font-size:12pt;
    color:#444;
  }
}
</style>


</head>

<body id="" class="dashboard" > 
 <div class="col-md-12">      
             <b font-size="14">CV. Langgeng Jaya Santoso</b><br><br>
                      Jalan Soekarno Hatta No. 16 Magelang
                      <hr>
                      <p align="center" font-size="14"> <h4><b>Detail Packing List</b></p>
                    </p>

                  <div class="col-md-12" align="right">
                        <b>
                        Magelang,
                        <?php echo date('d-m-Y'); ?>
                      </b>
                     
                  
                  </div>
                  
                     <table >
                      
                        <!-- baris pertama-->
                        <tr>
                        <td>No. Pengiriman</td>
                        <td>:</td>
                        <td><b><?php echo $detail->no_tr_maklun; ?></b></td>
                        <td width="150px">       </td>
                        <td>Tujuan</td>
                        <td>:</td>
                        <td><?php echo $detail->nm_subcon; ?></td>
                        </tr>

                      </table>                 
                     
              
                
                   
                     <!-- <div class="table-responsive">-->
                      <table  class="table table-bordered" width="100%" cellspacing="0" border="2"  >
                      <thead>
                        <tr>
                       
                          <th  align="center" class="col-sm-1">No. Partai</th>
                          <th  align="center"  class="col-sm-1">Nama Kain</th>
                          <th  align="center" >Nomor Gulung</th>
                          <th  align="center" class="col-sm-2">Jumlah Rol</th>
                          <th  align="center" >Kg</th>
                        
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
                            <td align="center" ><?php echo $row->kd_partai; ?></td>
                            <td><p><?php echo $row->nm_kain.' Gramasi '.$row->gramasi; ?></p></td> 
                            <td align="center" >
                              <?php 
                              $data=explode(',',$row->list_grey); 
                                foreach($data AS $x)
                                {
                                  echo $x;
                                  echo "<br>";
                                }
                                ?>
                              </td>
                            <td align="center" >
                              <?php 
                              echo $row->jumlah_rol; 
                              $total_rol += $row->jumlah_rol;
                              ?>
                            </td> 
                              <td align="center" >
                              <?php
                               $data_kg=explode(',',$row->list_kg_grey); 
                                foreach($data_kg AS $kg)
                                {
                                  echo $kg;
                                  echo "<br>";
                                } 
                              $total_kg += $row->jumlah_kg_grey;
                              ?>
                            </td>

                          </tr>
                             
                          <?php $no++;
                        }
                      ?>
                       
                        <tr>
                            <td colspan="3" align="center"><b>Total</b></td> 
                            <td align="center" > <b><?php echo $total_rol; ?></b></td>
                            <td align="center" > <b><?php echo number_format($total_kg,2); ?></b></td>
                          </tr>
                        </tbody>
                        </table>
                        
                    
                    <!--    </div> -->
                  
               
            
 </div>         
</body>
</html>