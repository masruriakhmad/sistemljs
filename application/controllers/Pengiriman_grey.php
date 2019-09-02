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
	$data['result0']		=	$this->MStock_kain->getAllGrey();
	$data['result1']		=	$this->MPengiriman_grey->get_no_tr_maklun();
	$data['result2']		=	$this->MPartai->getKd_partai();
	$data['result3']		=	$this->MSubcon->readSubcon();

	$this->load->view('Kesma/VPengirimangrey',$data);

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

//untuk menampilkan data yang akan dibatalkan
 function bataltampil($no_tr_maklun){
 	$this->db->where('no_tr_maklun', $no_tr_maklun);
 	$query = $this->db->get('kirimgrey_tb');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('', $this->data);
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
	$no_tr_grey     = $this->MPartai->getByKey(array('partai_tb.no_tr_maklun'=>$no_tr_maklun));
	$jumlah         = count($no_tr_grey);


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
	$key = $no_tr_grey[$x]->no_tr_grey;
    $updateStock   = $this->MStock_kain->updateStock_kain($key,'stock_kain',$data1);
}

$this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dibatalkan </div>');

 	redirect(base_url('Pengiriman_grey')); 

}


public function cetakProses($no_tr_maklun){


	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);
	$data['partai']		    =	$this->MStock_kain->getAllByKey(array('no_tr_maklun'=>$no_tr_maklun));

  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');
  $this->pdf->filename = "laporan-Pengiriman-grey.pdf.";
  $this->pdf->load_view('Lap/VLapPengirimangrey', $data);
//$this->load->view('Lap/VLapPengirimangrey', $data);

}

//untuk cetak detal pengiriman grey
public function cetakDetailProses($no_tr_maklun){

	$data['detail']		    =	$this->MPengiriman_grey->getById($no_tr_maklun);
	$data['partai']		    =	$this->MStock_kain->getAllByKey(array('no_tr_maklun'=>$no_tr_maklun));

  
   $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');
  $this->pdf->filename = "laporan-Detail-Pengiriman-grey.pdf.";
  $this->pdf->load_view('Lap/VLapDetailPengirimangrey', $data);
//$this->load->view('Lap/VLapDetailPengirimangrey', $data);

}

public function listGrey(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_kaingramasi     = $this->input->post('kd_kain');

    $kd_kain 			= substr($kd_kaingramasi,0,4);
    $gramasi            = substr($kd_kaingramasi,4);


    $key=array(
    	'kd_kain'=>$kd_kain,
    	'gramasi'=>$gramasi

    );
    $no_tr_grey  = $this->MStock_kain->getTrByKey($key);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<input type='hidden' value='' required>Silahkan Pilih</input>";
    
    foreach($no_tr_grey as $data){
      $lists .= "<h4><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>".$data->no_tr_grey."&nbsp(no WO&nbsp:&nbsp".$data->no_wo."&nbsp-->&nbsp".$data->nm_customer.")</input></h4>"; // Tambahkan tag option ke variabel $lists
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



}

?>