<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MUser');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']     = $this->MUser->lihatUser();
   //$data['kd_user']    = $this->MUser->getKd_user();
   $this->load->view('Pengaturan/VLihatUser', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
 	$this->load->view('Admin/VFormUser');
 }


//fungsi untuk proses input record
 function createProses(){
 	$kd_user          = $this->MUser->getKd_user();
  $nm_user          = $this->input->post('nm_user');
 	$pass             = $this->input->post('pass');
  $jabatan          = $this->input->post('jabatan');

 	$data             = array(

      'kd_user'     =>$kd_user,
      'nm_user'     =>$nm_user,
      'pass'        =>$pass,
      'jabatan'     =>$jabatan

    );
 	
  $insert		   = $this->MUser->createUser($data);


 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('User')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_user){
 	$this->db->where('kd_user', $kd_user);
 	$query = $this->db->get('user_tb');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);
 }

 //proses update data ke database
 function update($kd_user){
  $nm_user          = $this->input->post('nm_user');
  $pass             = $this->input->post('pass');
  $jabatan          = $this->input->post('jabatan');

  //fungsi untuk update record
  $data = array(
      'nm_user'     =>$nm_user,
      'pass'        =>$pass,
      'jabatan'     =>$jabatan

    );

  $update = $this->MUser->updateUser($kd_user, 'user_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
    redirect(base_url('Kriteria/indexKriteria'));
  }else{
    echo "Gagal";
  }

 }

//fungsi untuk menghapus record
  function delete($kd_user){
  $this->db->delete('user_tb', array('kd_user'=>$kd_user));


  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Kriteria/indexKriteria'));
 }


}

?>