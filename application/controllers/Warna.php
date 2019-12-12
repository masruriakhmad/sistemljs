<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warna extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   $this->load->helper('url');

   $this->load->model('MWarna');

   $this->load->model('MBenang');

   $this->load->library('session');

   $this->load->library('excel');
 }

//fungsi tampilan index 
function index(){

	 $data['result']     = $this->MWarna->readWarna();

   $data['kd_warna']   = $this->MWarna->getKd_warna();

   $this->load->view('Kesma/VWarna', $data);

 }

//fungsi untuk link tampilan input
 function create(){

  $data['result']     = $this->MBenang->readBenang();

 	$this->load->view('Kesma/VFormwarna',$data);
 
 }

 function coba(){

  echo $this->MWarna->getKd_warna();

 }

//fungsi untuk proses input record
 function createProses(){

  $this->form_validation->set_rules('nm_warna','nm_warna','required');

  if($this->form_validation->run() != false){

 	$kd_warna          = $this->MWarna->getKd_warna();

 	$nm_warna          = $this->input->post('nm_warna');

  $kd_jenis          = $this->input->post('kd_jenis');

 	$data              = array(

      'kd_warna'     =>$kd_warna,

      'nm_warna'     =>$nm_warna,

      'kd_jenis'     =>$kd_jenis

    );
 	
  $insert		   = $this->MWarna->createWarna($data);

 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Warna')); 

    }else{

  redirect(base_url('Warna/create')); 

    }
 
 }

//untuk menampilkan data yang akan diedit
 function edit($kd_warna){
 
  $data['result']     = $this->MBenang->readBenang();
 
  $data['edit']       = $this->MWarna->getById($kd_warna);
 
 	$this->load->view('Kesma/VFormeditwarna', $data);
 
 }

 //proses update data ke database
 function update(){

  $this->form_validation->set_rules('nm_warna','nm_warna','required');

  $kd_warna  = $this->input->post('kd_warna');

  $nm_warna  = $this->input->post('nm_warna');

  $kd_jenis  = $this->input->post('kd_jenis');

  if($this->form_validation->run() != false) {

  //fungsi untuk update record
  $data = array(

      'nm_warna'=>$nm_warna,

      'kd_jenis'=>$kd_jenis

    );

  $update = $this->MWarna->updateWarna($kd_warna, 'warna_tb', $data);

  if($update){

    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('Warna'));

  }else{

    echo "Gagal";

  }

 }

}

//fungsi untuk menghapus record
  function delete($kd_warna){

  $this->db->delete('warna_tb', array('kd_warna'=>$kd_warna));

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('Warna'));

 }

//fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MWarna->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Warna');

      $object->getActiveSheet()->setTitle('Data Master Warna');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $warna_data = $this->MWarna->readWarna()->result();

      $excel_row = 3;

      foreach($warna_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_warna);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nm_warna);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->kd_jenis);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-warna.xls"');

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
        $highestRow = $worksheet->getHighestRow();
        //colom tertinggi
        $highestColumn = $worksheet->getHighestColumn();

        for($row=3; $row<=$highestRow; $row++){
          //baca data dari excel berdasar matrik kolom dan baris (kolom,baris)
           $kd_warna    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $nm_warna    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $kd_jenis    = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $data[] = array(

            'kd_warna'      => $kd_warna,

            'nm_warna'      => $nm_warna,
            
            'kd_jenis'      => $kd_jenis

           );

        }

      }

      $this->MWarna->insertWarna($data);

    }

  }

}

?>