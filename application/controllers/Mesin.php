<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mesin extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MMesin');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
   $data['result']     = $this->MMesin->readMesin();
   $data['kd_mesin']   = $this->MMesin->getKd_mesin();
   $this->load->view('Kesma/VMesin', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
  $this->load->view('kesma/VFormMesin');
 }


//fungsi untuk proses input record
 function createProses(){
  $kd_mesin          = $this->MMesin->getKd_mesin();
  $no_mesin     = $this->input->post('no_mesin');
  $merk      = $this->input->post('merk');
  $trak      = $this->input->post('trak');
  $no_seri      = $this->input->post('no_seri');
  $tahun     = $this->input->post('tahun');
  $diameter      = $this->input->post('diameter');
  $gauge      = $this->input->post('gauge');
  $feeder      = $this->input->post('feeder');
  $jml_jarum      = $this->input->post('jml_jarum');

  $data              = array(

      'kd_mesin'     =>$kd_mesin,
      'no_mesin' =>$no_mesin,
      'merk' =>$merk,
      'trak' =>$trak,
      'no_seri' =>$no_seri,
      'tahun' =>$tahun,
      'diameter' =>$diameter,
      'gauge' =>$gauge,
      'feeder' =>$feeder,
      'jml_jarum' =>$jml_jarum,

    );
  
  $insert      = $this->MMesin->createMesin($data);


   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Mesin')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_mesin){
  $this->db->where('kd_mesin', $kd_mesin);
  $query = $this->db->get('mesin_tb');
  $this->data['edit'] = $query->row_array();

  $this->load->view('Kesma/VFormeditmesin', $this->data);
 }

 //proses update data ke database
 function update(){
  $kd_mesin= $this->input->post('kd_mesin');
  $no_mesin= $this->input->post('no_mesin');
  $merk      = $this->input->post('merk');
  $trak      = $this->input->post('trak');
  $no_seri      = $this->input->post('no_seri');
  $tahun     = $this->input->post('tahun');
  $diameter      = $this->input->post('diameter');
  $gauge      = $this->input->post('gauge');
  $feeder      = $this->input->post('feeder');
  $jml_jarum      = $this->input->post('jml_jarum');

  //fungsi untuk update record
  $data = array(
      'kd_mesin'=>$kd_mesin,
      'no_mesin'=>$no_mesin,
      'merk' =>$merk,
      'trak' =>$trak,
      'no_seri' =>$no_seri,
      'tahun' =>$tahun,
      'diameter' =>$diameter,
      'gauge' =>$gauge,
      'feeder' =>$feeder,
      'jml_jarum' =>$jml_jarum
    );

  $update = $this->MMesin->updateMesin($kd_mesin, 'mesin_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
    redirect(base_url('Mesin'));
  }else{
    echo "Gagal";
  }

 }

//fungsi untuk menghapus record
  function delete($kd_mesin){
  $this->db->delete('kd_mesin', array('kd_mesin'=>$kd_mesin));
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Mesin'));
 }


}

?>