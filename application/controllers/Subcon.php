<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcon extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MSubcon');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']       = $this->MSubcon->readSubcon();
   $data['kd_subcon']    = $this->MSubcon->getKd_subcon();
   $this->load->view('Kesma/VSubcon', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
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

}

?>