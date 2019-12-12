<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcon extends CI_Controller {

 function __construct(){

   parent::__construct();

   $this->load->helper('url');

   $this->load->model('MSubcon');

   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');
 
 }

//fungsi tampilan index 
function index(){

	 $data['result']       = $this->MSubcon->readSubcon();

   $data['kd_subcon']    = $this->MSubcon->getKd_subcon();

   $this->load->view('Kesma/VSubcon', $data);
   
 }

//fungsi untuk link tampilan input
 function create(){

 	$this->load->view('Kesma/VFormSubcon');

 }

//fungsi untuk proses input record
 function createProses(){

  //validasi form
  $this->form_validation->set_rules('nm_subcon','nm_subcon','required');

  $this->form_validation->set_rules('alamat','alamat','required');

if($this->form_validation->run() != false){

 	$kd_subcon        = $this->MSubcon->getKd_subcon();

 	$nm_subcon        = $this->input->post('nm_subcon');

  $alamat           = $this->input->post('alamat');

 	$data             = array(

      'kd_subcon'   =>$kd_subcon,

      'nm_subcon'   =>$nm_subcon,

      'alamat'      =>$alamat

    );
 	
  $insert		   = $this->MSubcon->createSubcon($data);

 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Subcon')); 

 }else{

redirect(base_url('Subcon/create'));

 }

}

//untuk menampilkan data yang akan diedit
 function edit($kd_subcon){

 	$this->db->where('kd_subcon', $kd_subcon);

 	$query = $this->db->get('subcon_tb');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditsubcon', $this->data);

 }

 //proses update data ke database
 function update(){

  $kd_subcon  = $this->input->post('kd_subcon');

  $nm_subcon  = $this->input->post('nm_subcon');

  $alamat     = $this->input->post('alamat');

  //fungsi untuk update record
  $data = array(

      'nm_subcon'   =>$nm_subcon,

      'alamat'      =>$alamat
     
    );

  $update = $this->MSubcon->updateSubcon($kd_subcon, 'subcon_tb', $data);

  if($update){

    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('Subcon'));

  }else{

    echo "Gagal";

  }

 }

//fungsi untuk menghapus record
  function delete($kd_subcon){

  $this->db->delete('subcon_tb', array('kd_subcon'=>$kd_subcon));

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  
  redirect(base_url('Subcon'));

 }

//fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MSubcon->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Subcon');

      $object->getActiveSheet()->setTitle('Data Master Subcon');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $subcon_data = $this->MSubcon->readSubcon()->result();

      $excel_row = 3;

      foreach($subcon_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_subcon);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nm_subcon);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->alamat);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-subcon.xls"');

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
           $kd_subcon    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $nm_subcon    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $alamat       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $data[] = array(

            'kd_subcon'      => $kd_subcon,

            'nm_subcon'      => $nm_subcon,
            
            'alamat'         => $alamat

           );

        }

      }

      $this->MSubcon->insertSubcon($data);

    }

  }

}

?>