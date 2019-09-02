<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MCustomer');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']        = $this->MCustomer->readCustomer();
   $data['kd_customer']   = $this->MCustomer->getKd_customer();
   $this->load->view('Kesma/VCustomer', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
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

 	$data              = array(

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


}

?>