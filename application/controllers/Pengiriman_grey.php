<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengiriman_grey extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MPengiriman_grey');

   $this->load->model('MStock_kain');

   $this->load->model('MPartai');

   $this->load->model('MSubcon');

   $this->load->model('MGrey');

   $this->load->model('MMesin');

   $this->load->model('MGudang');

   $this->load->model('MCustomer');

   $this->load->model('MUser');

   $this->load->library('session');

 }
 

//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MPengiriman_grey->readPengiriman_grey();

	$data['retur'] 		    = 	$this->MPengiriman_grey->readReturPengiriman_grey();

	$data['result0']		=	$this->MStock_kain->getAllGrey();

	$data['result1']		=	$this->MPengiriman_grey->get_no_tr_maklun();

	$data['result2']		=	$this->MPartai->getKd_partai();

	$data['result3']		=	$this->MSubcon->readSubcon();

	$this->load->view('Kesma/VPengirimangrey',$data);

 }

 //fungsi tampilan index
function returIndex(){

	$data['result'] 		= 	$this->MPengiriman_grey->readPengiriman_grey();

	$data['retur'] 		    = 	$this->MPengiriman_grey->readReturPengiriman_grey();

	$data['result0']		=	$this->MStock_kain->getAllGrey();

	$data['result1']		=	$this->MPengiriman_grey->get_no_tr_maklun();

	$data['result2']		=	$this->MPartai->getKd_partai();

	$data['result3']		=	$this->MSubcon->readSubcon();

	$this->load->view('Kesma/VReturPengirimangrey',$data);

 }

//fungsi untuk tampilan create
function create(){

	$data['result'] 		= 	$this->MPengiriman_grey->readPengiriman_grey();

	$data['result0']		=	$this->MStock_kain->getAllGrey();

	$data['result1']		=	$this->MPengiriman_grey->get_no_tr_maklun();

	$data['result2']		=	$this->MPartai->getKd_partai();

	$data['result3']		=	$this->MSubcon->readSubcon();

	$data['result4']		=	$this->MPartai->readPartaiByT();

	$data['result5']		=	$this->MGrey->readGrey();

	$data['result6']		=	$this->MStock_kain->getKainGramasi();

	$data['result7']	    =   $this->MStock_kain->getGramasi();

	$this->load->view('Kesma/VFormpengirimangrey',$data);

}

//fungsi proses post create kirim grey
function createProses(){

	$this->form_validation->set_rules('kd_subcon','kd_subcon','required');

	//$this->form_validation->set_rules('kd_customer','kd_customer','required');

	$this->form_validation->set_rules('no_mobil','no_mobil','required');

	$this->form_validation->set_rules('nm_supir','nm_supir','required');

	if($this->form_validation->run() != false){

	//untuk pengiriman grey
	$no_tr_maklun	= $this->MPengiriman_grey->get_no_tr_maklun();

	$tgl			= $this->MPengiriman_grey->getDate();

	$kd_subcon		= $this->input->post('kd_subcon');

	$no_mobil		= $this->input->post('no_mobil');

	$nm_supir		= $this->input->post('nm_supir');

	$ket			= $this->input->post('ket');

	$kd_user		= $this->session->userdata('kd_user');

	//ambil data tr grey dari partai tb
	$list_grey  	= $this->MPartai->list_grey($no_tr_maklun)->result();

	foreach($list_grey AS $row){

		$list_grey1[]=$row->no_tr_grey;

	};

	$no_tr_grey		= implode(';',$list_grey1);

	$jumlah			= count($list_grey);

	echo $jumlah;
	
	//untuk stock_kain
	$kd_customer 	= $this->input->post('kd_customer');

	$no_wo      	= $this->input->post('no_wo');

//data untuk tabel pengiriman grey
$data=array(	

	'no_tr_maklun'	=>$no_tr_maklun,

	'tgl'			=>$tgl,

	'no_tr_grey'	=>$no_tr_grey,

	'kd_subcon'		=>$kd_subcon,

	'kd_customer'	=>$kd_customer,

	'no_wo'			=>$no_wo,

	'no_mobil'		=>$no_mobil,

	'nm_supir'		=>$nm_supir,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket,

	'kd_user'		=>$kd_user

);

//status untuk partai tb M (Maklun)
$data1			= array(

	'kd_subcon' =>  $kd_subcon,

	'status' 	=> 'M',

);

//update  stock_kain
$data2				= array(

	'no_tr_maklun' 	=> $no_tr_maklun,

	'kd_subcon' 	=> $kd_subcon,

);

$insert       = $this->MPengiriman_grey->createPengiriman_grey($data);

$updatePartai = $this->MPartai->updateStatusPartai($no_tr_maklun,'partai_tb',$data1);

//update stock_kain tabel mengisikan kd_customer dan no_wo
for($x=0;$x<$jumlah;$x++){

	$key = $list_grey1[$x];

    $updateStock   = $this->MStock_kain->updateStock_kain($key,'stock_kain',$data2);

}

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Pengiriman_grey')); 

}else{

	redirect(base_url('Pengiriman_grey/create'));
}

}

