<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partai extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MPartai');
   $this->load->model('MStock_kain');
   $this->load->model('MPenerimaan_kainjadi');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']      = $this->MPartai->readPartai();
   $data['kd_partai']   = $this->MPartai->getKd_partai();
   $this->load->view('VPartai', $data);
   
 }

//fungsi tampilan detail partai 
function detailPartai($kd_partai){
   $data['result']      = $this->MPartai->getByKd_partai($kd_partai);
   
   $this->load->view('Kesma/VListPartai', $data);
   
 }

 //fungsi tampilan detail partai 
function detailPartaiTerima($kd_partai){
   $data['result']      = $this->MPartai->getByKd_partai($kd_partai);
   
   $this->load->view('Kesma/VListPartaiTerima', $data);
   
 }

 //fungsi tampilan detail maklun
function detailMaklun($no_tr_maklun){
  $data['result']      = $this->MPartai->getByTrMaklun($no_tr_maklun);

 
  $this->load->view('Kesma/VDetailmaklun',$data);

 }

//fungsi untuk link tampilan input
 function create()
 {
  $status              = 'G';
  $data['result']      = $this->MPartai->readPartai();
  $data['result']      = $this->MStock_kain->getByStatus($status);
 	$this->load->view('Kesma/VFormPartai');
 }


//fungsi untuk proses input record   ///belum selesai
 function createProses(){

  $kd_partai          = $this->input->post('kd_partai');
  $no_tr_maklun       = $this->input->post('no_tr_maklun');
 	$no_tr_grey         = $this->input->post('no_tr_grey');//berisi array dari checkbox
  $kd_user            = $this->session->userdata('kd_user');
  
  //print_r($no_tr_grey);
  //hitung jumlah tr gre yang dipilih
  $jumlah_dipilih = count($no_tr_grey);
 
 //buat perulangan untuk seva sejumlah tr grey yang dipilih
  for($x=0;$x<$jumlah_dipilih;$x++){
    $tr_grey = $no_tr_grey[$x];

    $data=array(
      'no_tr_grey'  => $tr_grey,
      'no_tr_maklun'=> $no_tr_maklun,
      'kd_partai'   => $kd_partai,
      'status'      => 'T',
      'kd_user'     => $kd_user
    );

    $insert=$this->MPartai->createPartai($data);
  }

 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Pengiriman_grey/create')); 
 }

 //fungsi untuk proses update record  partai_tb (data sementara penerimaan kain jadi)
 
 function createListTerima(){

  $no_tr_grey         = $this->input->post('no_tr_grey');//berisi array dari checkbox
  $kd_warna           = $this->input->post('kd_warna');
  $kg_fin             = $this->input->post('kg_fin');//berisi array dari checkbox
  $setting            = $this->input->post('setting');//berisi array dari checkbox

  $no_tr_kainjadi     = $this->MPenerimaan_kainjadi->get_no_tr_kainjadi();
  $kd_user            = $this->session->userdata('kd_user');
  
  //print_r($no_tr_grey);
  //hitung jumlah tr gre yang dipilih
  $jumlah_dipilih = count($no_tr_grey);
 
 //buat perulangan untuk seva sejumlah tr grey yang dipilih
  for($x=0;$x<$jumlah_dipilih;$x++){
    $tr_grey      = $no_tr_grey[$x];
    $kg_fin_val   = $kg_fin[$x];
    $setting_val  = $setting[$x];

    $data=array(

      'no_tr_kainjadi '=> $no_tr_kainjadi,
      'kd_warna '   => $kd_warna,
      'kg_fin '     => $kg_fin_val,
      'setting '    => $setting_val,
      'kd_user'     => $kd_user,
      'status'      => 'P',
    );

    $update=$this->MPartai->updatePartaiByTrGrey($tr_grey,'partai_tb',$data);
  }

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Penerimaan_kainjadi/create')); 
 }

  //fungsi delete list (update partai TB ke semula)
 function deleteListTerima($kd_partai){

 
  $kd_user        = $this->session->userdata('kd_user');
  $key=array(
    'kd_partai'     => $kd_partai,
    'kd_user'       => $kd_user,
    'status'        => 'P'
  );
  
  $data = array(
    'no_tr_kainjadi' => NULL,
    'kd_warna'       => NULL,
    'kg_fin'         => NULL,
    'setting'        => NULL,
    'status'         => 'M',
    'kd_user'        => $kd_user,
  );
  

  $update=$this->MPartai->updatePartaiByKey($key,'partai_tb',$data);

   redirect(base_url('Penerimaan_kainjadi/create')); 

 }

 //fungsi delete all list (update partai TB ke semula)
 function deleteAllListTerima($no_tr_kainjadi='PRK1908280001'){

 
  $kd_user        = $this->session->userdata('kd_user');
  $key=array(
    'no_tr_kainjadi'=> $no_tr_kainjadi,
    'kd_user'       => $kd_user,
    'status'        => 'P'
  );
  
  $data = array(
    'no_tr_kainjadi' => NULL,
    'kd_warna'       => NULL,
    'kg_fin'         => NULL,
    'setting'        => NULL,
    'status'         => 'M',
    'kd_user'        => $kd_user,
  );
  

  $update=$this->MPartai->updatePartaiByKey($key,'partai_tb',$data);
   $this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dibatalkan </div>');

   redirect(base_url('Penerimaan_kainjadi')); 

 }

//untuk menampilkan data yang akan diedit
 function edit($no_tr_grey){
 	$this->db->where('no_tr_grey', $no_tr_grey);
 	$query = $this->db->get('partai_tb');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);
 }

 //mungkin tidak di pakai
 function update($no_tr_grey){
  $no_tr_grey  = $this->input->post('no_tr_grey');

  //fungsi untuk update record
  $data = array(
      'no_tr_grey'=>$no_tr_grey
     
    );

  $update = $this->MPartai->updatePartai($no_tr_grey, 'partai_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('Partai'));
  }else{
    $this->session->set_flashdata('notifgagal','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Gagal diubah lengkapi data </div>');

    redirect(base_url('Partai/edit'.$no_tr_grey));
  }

 }

//fungsi untuk menghapus record partai
  function deleteByTrMaklun($no_tr_maklun){
  $kd_user =$this->session->userdata('kd_user');
  $this->db->delete('partai_tb', array('no_tr_maklun'=>$no_tr_maklun,
                                       'kd_user'     =>$kd_user
  ));
  
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dibatalkan </div>');
  redirect(base_url('Pengiriman_grey'));
 }

 //fungsi untuk menghapus record partai by kd Partai
  function deleteByKd_partai($kd_partai){
  $this->db->delete('partai_tb', array('kd_partai'=>$kd_partai));
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dibatalkan </div>');
  redirect(base_url('Pengiriman_grey/create'));
 }


}

?>