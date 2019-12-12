<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retur_benang extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MPenerimaan_benang');

   $this->load->model('MRetur_benang');

   $this->load->model('MStock_akhir_benang');

   $this->load->model('MBenang');

   $this->load->model('MVendor');

   $this->load->model('MGudang');

   $this->load->library('form_validation');

   $this->load->model('MUser');

   $this->load->library('session');

 }

//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MRetur_benang->readRetur_benang();

	$this->load->view('Kesma/VReturbenang', $data);

 }

 //fungsi untuk tampil laporan produksi
function laporan(){

	$data['result'] = $this->MRetur_benang->getAll();

	$this->load->view('Lap-transaksi/VLapReturPenerimaanbenang',$data);

}

//fungsi untuk filter laporan produksi berdasarkan tanggal
function laporanFilter(){

	$tglAwal  = $this->input->post('tglawal');

	$tglAkhir = $this->input->post('tglakhir');

	$key = array(

		'tgl >='=> $tglAwal,

		'tgl <='=> $tglAkhir

	);

	$this->session->set_flashdata('tglAwal',$tglAwal);

    $this->session->set_flashdata('tglAkhir',$tglAkhir);

	$data['result'] = $this->MRetur_benang->getByRangeTgl($key); 

	$this->load->view('Lap-transaksi/VLapReturPenerimaanbenang',$data);	

}
//untuk reset laporan filter
function reset(){

	redirect(base_url('Retur_benang/laporan')); 

}
 
//fungsi untuk tampilan create
function create(){

	$data['benang']	=	$this->MStock_akhir_benang->readStock_akhir_benang();

	$data['vendor']	=	$this->MVendor->readVendor();

	$this->load->view('Kesma/VFormReturpenerimaanbenang',$data);

}

//fungsi proses post create penerimaan
function createProses(){

	$this->form_validation->set_rules('kd_benang','kd_benang','required');

	$this->form_validation->set_rules('kd_vendor','kd_vendor','required');

	$this->form_validation->set_rules('jumlah','jumlah','required');

	if($this->form_validation->run() !=false){

	$no_retur_benang=$this->MRetur_benang->get_no_retur_benang();//$this->input->post('no_tr_benang');

	$tgl			=$this->MPenerimaan_benang->getDate();//$this->input->post('tgl');

	$kd_vendor		=$this->input->post('kd_vendor');

	$kd_benang 	    =$this->input->post('kd_benang');

	$kd_jenis      = substr($kd_benang,0,4);

	$kd_user		=$this->session->userdata('kd_user');

	$jumlah			=$this->input->post('jumlah');

	$ket			=$this->input->post('ket');

	$stock_lama     =$this->MStock_akhir_benang->getById($kd_benang)->stock;

	$stock_baru     =$stock_lama-$jumlah;

if($stock_lama >= $jumlah){

$data=array(	

	'no_retur_benang'	=>$no_retur_benang,

	'tgl'			=>$tgl,

	'kd_benang'		=>$kd_benang,

	'kd_vendor'		=>$kd_vendor,

	'kd_jenis' 		=>$kd_jenis,

	'kd_user'		=>$kd_user,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket,

	'status'        => '1'

);

$stock        = array(

	'stock'   => $stock_baru

);

$update_stock = $this->MStock_akhir_benang->updateStock($kd_benang,'stock_akhir_benang',$stock);

$insert       = $this->MRetur_benang->createRetur_benang($data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Retur_benang')); 

 }else{

 	$this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Stock tidak mencukupi </div>');

 	redirect(base_url('Retur_benang/create')); 

 }


 }else{

 	redirect(base_url('Retur_benang/create')); 
 }

}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($no_retur_benang){

	
	$kd_jenis       =$this->MRetur_benang->getById($no_retur_benang)->kd_jenis;

	$kd_vendor      =$this->MRetur_benang->getById($no_retur_benang)->kd_vendor;

	$kd_benang      =$this->MRetur_benang->getById($no_retur_benang)->kd_benang;

	$jumlah         =$this->MRetur_benang->getById($no_retur_benang)->jumlah;

	$stock_lama     =$this->MStock_akhir_benang->getById($kd_benang)->stock;

	$stock_baru     =$stock_lama+$jumlah;

	$status			=0;

//insert into database
 	$data = array(

	'status'		=>$status,

 		);

 	 $stock = array(

	'stock'		=>$stock_baru

 		);

$update_stock = $this->MStock_akhir_benang->updateStock($kd_benang,'stock_akhir_benang',$stock);

$update = $this->MRetur_benang->batalRetur_benang($no_retur_benang, 'retur_benang_tb', $data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Retur_benang')); 

 }

  //fungsi untuk cetak surat jalan penerimaan kainjadi
 function cetakProses($no_retur_benang){

  $data['result']       = $this->MRetur_benang->getById($no_retur_benang);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Retur-Penerimaan-benang.pdf.";

  $this->pdf->load_view('Lap/VLapReturPenerimaanBenang', $data);

 //$this->load->view('Lap/VLapReturPenerimaanBenang', $data);
}



}

?>