//fungsi untuk batal penerimaan pengiriman
//hapus tr grey di partai berdasar tr maklun jika status masih M jika sudah f tidak bisa
//set NULL kd_subcon,no_tr_maklun, jika status kain masih M
function batalProses($no_tr_maklun){
	//data yang diperlukan
	// status tr_grey di tabel partai
	//status kain di tabel stock kain

	//ambil data tr_grey dari partai tb
	$key = array(

		'partai_tb.no_tr_maklun'=> $no_tr_maklun

	);

	$hs     = $this->MPartai->getByKey1($key);

	foreach($hs AS $row){

		 $no_tr_grey[] = $row->no_tr_grey;

	}

	$jumlah         = count($hs);

//insert into database
 	$data = array(

	'status'		=>'0',

 		);

 	 $data1 = array(

 	'kd_subcon'		=>NULL,

 	'no_tr_maklun'	=>NULL, 	

	'status'		=>'G',

 		);

$update 		= $this->MPengiriman_grey->batalPengiriman_grey($no_tr_maklun, 'kirimgrey_tb', $data);

$delete 		= $this->MPartai->deleteMaklun($no_tr_maklun);

//update stock beri nilai null pada no tr maklun dan kd subcon dan status ubah jadi G
for($x=0;$x<$jumlah;$x++){

    $updateStock   = $this->MStock_kain->updateStock_kain($no_tr_grey[$x],'stock_kain',$data1);

}

$update 		= $this->MPengiriman_grey->batalPengiriman_grey($no_tr_maklun, 'kirimgrey_tb', $data);

$delete 		= $this->MPartai->deleteMaklun($no_tr_maklun);

$this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dibatalkan </div>');

 	redirect(base_url('Pengiriman_grey')); 

}

function batalProsesRetur($no_tr_maklun){
	//data yang diperlukan
	// status tr_grey di tabel partai
	//status kain di tabel stock kain

	//ambil data tr_grey dari partai tb
		$key = array(

		'partai_tb.no_tr_maklun'=> $no_tr_maklun

	);

	$hs     = $this->MPartai->getByKey1($key);

	foreach($hs AS $row){

		 $no_tr_grey[] = $row->no_tr_grey;

	}

	$jumlah         = count($hs);

//insert into database
 	$data = array(

	'status'		=>'0',

 		);

 	 $data1 = array(

	'status'		=>'F',

 		);

$update 		= $this->MPengiriman_grey->batalPengiriman_grey($no_tr_maklun, 'kirimgrey_tb', $data);

$update_partai 		= $this->MPartai->updateStatusPartai($no_tr_maklun,'partai_tb',$data1);

//update stock beri nilai null pada no tr maklun dan kd subcon dan status ubah jadi G
for($x=0;$x<$jumlah;$x++){

$updateStock   = $this->MStock_kain->updateStock_kain($no_tr_grey[$x],'stock_kain',$data1);

}

$this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dibatalkan </div>');

 	redirect(base_url('Pengiriman_grey/returIndex')); 

}


public function cetakProses($no_tr_maklun){

	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);

	$key 	= array('stock_kain.no_tr_maklun'=>$no_tr_maklun);

	$data['partai']		    =	$this->MStock_kain->getAllByKey1($key);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Pengiriman-grey.pdf.";

  $this->pdf->load_view('Lap/VLapPengirimangrey', $data);

//$this->load->view('Lap/VLapPengirimangrey', $data);

}

//untuk cetak detal pengiriman grey
public function cetakDetailProses($no_tr_maklun){

	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);

	$data['partai']		    =	$this->MStock_kain->getAllByKey1(array('stock_kain.no_tr_maklun'=>$no_tr_maklun));
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Detail-Pengiriman-grey.pdf.";

  $this->pdf->load_view('Lap/VLapDetailPengirimangrey', $data);

//$this->load->view('Lap/VLapDetailPengirimangrey', $data);

}

public function cetakProsesRetur($no_tr_maklun){

	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);

	$key 	= array('stock_kain.no_tr_maklun'=>$no_tr_maklun);

	$data['partai']		    =	$this->MStock_kain->getAllByKey($key);
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Retur-Pengiriman-grey.pdf.";

  $this->pdf->load_view('Lap/VLapReturPengirimangrey', $data);

//$this->load->view('Lap/VLapPengirimangrey', $data);

}

