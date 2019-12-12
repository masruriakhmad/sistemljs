<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
 function __construct()
 {
   parent::__construct();

   $this->load->helper('url');

   $this->load->model('MCustomer');

   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');

 }


//fungsi tampilan index 
function index(){

	 $data['result']        = $this->MCustomer->readCustomer();

   $data['kd_customer']   = $this->MCustomer->getKd_customer();

   $this->load->view('Kesma/VCustomer', $data);
   
 }


//fungsi untuk link tampilan input
 function create(){

 	$this->load->view('Kesma/VFormCustomer');

 }


//fungsi untuk proses input record
 function createProses(){

 	$kd_customer        = $this->MCustomer->getKd_customer();

  $nik                = $this->input->post('nik');

 	$nm_customer        = $this->input->post('nm_customer');

  $alamat             = $this->input->post('alamat');

  $no_telp            = $this->input->post('no_telp');

  $kota               = $this->input->post('kota');

 	$data               = array(

      'kd_customer'   =>$kd_customer,

      'nik'           =>$nik,

      'nm_customer'   =>$nm_customer,

      'alamat'        =>$alamat,

      'no_telp'       =>$no_telp,

      'kota'          =>$kota

    );
 	
  $insert		   = $this->MCustomer->createCustomer($data);

 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Customer')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_customer){

 	$this->db->where('kd_customer', $kd_customer);

 	$query = $this->db->get('customer_tb');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditcustomer', $this->data);

 }

 //proses update data ke database
 function update(){

  $kd_customer        = $this->input->post('kd_customer');

  $nik                = $this->input->post('nik');

  $nm_customer        = $this->input->post('nm_customer');

  $alamat             = $this->input->post('alamat');

  $no_telp            = $this->input->post('no_telp');

  $kota               = $this->input->post('kota');

  $data              = array(

      'nik'           =>$nik,

      'nm_customer'   =>$nm_customer,

      'alamat'        =>$alamat,

      'no_telp'       =>$no_telp,

      'kota'          =>$kota

    );

  $update = $this->MCustomer->updateCustomer($kd_customer, 'customer_tb', $data);

  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('Customer'));

  }else{

     $this->session->set_flashdata('notifedit','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4>Data Gagal diubah </div>');

    redirect(base_url('Customer'));

  }

 }

//fungsi untuk menghapus record
  function delete($kd_customer){

  $this->MCustomer->deleteCustomer($kd_customer);

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('Customer'));
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
           $kd_customer     = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $nik             = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $nm_customer     = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
           
           $alamat          = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
           
           $no_telp         = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $kota            = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

           $data[] = array(

            'kd_customer'    => $kd_customer,

            'nik'            => $nik,

            'nm_customer'    => $nm_customer,
            
            'alamat'         => $alamat,

            'no_telp'        => $no_telp,            
            
            'kota'           => $kota

           );

        }

      }

      $this->MCustomer->insertCustomer($data);

    }

  }

//fungsi untuk export excel
function export(){

      $this->load->model("MCustomer");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MCustomer->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Customer');

      $object->getActiveSheet()->setTitle('Data Master Customer');

      foreach($table_columns as $field){


        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $object->getSheet(0)->getStyle('A3:C3')->getBorders()->getAllBorders()->getColor()->setRGB('949FA8');

        $column++;

      }

      $customer_data = $this->MCustomer->readCustomer()->result();

      $excel_row = 3;

      foreach($customer_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_customer);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nik);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nm_customer);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->alamat);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->no_telp);

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->kota);



        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-customer.xls"');

      $object_writer->save('php://output');

    }


}

?>