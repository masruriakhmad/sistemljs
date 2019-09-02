<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
  body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 75mm;
        min-height: 35mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: [0, 0, 75, 35];
        margin: 0;
    }
    @media print {
        html, body {
            width: 750mm;
            height: 350mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
  </style>
</head>

<body id="page">
            <div id="page">
                      <table border="0" align="left" width="425.4681381813px" height="250.2851311513px"  cellpadding="10">
                      <?php
                        $no = 1;
                        if($result->num_rows()>0)
                        {
                          foreach ($result->result() as $row)
                          {
                          ?>
                          <tr>
                          <th align="left" width="283.4681381813px" height="195.2851311513px">
                            <?php echo $row->kd_customer."<br>".$row->nm_kain."  |  ".$row->kg_grey."  Kg"; ?><br>
                             <?php echo $row->nm_warna." -- ".$row->setting; ?><br>
                            <img src="<?php  echo base_url('Penerimaan_kainjadi/barcode/'.$row->no_tr_grey);?>" width="400.4681381813px" height="100.591503515px">
                          </th>                       
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>
                        </table>
                        
                      </div>
                 
      


        
</body>
</html>