//untuk cetak detal pengiriman grey
public function cetakDetailProsesRetur($no_tr_maklun){

	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);

	$data['partai']		    =	$this->MStock_kain->getAllByKey(array('stock_kain.no_tr_maklun'=>$no_tr_maklun));
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Detail-Retur-Pengiriman-grey.pdf.";

  $this->pdf->load_view('Lap/VLapDetailReturPengirimangrey', $data);

//$this->load->view('Lap/VLapDetailPengirimangrey', $data);

}

//fungsi untuk tampil laporan pengiriman grey
function laporan(){

	$data['result'] = $this->MPengiriman_grey->getAll();

	$this->load->view('Lap-transaksi/VLapPengirimangrey',$data);

}

//fungsi untuk filter laporan pengiriman berdasarkan tanggal
function laporanFilter(){

	$tglAwal  = $this->input->post('tglawal');

	$tglAkhir = $this->input->post('tglakhir');

	$key = array(

		'tgl >='=> $tglAwal,

		'tgl <='=> $tglAkhir

	);

	$this->session->set_flashdata('tglAwal',$tglAwal);

    $this->session->set_flashdata('tglAkhir',$tglAkhir);

	$data['result']  = $this->MPengiriman_grey->getByRangeTgl($key);

	$this->load->view('Lap-transaksi/VLapPengirimangrey',$data);	


}

 //fungsi untuk tampil laporan produksi
function reset(){

redirect(base_url('Pengiriman_grey/laporan')); 

}

//untuk tampilan form retur /celup ulang
function retur(){

	$key  = array(

		'partai_tb.status' => 'F'

	);

	$key1  = array(

		'partai_tb.status' => 'R',

		'kd_user'          => $this->session->userdata('kd_user')

	);

	$data['result'] 		= 	$this->MPengiriman_grey->readPengiriman_grey();

	$data['list'] 		    = 	$this->MPartai->getListNoPartai($key1);

	$data['partai'] 		= 	$this->MPartai->getListNoPartai($key);

	$data['result0']		=	$this->MStock_kain->getAllGrey();

	$data['result1']		=	$this->MPengiriman_grey->get_no_tr_maklun();

	$data['result3']		=	$this->MSubcon->readSubcon();

	$data['result5']		=	$this->MGrey->readGrey();

	$data['result6']		=	$this->MStock_kain->getKainGramasi();

	$data['result7']	    =   $this->MStock_kain->getGramasi();

	$this->load->view('Kesma/VFormReturPengirimangrey',$data);

}

function detailList($no_partai){

	$key  = array(

		'partai_tb.status' => 'R',

		'partai_tb.no_partai'        => $no_partai

	);

	$data['result']         = $this->MPartai->getbyKey($key);

	$this->load->view('Kesma/VDetailListReturPengirimangrey',$data);

}

 //fungsi untuk proses update record  partai_tb (data sementara penerimaan kain jadi)
 function createListRetur(){

  $no_tr_grey         = $this->input->post('no_tr_grey');//berisi array dari checkbox
  
  //print_r($no_tr_grey);
  //hitung jumlah tr gre yang dipilih
  $jumlah_dipilih = count($no_tr_grey);
 
 //buat perulangan untuk seva sejumlah tr grey yang dipilih
  for($x=0;$x<$jumlah_dipilih;$x++){
 
    $tr_grey      = $no_tr_grey[$x];

    $kd_user      = $this->session->userdata('kd_user');

    $data=array(
 
      'status'      => 'R',

      'kd_user'		=> $kd_user
 
    );

    $update=$this->MPartai->updatePartaiByTrGrey($tr_grey,'partai_tb',$data);
 
  }

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Pengiriman_grey/retur')); 
 
 }

  //fungsi delete list (update partai TB ke semula)
function deleteListRetur($no_partai){

  $kd_user          = $this->session->userdata('kd_user');
  
  $key=array(
  
    'no_partai'     => $no_partai,
  
    'kd_user'       => $kd_user,
  
    'status'        => 'R'
  
  );
  

  $data = array(
  
    'status'         => 'F',
  
    'kd_user'        => $kd_user,
  
  );
  

  $update=$this->MPartai->updatePartaiByKey($key,'partai_tb',$data);

   redirect(base_url('Pengiriman_grey/retur')); 

 }

