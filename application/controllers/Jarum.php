<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jarum extends CI_Controller {
 
 function __construct()
 
 {
 
   parent::__construct();
 
   $this->load->helper('url');
 
   $this->load->model('MJarum');
 
   $this->load->library('session');
 
   $this->load->library('excel');
 
   $this->load->library('form_validation');
 
 }

//fungsi tampilan index 
function index(){

	$data['result']     = $this->MJarum->readjarum();

   	$data['kd_jarum']   = $this->MJarum->getKd_jarum();

   	$this->load->view('Kesma/VJarum', $data);
   
 }

//fungsi untuk link tampilan input
 function create(){

 	$this->load->view('Kesma/VFormJarum');

 }

//fungsi untuk proses input record
 function createProses(){

 	$kd_jarum          = $this->MJarum->getKd_jarum();

 	$nm_jarum      		 = $this->input->post('nm_jarum');

  $merek_jarum       = $this->input->post('Merek_Jarum');

  $size              = $this->input->post('size');

  $jumlah          = $this->input->post('jumlah');

 	$data              = array(

      'kd_jarum'     =>$kd_jarum,

      'nm_jarum'     =>$nm_jarum,
      
      'Merek_Jarum'  =>$merek_jarum,

      'size'         =>$size,
      
      'jumlah'       =>$jumlah

    );
 	
  $insert		   = $this->MJarum->createJarum($data);


 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Jarum')); 

 }

//untuk menampilkan data yang akan diedit
 function edit($kd_jarum){

 	$this->db->where('kd_jarum', $kd_jarum);

 	$query = $this->db->get('jarum');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditjarum', $this->data);

 }

 //proses update data ke database
 function update(){

   $kd_jarum  	  = $this->input->post('kd_jarum');

   $nm_jarum  	  = $this->input->post('nm_jarum');

   $size          = $this->input->post('size');

  //fungsi untuk update record
   $data = array(

      'kd_jarum'		=> $kd_jarum,

      'nm_jarum'		=> $nm_jarum,

      'size'        => $size,
     
    );

  $update = $this->MJarum->updateJarum($kd_jarum, 'jarum', $data);

  if($update){

    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('jarum'));

  }else{

    echo "Gagal";

  }

 }

//fungsi untuk menghapus record
  function delete($kd_jarum){

  $this->db->delete('jarum', array('kd_jarum'=>$kd_jarum));

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('jarum'));

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

        //cek apakah jumlah nama dan urutan field sama
        $query = $this->MJarum->getColoumnname();

        for($row=3; $row<=$highestRow; $row++){
          //baca data dari excel berdasar matrik kolom dan baris (cell) kolom 1
           $kd_jarum     = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
          //baca data dari excel berdasar matrik kolom dan baris (cell) kolom 2
           $nm_jarum = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $size = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

          // $jumlah = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

           $data[] = array(

            'kd_jarum'       => $kd_jarum,
            'nm_jarum'       => $nm_jarum,
            'size'           => $size,
            //'jumlah'         => $jumlah

           );

        }

      }

      $this->MJarum->insertBenang($data);

      $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data dari EXCEL Berhasil ditambahkan </div>');

      redirect(base_url('jarum')); 

    }
    else {
      $this->load->view('VFormJarum');
    }

  }

//fungsi untuk export excel
function export(){

      $this->load->model("MJarum");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MJarum->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Jarum');

      $object->getActiveSheet()->setTitle('Data Master Jarum');

      foreach($table_columns as $field){


        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $object->getSheet(0)->getStyle('A3:C3')->getBorders()->getAllBorders()->getColor()->setRGB('949FA8');

        $column++;

      }

      $jarum_data = $this->MJarum->fetch_data();

      $excel_row = 3;

      foreach($jarum_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_jarum);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nm_jarum);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->size);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->jumlah);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-jarum.xls"');

      $object_writer->save('php://output');

    }

}

?>