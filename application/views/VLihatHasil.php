

<div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                   <?php echo $this->session->flashdata('notifhapus');?>

                    <!-- start: delete-->
                   <div class="row clear_fix"><div class="col-md-12" id="respose"></div></div>
                   <!-- responsiv delete -->
                    <div class="panel-heading"><h3>Hasil Perangkingan Tim Peserta PMW <?php echo $tahun;?></h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                     
 



                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0" border = '2'>
                      <thead style = "background-color :  #d6eaf8">
                        <tr>
                          <th width = "100" class="">Rangking</th>
                          <th width = "100" class="">No. Tim</th>
                          <th width = "" class="">Judul Proposal</th>
                          <th width = "100" class="">Nilai Akhir</th>
                          
                        </tr>
                      </thead>
                      <?php
                        $no = 1;
                        if($tim->num_rows()>0)
                        {
                          foreach ($tim->result() as $row)
                          {
                          ?>
                          <tr class="tbl_view" id="<?php echo $row->id_tim ?>">
                            <td class=""><?php echo $no ;?></td>
                            <td class=""><?php echo $row->no_tim; ?></td>
                            <td class=""><?php echo $row->judul_proposal; ?></td>
                            <td class=""><?php echo $row->nilai_y; ?></td>
                            
      
                          </tr>
                          <?php $no++;
                        }
                      }
                      ?>


                        </table>
                        
                      
                      </div>
                  </div>
                </div>
              </div>  
              </div>