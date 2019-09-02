<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MKriteria');
   $this->load->library('session');
 }


//tampilan index kriteria
function indexKriteria(){
	 $data['result'] = $this->MKriteria->lihatKriteria();
	 $this->load->view('Kesma/VDataKriteria', $data);
 }


//tampilan unutk lihat kriteria
 function lihatKriteria(){
   $data['result'] = $this->MKriteria->lihatKriteria();
   $this->load->view('TimSeleksi/VLihatKriteria', $data);
 }


//untuk link ke form input
 function createKriteria()
 {
 	$this->load->view('Kesma/VFormKriteria');
 }


//untuk proses inputan 
 function createProcess(){
 	$nama_kriteria  = $this->input->post('nama_kriteria');
 	$bobot_kriteria = $this->input->post('bobot_kriteria');

 	$data          = array('nama_kriteria'=>$nama_kriteria, 'bobot_kriteria'=>$bobot_kriteria);
 	$insert		   = $this->MKriteria->create($data);
 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');
 	redirect(base_url('Kriteria/indexKriteria')); 
 }


//untuk menampilkan data yang akan diedit
 function editKriteria($id){
 	$this->db->where('id_kriteria', $id);
 	$query = $this->db->get('data_kriteria');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VEditKriteria', $this->data);
 }


//proses update data ke database
 function update($id){
 	$nama_kriteria  = $this->input->post('nama_kriteria');
 	$bobot_kriteria = $this->input->post('bobot_kriteria');

 	//insert into database
 	$data = array(
 			'nama_kriteria'=>$nama_kriteria,
 			'bobot_kriteria'=>$bobot_kriteria,
 		);

 	$update = $this->MKriteria->update($id, 'data_kriteria', $data);
 	if($update){
 		$this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
 		redirect(base_url('Kriteria/indexKriteria'));
 	}else{
 		echo "Gagal";
 	}

 }


//untuk menghapus kriteria
  function deleteKriteria($id){
  $this->db->delete('data_kriteria', array('id_kriteria'=>$id));
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Kriteria/indexKriteria'));
 }

}

?>