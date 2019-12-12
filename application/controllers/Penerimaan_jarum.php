<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_jarum extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MPenerimaan_jarum');

   $this->load->model('MJarum');

   $this->load->model('MVendorjarum');

   //$this->load->model('MGudang');

   $this->load->library('form_validation');

   $this->load->model('MUser');

   $this->load->library('session');

 }

//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MPenerimaan_jarum->readPenerimaan_jarum();

	$this->load->view('Kesma/VPenerimaanjarum', $data);

 }

//fungsi untuk tampil laporan produksi
function laporan(){

	$data['result'] = $this->MPenerimaan_jarum->readPenerimaan_jarum();

	$this->load->view('Lap-transaksi/VLapPenerimaanjarum',$data);

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

	$data['result'] = $this->MPenerimaan_jarum->getByKey($key); 

	$this->load->view('Lap-transaksi/VLapPenerimaanjarum',$data);	

}
//untuk reset laporan filter
function reset(){

	redirect(base_url('Penerimaan_jarum/laporan')); 

}
 
//fungsi untuk tampilan create
function create(){

	$data['no_tr_jarum']	=	$this->MPenerimaan_jarum->get_no_tr_jarum();

	$data['result1']	=	$this->MJarum->readJarum();

	$data['result2']	=	$this->MVendorjarum->readVendorjarum();

//	$data['result3']	=	$this->MGudang->readGudang();

	$this->load->view('Kesma/VFormpenerimaanjarum',$data);

}

//untuk menampilkan data yang akan dibatalkan
 function bataltampil($no_tr_jarum){

 	$this->db->where('no_tr_jarum', $no_tr_benang);

 	$query = $this->db->get('penerimaan_jarum');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);

 }

//fungsi proses post create penerimaan
function createProses(){

	$this->form_validation->set_rules('kd_jarum','kd_jarum','required');

	//$this->form_validation->set_rules('kd_vendorjarum','kd_vendorjarum','required');

//	$this->form_validation->set_rules('kd_gudang','kd_gudang','required');

	$this->form_validation->set_rules('jumlah','jumlah','required');

	if($this->form_validation->run() !=false){

	$no_tr_jarum	=$this->MPenerimaan_jarum->get_no_tr_jarum();//$this->input->post('no_tr_benang');

	$tgl			=$this->MPenerimaan_jarum->getDate();//$this->input->post('tgl');

	$kd_jarum		=$this->input->post('kd_jarum');

	//$kd_vendorjarum	=$this->input->post('kd_vendorjarum');

//	$kd_gudang		=$this->input->post('kd_gudang');

	$kd_user		=$this->session->userdata('kd_user');

	$jumlah			=$this->input->post('jumlah');

	$ket			=$this->input->post('ket');

$data=array(	

	'no_tr_jarum'	=>$no_tr_jarum,

	'tgl'			=>$tgl,

	'kd_jarum'		=>$kd_jarum,

	//'kd_vendorjarum'=>$kd_vendorjarum,

//	'kd_gudang'		=>$kd_gudang,

	'kd_user'		=>$kd_user,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket

);

$insert = $this->MPenerimaan_jarum->createPenerimaan_jarum($data);

$jml = $this->MJarum->getjumlah($kd_jarum);

$tmp = $jml->jumlah + $jumlah;

$j = array(
	'jumlah'		=>$tmp
);

$update = $this->MJarum->updateJarum($kd_jarum,'Jarum',$j);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Penerimaan_jarum')); 

 }else{

 	$data['no_tr_jarum']	=	$this->MPenerimaan_jarum->get_no_tr_jarum();

	$data['result1']		=	$this->MJarum->readJarum();

	$data['result2']		=	$this->MVendorjarum->readVendorjarum();

//	$data['result3']	=	$this->MGudang->readGudang();

 	$this->load->view('Kesma/VFormpenerimaanjarum',$data);

 }

}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($no_tr_jarum){

	//$status			=0;

//insert into database
 //	$data = array(

	//'status'		=>$status,

 	//	);
 	$kd_jarum = $this->MPenerimaan_jarum->getkd_jarum($no_tr_jarum);
 	$jumlah	  = $kd_jarum->jumlah;

 	$jml = $this->MJarum->getjumlah($kd_jarum->kd_jarum);

$tmp = $jml->jumlah - $jumlah;

$j = array(
	'jumlah'		=>$tmp
);

$update = $this->MJarum->updateJarum($kd_jarum->kd_jarum,'Jarum',$j);

$delete = $this->MPenerimaan_jarum->deletePenerimaan_jarum($no_tr_jarum, 'penerimaan_jarum');

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dihapus </div>');

 	redirect(base_url('Penerimaan_jarum')); 

 }

 //fungsi untuk cetak surat jalan penerimaan kainjadi
 function cetakProses($no_tr_jarum){

  $data['result']       = $this->MPenerimaan_jarum->getById($no_tr_jarum);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Penerimaan-jarum.pdf.";

  $this->pdf->load_view('Lap/VLapJarumMasuk', $data);

 //$this->load->view('Lap/VLapPenerimaanBenang', $data);
}


}

?>