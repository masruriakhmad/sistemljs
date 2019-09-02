<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MVendor');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']      = $this->MVendor->readVendor();
   $data['kd_vendor']   = $this->MVendor->getKd_vendor();
   $this->load->view('Kesma/VVendor', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
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


}

?>