<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grey extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MGrey');
   $this->load->model('MBenang');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
   $data['result']     = $this->MGrey->readGrey();
   $data['kd_kain']    = $this->MGrey->getKd_kain();
   $this->load->view('Kesma/VGrey', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
  $data['result']     = $this->MBenang->readBenang();
  $this->load->view('Kesma/VFormgrey', $data);
 }


//fungsi untuk proses input record
 function createProses(){
  $kd_kain           = $this->MGrey->getKd_kain();
  $nm_kain           = $this->input->post('nm_kain');
  $kd_jenis           = $this->input->post('kd_jenis');

  $data              = array(

      'kd_kain'      =>$kd_kain,
      'nm_kain'      =>$nm_kain,
      'kd_jenis'     =>$kd_jenis
    );
  
  $insert      = $this->MGrey->createGrey($data);


   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Grey')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_kain){
  $this->db->where('kd_kain', $kd_kain);
  $query = $this->db->get('grey_tb');
  $data['edit']=$query->row_array();
  $data['result']    = $this->MBenang->readBenang();
  $this->load->view('Kesma/VFormeditgrey', $data);
 }

 //proses update data ke database
 function update(){
  $kd_kain  = $this->input->post('kd_kain');
  $nm_kain   = $this->input->post('nm_kain');

  //fungsi untuk update record
  $data = array(
      'kd_kain'=>$kd_kain,
      'nm_kain'=>$nm_kain 
    );

  $update = $this->MGrey->updateGrey($kd_kain, 'grey_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
    redirect(base_url('Grey'));
  }else{
    echo "Gagal";
  }

 }

//fungsi untuk menghapus record
  function delete($kd_kain){
  $this->db->delete('grey_tb', array('kd_kain'=>$kd_kain));
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Grey'));
 }


}

?> 