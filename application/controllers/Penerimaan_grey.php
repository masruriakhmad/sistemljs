<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_grey extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   //load model yang diperlukan
   $this->load->helper('url');
   $this->load->model('MPenerimaan_grey');
   $this->load->model('MStock_kain');
   $this->load->model('MGrey');
   $this->load->model('MMesin');
   $this->load->model('MGudang');
   $this->load->model('MCustomer');
   $this->load->model('MProduksi');
   $this->load->model('MUser');
   $this->load->model('MWo');
   $this->load->library('session');
 }


//fungsi tampilan index
function index(){
	$data['result'] 		= 	$this->MPenerimaan_grey->readPenerimaan_grey();
	$data['no_tr_grey']		=	$this->MPenerimaan_grey->get_no_tr_grey();
	$data['getDate']		=	$this->MPenerimaan_grey->getDate();
	$this->load->view('Kesma/VPenerimaangrey',$data);

 }

 //fungsi tampilan rekap penerimaan
function rekap($no_produksi){
	$tanggal 				=	$this->MPenerimaan_grey->getDateOnly();
	
	$data['result'] 		= 	$this->MPenerimaan_grey->getByTanggal($tanggal,$no_produksi);

	$this->load->view('Kesma/VPenerimaangrey',$data);

 }
 
//fungsi proses post create penerimaan
function createProses(){
	//validasi form
	$this->form_validation->set_rules('kd_mesin','kd_mesin','required');
	$this->form_validation->set_rules('no_produksi','no_produksi','required');
	$this->form_validation->set_rules('kd_kain','kd_kain','required');
	$this->form_validation->set_rules('kd_gudang','kd_gudang','required');
	$this->form_validation->set_rules('gramasi','gramasi','required|numeric');
	$this->form_validation->set_rules('kg_grey','kg_grey','required|numeric');
	$no_produksi	=$this->input->post('no_produksi');

	// cek validasi
	if($this->form_validation->run() !=false){

	$no_tr_grey		=$this->MPenerimaan_grey->get_no_tr_grey();
	$tgl			=$this->MPenerimaan_grey->getDate();
	$kd_mesin		=$this->input->post('kd_mesin');
	$no_produksi	=$this->input->post('no_produksi');
	$kd_kain		=$this->input->post('kd_kain');
	$kd_gudang		=$this->input->post('kd_gudang');
	$no_wo			=$this->input->post('no_wo');
	$query 		    =$this->MWo->getByWo1($no_wo);
	$kd_customer 	= $query->kd_customer; 
	$operator		=$this->input->post('operator');
	$gramasi		=$this->input->post('gramasi');
	$kg_grey		=$this->input->post('kg_grey');
	$bs_garis		=$this->input->post('bs_garis');
	$bs_lubang		=$this->input->post('bs_lubang');
	$ket			=$this->input->post('ket');
	$kd_user		=$this->session->userdata('kd_user');

	//cek kg akhir di tabel produksi
	$data=$this->MProduksi->getById($no_produksi);
	$kg_akhir=$data->kg_akhir;

	//cek apakah kg grey melebihi kg yang di peoduksi
	if($kg_grey>$kg_akhir){

		$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Kg grey melebihi Kg tersedia </div>');

	redirect(base_url('Produksi/editProduksi/'.$no_produksi)); 

	}else{

		$data=array(	
	'no_tr_grey'	=>$no_tr_grey,
	'tgl'			=>$tgl,
	'kd_mesin'		=>$kd_mesin,
	'no_produksi'	=>$no_produksi,
	'kd_kain'		=>$kd_kain,
	'kd_gudang'		=>$kd_gudang,
	'kd_customer'	=>$kd_customer,
	'no_wo'			=>$no_wo,
	'operator'		=>$operator,
	'gramasi'		=>$gramasi,
	'kg_grey'		=>$kg_grey,
	'bs_garis'		=>$bs_garis,
	'bs_lubang'		=>$bs_lubang,
	'ket'			=>$ket,
);

$insert = $this->MPenerimaan_grey->createPenerimaan_grey($data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');
$this->session->set_flashdata('gramasi',$gramasi);
$this->session->set_flashdata('operator',$operator);
$this->session->set_flashdata('nm_kain',$nm_kain);
$this->session->set_flashdata('kd_kain',$kd_kain);
$this->session->set_flashdata('no_wo',$no_wo);

 	redirect(base_url('Produksi/editProduksi/'.$no_produksi)); 

	}
	

}else{

	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Lengkapi Data terlebih dahulu </div>');

	redirect(base_url('Produksi/editProduksi/'.$no_produksi));

}
	

}

//untuk menampilkan data yang akan dibatalkan
 function batalProses($no_tr_grey){
 		$status			=0;
 		$query 	  		= $this->MPenerimaan_grey->getById($no_tr_grey);
		$kg_grey  		= $query->kg_grey;
		$no_produksi  	= $query->no_produksi;
		$kg_akhir 		= $this->MProduksi->getById($no_produksi)->kg_akhir;

		$jumlahkg 		= $kg_grey + $kg_akhir;

//insert into database
 	$data = array(
	'status'		=>$status,
 		);

 	$data1 = array(
	'kg_akhir'		=>$jumlahkg,
 		);


$update        = $this->MPenerimaan_grey->batalPenerimaan_grey($no_tr_grey, 'terimagrey_tb', $data);
$Stock_kembali = $this->MProduksi->updateProduksi($no_produksi, 'produksi_tb', $data1);
$hapus_stock_kain = $this->MStock_kain->deleteStock_kain($no_tr_grey);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil batalkan </div>');

 	redirect(base_url('Penerimaan_grey')); 
 	

 }

}
?>