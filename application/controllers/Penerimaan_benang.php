<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_benang extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MPenerimaan_benang');

   $this->load->model('MBenang');

   $this->load->model('MVendor');

   $this->load->model('MGudang');

   $this->load->library('form_validation');

   $this->load->model('MUser');

   $this->load->library('session');

 }

//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MPenerimaan_benang->readPenerimaan_benang();

	$this->load->view('Kesma/Vpenerimaanbenang', $data);

 }

//fungsi untuk tampil laporan produksi
function laporan(){

	$data['result'] = $this->MPenerimaan_benang->getAll();

	$this->load->view('Lap-transaksi/VLapPenerimaanbenang',$data);

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

	$data['result'] = $this->MPenerimaan_benang->getByKey($key); 

	$this->load->view('Lap-transaksi/VLapPenerimaanbenang',$data);	

}
//untuk reset laporan filter
function reset(){

	redirect(base_url('Penerimaan_benang/laporan')); 

}
 
//fungsi untuk tampilan create
function create(){

	$data['no_tr_benang']	=	$this->MPenerimaan_benang->get_no_tr_benang();

	$data['result1']	=	$this->MBenang->readBenang();

	$data['result2']	=	$this->MVendor->readVendor();

	$data['result3']	=	$this->MGudang->readGudang();

	$this->load->view('Kesma/VFormpenerimaanbenang',$data);

}

//untuk menampilkan data yang akan dibatalkan
 function bataltampil($no_tr_benang){

 	$this->db->where('no_tr_benang', $no_tr_benang);

 	$query = $this->db->get('penerimaan_benang_tb');

 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);

 }

//fungsi proses post create penerimaan
function createProses(){

	$this->form_validation->set_rules('kd_jenis','kd_jenis','required');

	$this->form_validation->set_rules('kd_vendor','kd_vendor','required');

	$this->form_validation->set_rules('kd_gudang','kd_gudang','required');

	$this->form_validation->set_rules('jumlah','jumlah','required');

	if($this->form_validation->run() !=false){

	$no_tr_benang	=$this->MPenerimaan_benang->get_no_tr_benang();//$this->input->post('no_tr_benang');

	$tgl			=$this->MPenerimaan_benang->getDate();//$this->input->post('tgl');

	$kd_jenis		=$this->input->post('kd_jenis');

	$kd_vendor		=$this->input->post('kd_vendor');

	$kd_gudang		=$this->input->post('kd_gudang');

	$kd_user		=$this->session->userdata('kd_user');

	$jumlah			=$this->input->post('jumlah');

	$ket			=$this->input->post('ket');

$data=array(	

	'no_tr_benang'	=>$no_tr_benang,

	'tgl'			=>$tgl,

	'kd_jenis'		=>$kd_jenis,

	'kd_vendor'		=>$kd_vendor,

	'kd_gudang'		=>$kd_gudang,

	'kd_user'		=>$kd_user,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket

);

$insert = $this->MPenerimaan_benang->createPenerimaan_benang($data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Penerimaan_benang')); 

 }else{

 	$data['no_tr_benang']	=	$this->MPenerimaan_benang->get_no_tr_benang();

	$data['result1']	=	$this->MBenang->readBenang();

	$data['result2']	=	$this->MVendor->readVendor();

	$data['result3']	=	$this->MGudang->readGudang();

 	$this->load->view('Kesma/VFormpenerimaanbenang',$data);

 }

}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($no_tr_benang){

	$status			=0;

//insert into database
 	$data = array(

	'status'		=>$status,

 		);

$update = $this->MPenerimaan_benang->batalPenerimaan_benang($no_tr_benang, 'penerimaan_benang_tb', $data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Penerimaan_benang')); 

 }

 //fungsi untuk cetak surat jalan penerimaan kainjadi
 function cetakProses($no_tr_benang){

  $data['result']       = $this->MPenerimaan_benang->getById($no_tr_benang);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Penerimaan-benang.pdf.";

  $this->pdf->load_view('Lap/VLapPenerimaanBenang', $data);

 //$this->load->view('Lap/VLapPenerimaanBenang', $data);
}


}

?>