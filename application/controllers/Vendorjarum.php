<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendorjarum extends CI_Controller {

 function __construct()
 
 {
 
   parent::__construct();
 
   $this->load->helper('url');
 
   $this->load->model('MVendorjarum');
 
   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');
 
 }

//fungsi tampilan index 
function index(){

	 $data['result']      = $this->MVendorjarum->readVendorjarum();

   $data['kd_Vendorjarumjarum']   = $this->MVendorjarum->getKd_Vendorjarum();

   $this->load->view('Kesma/VVendorjarum', $data);
   
 }

//fungsi untuk link tampilan input
 function create(){

 	$this->load->view('Kesma/VFormVendorjarum');
 
 }

//fungsi untuk proses input record
 function createProses(){
 
 	$kd_Vendorjarum          = $this->MVendorjarum->getKd_Vendorjarum();
 
 	$nm_Vendorjarum          = $this->input->post('nm_vendorjarum');
 
  $alamat             = $this->input->post('alamat');

 	$data              = array(

      'kd_Vendorjarum'     =>$kd_Vendorjarum,
 
      'nm_Vendorjarum'     =>$nm_Vendorjarum,
 
      'alamat'        =>$alamat

    );
 	
  $insert		   = $this->MVendorjarum->createVendorjarum($data);

 	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Vendorjarum')); 
 
 }

//untuk menampilkan data yang akan diedit
 function edit($kd_Vendorjarum){

 	$this->db->where('kd_Vendorjarum', $kd_Vendorjarum);

 	$query = $this->db->get('vendor_jarum');

 	$data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditVendorjarum', $data);
 
 }

 //proses update data ke database
 function update(){
 
  $kd_Vendorjarum     = $this->input->post('kd_vendorjarum');
 
  $nm_Vendorjarum     = $this->input->post('nm_vendorjarum');
 
  $alamat        = $this->input->post('alamat');

  //fungsi untuk update record
  $data = array(
 
      'nm_Vendorjarum'   =>$nm_Vendorjarum,
 
      'alamat'      =>$alamat
 
    );

  $update = $this->MVendorjarum->updateVendorjarum($kd_Vendorjarum, 'vendor_jarum', $data);
 
  if($update){
 
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
 
    redirect(base_url('Vendorjarum'));
 
  }else{
 
    echo "Gagal";
 
  }

 }

//fungsi untuk menghapus record
  function delete($kd_Vendorjarum){
 
  $this->db->delete('vendor_jarum', array('kd_Vendorjarum'=>$kd_Vendorjarum));
 
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
 
  redirect(base_url('Vendorjarum'));
 
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
           $kd_Vendorjarum    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $nm_Vendorjarum    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $alamat       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $data[] = array(

            'kd_Vendorjarum'      => $kd_Vendorjarum,

            'nm_Vendorjarum'      => $nm_Vendorjarum,
            
            'alamat'         => $alamat

           );

        }

      }

      $this->MVendorjarum->insertVendorjarum($data);

    }

  }

  //fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MVendorjarum->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Vendorjarum');

      $object->getActiveSheet()->setTitle('Data Master Vendorjarum');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $Vendorjarum_data = $this->MVendorjarum->readVendorjarum()->result();

      $excel_row = 3;

      foreach($Vendorjarum_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_Vendorjarum);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nm_Vendorjarum);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->alamat);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-Vendorjarum.xls"');

      $object_writer->save('php://output');

    }

}

?>