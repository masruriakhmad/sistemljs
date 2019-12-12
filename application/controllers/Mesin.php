<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mesin extends CI_Controller {

 function __construct()

 {
   parent::__construct();

   $this->load->helper('url');

   $this->load->model('MMesin');

   $this->load->model('MProduksi');

   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');

 }

//fungsi tampilan index 
function index(){

   $data['result']     = $this->MMesin->readMesin();

   $data['kd_mesin']   = $this->MMesin->getKd_mesin();

   $this->load->view('Kesma/VMesin', $data);
   
 }

//fungsi untuk link tampilan input
 function create(){

  $this->load->view('kesma/VFormMesin');
 
 }

//fungsi untuk proses input record
 function createProses(){
 
  $kd_mesin          = $this->MMesin->getKd_mesin();
 
  $no_mesin          = $this->input->post('no_mesin');
 
  $merk              = $this->input->post('merk');
 
  $trak              = $this->input->post('trak');
 
  $no_seri           = $this->input->post('no_seri');
 
  $tahun             = $this->input->post('tahun');
 
  $diameter          = $this->input->post('diameter');
 
  $gauge             = $this->input->post('gauge');
 
  $feeder            = $this->input->post('feeder');
 
  $jml_jarum         = $this->input->post('jml_jarum');

  $data              = array(

      'kd_mesin'     =>$kd_mesin,
 
      'no_mesin'     =>$no_mesin,
 
      'merk'         =>$merk,
 
      'trak'         =>$trak,
 
      'no_seri'      =>$no_seri,
 
      'tahun'        =>$tahun,
 
      'diameter'     =>$diameter,
 
      'gauge'        =>$gauge,
 
      'feeder'       =>$feeder,
 
      'jml_jarum'    =>$jml_jarum,

    );
  
  $insert      = $this->MMesin->createMesin($data);

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Mesin')); 

 }

//untuk menampilkan data yang akan diedit
 function edit($kd_mesin){

  $this->db->where('kd_mesin', $kd_mesin);

  $query = $this->db->get('mesin_tb');

  $this->data['edit'] = $query->row_array();

  $this->load->view('Kesma/VFormeditmesin', $this->data);

 }

 //proses update data ke database
 function update(){

  $kd_mesin       = $this->input->post('kd_mesin');

  $no_mesin       = $this->input->post('no_mesin');

  $merk           = $this->input->post('merk');

  $trak           = $this->input->post('trak');

  $no_seri        = $this->input->post('no_seri');

  $tahun          = $this->input->post('tahun');

  $diameter       = $this->input->post('diameter');

  $gauge          = $this->input->post('gauge');

  $feeder         = $this->input->post('feeder');

  $jml_jarum      = $this->input->post('jml_jarum');

  //fungsi untuk update record
  $data = array(

      'kd_mesin'  =>$kd_mesin,

      'no_mesin'  =>$no_mesin,

      'merk'      =>$merk,

      'trak'      =>$trak,

      'no_seri'   =>$no_seri,

      'tahun'     =>$tahun,

      'diameter'  =>$diameter,

      'gauge'     =>$gauge,

      'feeder'    =>$feeder,

      'jml_jarum' =>$jml_jarum

    );

  $update = $this->MMesin->updateMesin($kd_mesin, 'mesin_tb', $data);

  if($update){

    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('Mesin'));

  }else{

    echo "Gagal";

  }

 }

//fungsi untuk menghapus record
  function delete($kd_mesin){

  $this->db->delete('kd_mesin', array('kd_mesin'=>$kd_mesin));

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('Mesin'));

 }

 function kinerjaMesin(){

  //dalam satu satuan waktu mesin memasukkan benang berapa dan mengeluarkan brp rol dan berapa kg
  //variabel
  //tgl awal dan tgl akhir
 // $data['result'] = $this->MMesin->readMesin();

  $data['result'] = $this->MMesin->getKinerjaMesin();

  $this->load->view('Kesma/VKinerjaMesin', $data);

 }

function filterKinerjaMesin(){

  $tglawal= $this->input->post('tglawal');

  $tglakhir= $this->input->post('tglakhir');

  $key    =array(

    'produksi_tb.tgl >='=> $tglawal,

    'produksi_tb.tgl <='=> $tglakhir,

  );

  $data['result'] = $this->MMesin->getKinerjaMesin($key);

  $this->session->set_flashdata('tglAwal',$tglawal);

  $this->session->set_flashdata('tglAkhir',$tglakhir);

  $this->load->view('Kesma/VKinerjaMesin', $data);

 }


   //fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MMesin->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Vendor');

      $object->getActiveSheet()->setTitle('Data Master Vendor');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $mesin_data = $this->MMesin->readMesin()->result();

      $excel_row = 3;

      foreach($mesin_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_mesin);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->no_mesin);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->merk);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->trak);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->no_seri);

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->tahun);

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->diameter);

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->gauge);

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->feeder);

        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->jml_jarum);

        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->kd_benang);

        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->status_mesin);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-mesin.xls"');

      $object_writer->save('php://output');

    }

     //fungsi untuk proses import excel
 function import(){

  if(isset($_FILES["file"]["name"])){

      $path = $_FILES["file"]["tmp_name"];

      //object baru dari php excel
      $object = PHPExcel_IOFactory::load($path);

      //perulangan untuk membaca file excel
      foreach($object->getWorksheetIterator() as $worksheet){
        //row tertinggi
        $highestRow     = $worksheet->getHighestRow();
        //colom tertinggi
        $highestColumn  
        = $worksheet->getHighestColumn();

        for($row=3; $row<=$highestRow; $row++){
          //baca data dari excel berdasar matrik kolom dan baris (kolom,baris)
           $kd_mesin    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $no_mesin    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $merk        = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $trak        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

           $no_seri     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $tahun       = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

           $diameter    = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

           $gauge       = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

           $feeder      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

           $jml_jarum   = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

           $kd_benang   = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

           $status_mesin= $worksheet->getCellByColumnAndRow(11, $row)->getValue();

           $data[] = array(

            'kd_mesin'       => $kd_mesin,

            'no_mesin'       => $no_mesin,
            
            'merk'           => $merk,

            'trak'           => $trak,

            'no_seri'        => $no_seri,
            
            'tahun'          => $tahun,

            'diameter'       => $diameter,

            'gauge'          => $gauge,
            
            'feeder'         => $feeder,

            'jml_jarum'      => $jml_jarum,

            'kd_benang'      => $kd_benang,
            
            'status_mesin'   => $status_mesin


           );

        }

      }

      $this->MMesin->insertMesin($data);

    }

  }


}

?>