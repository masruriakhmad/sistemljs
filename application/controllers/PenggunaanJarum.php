<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PenggunaanJarum extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MPenggunaanjarum');

   $this->load->model('MJarum');

   $this->load->model('MMesin');

   //$this->load->model('MVendorjarum');

   //$this->load->model('MGudang');

   $this->load->library('form_validation');

   $this->load->model('MUser');

   $this->load->library('session');

 }

//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MPenggunaanjarum->readPenggunaan_jarum();

	$this->load->view('Kesma/VPenggunaanjarum', $data);

 }

//fungsi untuk tampil laporan produksi
function laporan(){

	$data['result'] = $this->MPenggunaanjarum->getAll();

	$this->load->view('Lap-transaksi/VLapPenggunaanjarum',$data);

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

	$data['result'] = $this->MPenggunaanjarum->getByKey($key); 

	$this->load->view('Lap-transaksi/VLapPenggunaanjarum',$data);	

}
//untuk reset laporan filter
function reset(){

	redirect(base_url('Penggunaanjarum/laporan')); 

}
 
//fungsi untuk tampilan create
function create(){

	$data['no_tr_pakaijarum']	=	$this->MPenggunaanjarum->get_no_tr_pakaijarum();

	$data['list_transaksi']		=	$this->MPenggunaanjarum->getByKey($data);

	$data['result1']			=	$this->MJarum->readJarum();

	$data['result2']			=	$this->MMesin->readMesin();

//	$data['result2']	=	$this->MVendorjarum->readVendorjarum();

//	$data['result3']	=	$this->MGudang->readGudang();

	$this->load->view('Kesma/VFormPenggunaanjarum',$data);

}

//untuk menampilkan data yang akan dibatalkan
 function bataltampil($no_tr_pakaijarum){

 	$this->db->where('no_tr_jarum', $no_tr_benang);

 	$query = $this->db->get('penerimaan_jarum');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);

 }

//fungsi proses post create penerimaan
function createProses(){

	$this->form_validation->set_rules('kd_jarum','kd_jarum','required');

	$this->form_validation->set_rules('kd_mesin','kd_mesin ','required');

//	$this->form_validation->set_rules('kd_gudang','kd_gudang','required');

	$this->form_validation->set_rules('jumlah','jumlah','required');

	if($this->form_validation->run() !=false){

	$no_tr_pakaijarum	=$this->input->post('no_tr_pakaijarum');//$this->input->post('no_tr_benang');

	$tgl			=$this->MPenggunaanjarum->getDate();//$this->input->post('tgl');

	$kd_jarum		=$this->input->post('kd_jarum');

	$kd_mesin		=$this->input->post('kd_mesin');

//	$kd_vendorjarum	=$this->input->post('kd_vendorjarum');

//	$kd_gudang		=$this->input->post('kd_gudang');

	$kd_user		=$this->session->userdata('kd_user');

	$jumlah			=$this->input->post('jumlah');

	$pengguna 		=$this->input->post('pengguna');

	$ket			=$this->input->post('ket');

$data=array(	

	'no_tr_pakaijarum'	=>$no_tr_pakaijarum,

	'tgl'			=>$tgl,

	'kd_jarum'		=>$kd_jarum,

	'kd_mesin'		=>$kd_mesin,

//	'kd_vendorjarum'=>$kd_vendorjarum,

//	'kd_gudang'		=>$kd_gudang,

	'kd_user'		=>$kd_user,

	'subjumlah'		=>$jumlah,

	'pengguna'		=>$pengguna,

	'ket'			=>$ket

);

$insert = $this->MPenggunaanjarum->createPenggunaan_jarum($data);

$jml = $this->MJarum->getjumlah($kd_jarum);

$tmp = $jml->jumlah - $jumlah;

$j = array(
	'jumlah'		=>$tmp
);

$update = $this->MJarum->updateJarum($kd_jarum,'Jarum',$j);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

	$datab['no_tr_pakaijarum']	=	$no_tr_pakaijarum;

	$datab['pengguna']			=	$pengguna;

	$key = array( 'no_tr_pakaijarum' => $no_tr_pakaijarum);

	$datab['list_transaksi']		=	$this->MPenggunaanjarum->getByKey($key);

	$datab['result1']			=	$this->MJarum->readJarum();

	$datab['result2']			=	$this->MMesin->readMesin();

//	$data['result2']	=	$this->MVendorjarum->readVendorjarum();

//	$data['result3']	=	$this->MGudang->readGudang();

	$this->load->view('Kesma/VForMPenggunaanjarum',$datab);

 	//redirect(base_url('Penggunaanjarum')); 

 }else{

 	$data['no_tr_jarum']	=	$this->MPenggunaanjarum->get_no_tr_jarum();

	$data['result1']		=	$this->MJarum->readJarum();

//	$data['result2']		=	$this->MVendorjarum->readVendorjarum();

//	$data['result3']	=	$this->MGudang->readGudang();

 	$this->load->view('Kesma/VForMPenggunaanjarum',$data);

 }

}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($id){

	//$status			=0;

//insert into database
 	//$data = array(
//
	//'status'		=>$status,

 	//	);

$kd = $this->MPenggunaanjarum->getkd_jarum($id);

$jumlah = $kd->subjumlah;

 $jml = $this->MJarum->getjumlah($kd->kd_jarum);

$tmp = $jml->jumlah + $jumlah;

$j = array(
	'jumlah'		=>$tmp
);

$update = $this->MJarum->updateJarum($kd->kd_jarum,'Jarum',$j);

$delete = $this->MPenggunaanjarum->deletePenggunaan_jarum($id, 'penggunaan_jarum');

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dihapus </div>');

 	redirect(base_url('PenggunaanJarum')); 

 }

 //fungsi untuk cetak surat jalan penerimaan kainjadi
 function cetakProses($no_tr_pakaijarum){

  $data['result']       = $this->MPenggunaanjarum->getById($no_tr_pakaijarum);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Penerimaan-jarum.pdf.";

  $this->pdf->load_view('Lap/VLapJarumMasuk', $data);

 //$this->load->view('Lap/VLapPenerimaanBenang', $data);
}


}

?>