//fungsi untuk proses retur ke maklun
function returProses(){
  
    $this->form_validation->set_rules('kd_subcon','kd_subcon','required');

	//$this->form_validation->set_rules('kd_customer','kd_customer','required');

	$this->form_validation->set_rules('no_mobil','no_mobil','required');

	$this->form_validation->set_rules('nm_supir','nm_supir','required');

	if($this->form_validation->run() != false){

	//untuk pengiriman grey
	$no_tr_maklun	= $this->MPengiriman_grey->get_no_tr_maklun();

	$tgl			= $this->MPengiriman_grey->getDate();

	$kd_subcon		= $this->input->post('kd_subcon');

	$no_mobil		= $this->input->post('no_mobil');

	$nm_supir		= $this->input->post('nm_supir');

	$ket			= $this->input->post('ket');

	$kd_user		= $this->session->userdata('kd_user');

	$key = array(

		'partai_tb.status' => 'R',

		'partai_tb.kd_user' => $this->session->userdata('kd_user')

	);

	//ambil data tr grey dari partai tb
	$list_grey  	= $this->MPartai->getByKey($key);

	foreach($list_grey AS $row){

		$list_grey1[]=$row->no_tr_grey;
		$no_partai   =$row->no_partai;

	};

	$no_tr_grey		= implode(';',$list_grey1);

	$jumlah			= count($list_grey);

	//echo $jumlah;
	
//data untuk tabel pengiriman grey
$data=array(	

	'no_tr_maklun'	=>$no_tr_maklun,

	'tgl'			=>$tgl,

	'no_tr_grey'	=>$no_tr_grey,

	'kd_subcon'		=>$kd_subcon,

	'no_mobil'		=>$no_mobil,

	'nm_supir'		=>$nm_supir,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket,

	'kd_user'		=>$kd_user,

	'status'		=>'R'

);

//status untuk partai tb M (Maklun)
$data1			= array(

	'no_tr_maklun' 	=> $no_tr_maklun,

	'kd_partai' 	=> $no_partai,

	'status' 	=> 'M',

);

//update  stock_kain
$data2				= array(

	'no_tr_maklun' 	=> $no_tr_maklun,

	'kd_partai' 	=> $no_partai,

	'status' 	    => 'M',

);

$insert       = $this->MPengiriman_grey->createPengiriman_grey($data);

//update stock_kain tabel mengisikan kd_customer dan no_wo
for($x=0;$x<$jumlah;$x++){

	$key = $list_grey1[$x];

    $updateStock   = $this->MStock_kain->updateStock_kain($key,'stock_kain',$data2);

    $updatePartai = $this->MPartai->updatePartaiByTrGrey($key,'partai_tb',$data1);

}

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Pengiriman_grey/returIndex')); 

}else{

	redirect(base_url('Pengiriman_grey/retur'));
 }

}

public function listGrey(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_kaingramasi     = $this->input->post('kd_kain');

    $kd_kain 			= substr($kd_kaingramasi,0,4);

    $gramasi            = substr($kd_kaingramasi,4);

    $key=array(
    
    	'stock_kain.kd_kain'=>$kd_kain,
    
    	'gramasi'=>$gramasi

    );
    
    $no_tr_grey  = $this->MStock_kain->getTrByKey($key);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<input type='hidden' value='' required>Silahkan Pilih</input>";
    $no=1;
    foreach($no_tr_grey as $data){
    
      $lists .= "<h5>".$no." "."<input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'><b>".SUBSTR($data->no_tr_grey,0,3)."-".SUBSTR($data->no_tr_grey,3,2)."-".SUBSTR($data->no_tr_grey,5)."</b> | ".$data->nm_kain." | ".$data->gramasi." |  ".number_format($data->kg_grey,2)." Kg | WO ".$data->no_wo." | ".$data->nm_customer."</input></h5>"; // Tambahkan tag option ke variabel $lists

      		$no++;
    
    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  
  }


  //fungsi untuk mengambil list wo berdasar
  public function listWo(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_kaingramasi     = $this->input->post('kd_kain');

    $kd_kain 			= substr($kd_kaingramasi,0,4);
  
    $gramasi            = substr($kd_kaingramasi,4);

    $key=array(
  
    	'kd_kain' => $kd_kain
  
    );

    $no_tr_grey  = $this->MPartai->getBykey($key);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<input type='hidden' value='' required>Silahkan Pilih</input>";
    
    foreach($no_tr_grey as $data){
  
      $lists .= "<h4><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>".$data->no_tr_grey."</input></h4>"; // Tambahkan tag option ke variabel $lists
  
    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
  
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  
  }

  public function listGreyRetur(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $no_partai          = $this->input->post('no_partai');

	$key  = array(

		'partai_tb.status'   => 'F',

		'partai_tb.no_partai'=> $no_partai

	);
    
    $no_tr_grey  = $this->MPartai->getByKey($key);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<input type='hidden' value='' required>Silahkan Pilih</input>";
    
    foreach($no_tr_grey as $data){
    
      $lists .= "<h5><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>".$data->no_tr_grey." | ".$data->nm_kain." Setting ".$data->setting."   W/".$data->nm_warna."</input></h5>"; // Tambahkan tag option ke variabel $lists
    
    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  
  }

}

?>