<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends CI_Controller {

 function __construct()
 
 {
 
   parent::__construct();
 
   $this->load->helper('url');
 
   $this->load->model('MVendor');
 
   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');
 
 }

//fungsi tampilan index 
function index(){

	 $data['result']      = $this->MVendor->readVendor();

   $data['kd_vendor']   = $this->MVendor->getKd_vendor();

   $this->load->view('Kesma/VVendor', $data);
   
 }

//fungsi untuk link tampilan input
 function create(){

 	$this->load->view('Kesma/VFormvendor');
 
 }

//fungsi untuk proses input record
 function createProses(){
 
 	$kd_vendor          = $this->MVendor->getKd_vendor();
 
 	$nm_vendor          = $this->input->post('nm_vendor');
 
  $alamat             = $this->input->post('alamat');

 	$data              = array(

      'kd_vendor'     =>$kd_vendor,
 
      'nm_vendor'     =>$nm_vendor,
 
      'alamat'        =>$alamat

    );
 	
  $insert		   = $this->MVendor->createVendor($data);

 	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Vendors')); 
 
 }

//untuk menampilkan data yang akan diedit
 function edit($kd_vendor){

 	$this->db->where('kd_vendor', $kd_vendor);

 	$query = $this->db->get('vendor_tb');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditvendor', $this->data);
 
 }

 //proses update data ke database
 function update(){
 
  $kd_vendor     = $this->input->post('kd_vendor');
 
  $nm_vendor     = $this->input->post('nm_vendor');
 
  $alamat        = $this->input->post('alamat');

  //fungsi untuk update record
  $data = array(
 
      'nm_vendor'   =>$nm_vendor,
 
      'alamat'      =>$alamat
 
    );

  $update = $this->MVendor->updateVendor($kd_vendor, 'vendor_tb', $data);
 
  if($update){
 
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
 
    redirect(base_url('Vendors'));
 
  }else{
 
    echo "Gagal";
 
  }

 }

//fungsi untuk menghapus record
  function delete($kd_vendor){
 
  $this->db->delete('vendor_tb', array('kd_vendor'=>$kd_vendor));
 
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
 
  redirect(base_url('Vendors'));
 
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
           $kd_vendor    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $nm_vendor    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $alamat       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $data[] = array(

            'kd_vendor'      => $kd_vendor,

            'nm_vendor'      => $nm_vendor,
            
            'alamat'         => $alamat

           );

        }

      }

      $this->MVendor->insertVendor($data);

    }

  }

  //fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MVendor->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Vendor');

      $object->getActiveSheet()->setTitle('Data Master Vendor');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $vendor_data = $this->MVendor->readVendor()->result();

      $excel_row = 3;

      foreach($vendor_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_vendor);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nm_vendor);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->alamat);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-vendor.xls"');

      $object_writer->save('php://output');

    }

}

?>