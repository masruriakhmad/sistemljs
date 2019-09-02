<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MGudang');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']     = $this->MGudang->readGudang();
   $data['kd_gudang']    = $this->MGudang->getKd_gudang();
   $this->load->view('', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
 	$this->load->view('');
 }


//fungsi untuk proses input record
 function createProses(){
 	$kd_gudang          = $this->MGudang->getKd_gudang();
  $nm_gudang          = $this->input->post('nm_gudang');

 	$data             = array(

      'kd_gudang'     =>$kd_gudang,
      'nm_gudang'     =>$nm_gudang,

    );
 	
  $insert		   = $this->MGudang->createGudang($data);


 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Kriteria/indexKriteria')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_gudang){
 	$this->db->where('kd_gudang', $kd_gudang);
 	$query = $this->db->get('u_tb');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);
 }

 //proses update data ke database
 function update($kd_gudang){
  $kd_gudang          = $this->MGudang->getKd_gudang();
  $nm_gudang          = $this->input->post('nm_gudang');

  //fungsi untuk update record
  $data = array(
      'kd_gudang'     =>$kd_gudang,
      'nm_gudang'     =>$nm_gudang,

    );

  $update = $this->MGudang->updateGudang($kd_gudang, 'gudang_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
    redirect(base_url('Kriteria/indexKriteria'));
  }else{
    echo "Gagal";
  }

 }

//fungsi untuk menghapus record
  function delete($kd_gudang){
  $this->db->deleteGudang('gudang_tb', array('kd_gudang'=>$kd_gudang));


  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Kriteria/indexKriteria'));
 }


}

?>