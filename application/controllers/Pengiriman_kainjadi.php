<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengiriman_kainjadi extends CI_Controller {

 function __construct()

 {

   parent::__construct();
   //load model yang diperlukan

   $this->load->helper('url');

   $this->load->model('MPengiriman_kainjadi');

   $this->load->model('MStock_kain');

   $this->load->model('MSubcon');

   $this->load->model('MPartai');

   $this->load->model('MGrey');

   $this->load->model('MMesin');

   $this->load->model('MGudang');

   $this->load->model('MCustomer');

   $this->load->model('MProduksi');

   $this->load->model('MUser');

   $this->load->model('MWo');

   $this->load->library('session');

   $this->load->library('form_validation');

 }


//fungsi tampilan index
function index(){

	$data['result'] 		= 	$this->MPengiriman_kainjadi->readPengiriman_kainjadi();

	$data['no_jual']	    =	$this->MPengiriman_kainjadi->get_no_jual();

	$data['getDate']		=	$this->MPengiriman_kainjadi->getDate();

	$this->load->view('Kesma/VPengirimanKainjadi', $data);

 }

 //fungsi detail pengiriman kainjadi
 function detailPengirimanKainjadi($no_jual){

 	$data ['result'] = $this->MStock_kain->getAllByKey(array('no_jual'=>$no_jual));

 	$this->load->view('Kesma/VDetailPengirimanKainjadi',$data);


 }

 //fungsi list detail pengiriman kainjadi (saat create pengiriman kainjadi)
 function detalListPengirimanKainjadi(){


 }
 
//fungsi untuk tampilan create pengiriman kain jadi
 //filter by customer
	//filter by no wo
	//muncul nama kain
	//muncul list grey
	//pilih memlalui check box
	//pengiriman bisa multi wo
	//dan ada detail list pengiriman saaat kirim
	//ada detail pengiriman
	//bisa cetak
	//diatas bilai dilakukan manual

	//jika dengan scanner
	//texbox untuk scan
	//data langsung ke input dibawahnya
	//tampilan data bisa dihapus
	//data no_tr_grey, nama kain gramasi warna setting,no wo,nm customer
	//bila sudah langsung disave 
	//bisa dicancel
function create(){
	
	$kd_user     = $this->session->userdata('kd_user'); 
	
	$key=array(
	
		'partai_tb.status' => 'P2',
	
		'partai_tb.kd_user'=> $kd_user
	
	);

	$status = 'F';

	$data['no_jual']	=	$this->MPengiriman_kainjadi->get_no_jual();
	
	$data['result']	    =	$this->MPartai->getByKey($key);//status buffer (proses) P2 proses jual P1 proses kirim maklun
	
	$data['customer']	=	$this->MCustomer->readCustomer();

	$data['partai']	    =	$this->MPartai->getByStatus($status);

	$this->load->view('Kesma/VFormPengirimankainjadi',$data);

}

function coba1(){

	$key=array(
	
			'partai_tb.status' => 'P2',
	
			'partai_tb.kd_user'=> $this->session->userdata('kd_user')
	
		);

		$cart = $this->MPartai->getByKey($key);

		foreach($cart AS $row){

			$no[]    = $row->no_tr_grey;
			$kg[]    = $row->kg_fin;
			$set[]   = $row->setting;
			$warna[] = $row->kd_warna;

		}

		echo implode(';', $no);
		echo count($no);

}
//fungsi proses post create pengiriman kainjadi
function createProses(){


	$this->form_validation->set_rules('no_jual','no_jual','required');

	$this->form_validation->set_rules('no_mobil','no_mobil','required');

	$this->form_validation->set_rules('supir','supir','required');

	
	if($this->form_validation->run() !=false){

	//ambil data partai dengan user sama dan status P2
	$key=array(
	
			'partai_tb.status' => 'P2',
	
			'partai_tb.kd_user'=> $this->session->userdata('kd_user')
	
		);

		$cart = $this->MPartai->getByKey($key);

		foreach($cart AS $row){

			$no[]    = $row->no_tr_grey;
			
			$kg[]    = $row->kg_fin;
			
			$set[]   = $row->setting;
			
			$warna[] = $row->kd_warna;

		}

	//masukkan ke variabel
	//inputkan ke stock kain

	$no_jual 		= $this->input->post('no_jual');

	$tgl    		= $this->MPengiriman_kainjadi->getDate();

	$kd_customer 	= $this->input->post('kd_customer1');

	$no_mobil 	 	= $this->input->post('no_mobil');

	$supir 		 	= $this->input->post('supir');

	$ket 		 	= $this->input->post('ket');

	$kd_user 		= $this->session->userdata('kd_user');

	$no_tr_grey		= implode(';',$no);

	$jumlah 		= count($no);

	$status 		= 'J';

		$data=array(	

	'no_jual'	 	=>$no_jual,

	'tgl'			=>$tgl,

	'kd_customer'	=>$kd_customer,

	'no_tr_grey'	=>$no_tr_grey,

	'no_mobil'	    =>$no_mobil,

	'supir '	    =>$supir,

	'jumlah'		=>$jumlah,

	'ket'			=>$ket,

	'kd_user' 		=>$kd_user

	);

//insert ke pengiriman kain jadi
$insert = $this->MPengiriman_kainjadi->createPengiriman_kainjadi($data);

//mengubah status pada stock kain menjadi J
for($x=0;$x<$jumlah;$x++){

	$key      = $no[$x];

	$kg_fin   = $kg[$x];

	$setting  = $set[$x];

	$kd_warna = $warna[$x];

	$data =array(

		'no_jual' => $no_jual,

		'kg_fin'  => $kg_fin,

		'setting' => $setting,

		'kd_warna'=> $kd_warna,

		'status'  => $status

	);

    $updateStock   = $this->MStock_kain->updateStock_kain($key,'stock_kain',$data);
   
    $updatePartai  = $this->MPartai->updatePartaiByNo_tr_grey($key,'partai_tb',array('no_jual'=>$no_jual,'status'=> $status));

}

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Pengiriman_kainjadi')); 	

}else{

	redirect(base_url('Pengiriman_kainjadi/create'));

}
	
}

//fungsi untuk create list jual (ubah dari partai tb) dari scanner
//nomor yang muncul hanya nomor yang telah diterima dari maklun
//jika nomor gulung belum status F beritahukan nomor gulung berada
function createListJual(){

	$no_tr_grey = $this->input->post('no_grey');
	//lookup di stock kain
	$lookup=$this->MStock_kain->getById($no_tr_grey);
	//jika status belum F
	if($lookup->status != 'F'){
	
	$this->session->set_flashdata('notif','<div class="alert alert-warning alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Barang belum digudang jadi ... silahkan cek kembali </div>');

 	redirect(base_url('Pengiriman_kainjadi/create')); 

	}
	//jika sudah F
	else{

	$kd_user    = $this->session->userdata('kd_user');

	$data=array(

		'status' => 'P2',

		'kd_user'=> $kd_user

	);

	$update = $this->MPartai->updatePartaiByNo_tr_grey($no_tr_grey,'partai_tb',$data);

	redirect(base_url('Pengiriman_kainjadi/create'));

	}

}

//fungsi untuk create list jual (ubah dari partai tb) manual dan multi insert
function createListJualMasal(){

	$no_tr_grey = $this->input->post('no_tr_grey');

	$kd_user    = $this->session->userdata('kd_user');

	$jumlah     = COUNT($no_tr_grey);

	$data=array(

		'status' => 'P2',

		'kd_user'=> $kd_user

	);

	for($x=0;$x<$jumlah;$x++){

	$key = $no_tr_grey[$x];

	$update = $this->MPartai->updatePartaiByNo_tr_grey($key,'partai_tb',$data);

    }

	redirect(base_url('Pengiriman_kainjadi/create'));

}

//fungsi untuk delete list jual (update status partai tb menjadi F lagi)
function deleteListJual($no_tr_grey){

		$data=array(

			'status'=> 'F'

		);

	$update = $this->MPartai->updatePartaiByNo_tr_grey($no_tr_grey,'partai_tb',$data);

		redirect(base_url('Pengiriman_kainjadi/create'));

}

//fungsi untuk delete list jual (update status partai tb menjadi F lagi) berdasar status P2 dan kd user
function deleteListJualMasal(){

		$kd_user = $this->session->userdata('kd_user');

		$key=array(

			'status' => 'P2',

			'kd_user'=> $kd_user

		);

		$data=array(

			'status' => 'F',

			'kd_user'=> $kd_user

		);

	$update = $this->MPartai->updatePartaiByKey($key,'partai_tb',$data);

		redirect(base_url('Pengiriman_kainjadi'));

}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($no_jual){
	
	$query 			= $this->MPengiriman_kainjadi->getById($no_jual);

	$list_grey  	= explode(';',$query->no_tr_grey);

	$jumlah     	= count($list_grey);

	$status_kain    ='F';

	$status			=0;

//update into database
 	$data = array(

	'status'		=>$status,

 		);
//update data di pengiriman kain jadi status jadi nol
$update = $this->MPengiriman_kainjadi->batalPengiriman_kainjadi($no_jual, 'kirimkainjadi_tb', $data);

	$data1    = array(

		'no_jual' => NULL,

		'status'  => 'F'

	);


$updateStock   = $this->MStock_kain->updateStock_kainByNo_jual($no_jual,'stock_kain',$data1);
   
$updatePartai  = $this->MPartai->updatePartaiByNo_jual($no_jual,'partai_tb',$data1);

/*
//mengembalikan status stok kain menjadi F (Finis tapi belum terjual)
for($x=0;$x<$jumlah;$x++){

	$key 	 = $no_tr_grey[$x];



}
*/

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Batalkan </div>');

 	redirect(base_url('Pengiriman_kainjadi')); 

 }

  //fungsi untuk cetak pengiriman kainjadi
 function cetakProses($no_jual){

  $data['detail']       = $this->MPengiriman_kainjadi->getById($no_jual);

  $data['partai']       = $this->MStock_kain->getAllByKey(array('no_jual'=>$no_jual));
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Pengiriman-kainjadi.pdf.";

  $this->pdf->load_view('Lap/VLapPengirimanKainjadi', $data);

//$this->load->view('Lap/VLapPengirimanKainjadi', $data);

 }

 //untuk cetak detal pengiriman grey
public function cetakDetailProses($no_jual){

	$data['detail']		    =	$this->MPengiriman_kainjadi->getById($no_jual);
	
	$data['partai']		    =	$this->MStock_kain->getAllByKey(array('no_jual'=>$no_jual));
  
  $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');

  $this->pdf->filename = "laporan-Detail-Pengiriman-kainjadi.pdf.";

  $this->pdf->load_view('Lap/VLapDetailPengirimanKainjadi', $data);

//$this->load->view('Lap/VLapDetailPengirimanKainjadi', $data);

}

//fungsi untuk tampil laporan penerimaan kain jadi
function laporan(){

  $data['result'] = $this->MPengiriman_kainjadi->getAll();

  $this->load->view('Lap-transaksi/VLapPengirimankainjadi',$data);

}

//fungsi untuk filter laporan penerimaan kai jadi berdasarkan tanggal
function laporanFilter(){

  $tglAwal  = $this->input->post('tglawal');

  $tglAkhir = $this->input->post('tglakhir');

  $key = array(

    'tgl >='=> $tglAwal,

    'tgl <='=> $tglAkhir

  );

  $this->session->set_flashdata('tglAwal',$tglAwal);

  $this->session->set_flashdata('tglAkhir',$tglAkhir);

  $data['result']  = $this->MPengiriman_kainjadi->getByRangeTgl($key);

  $this->load->view('Lap-transaksi/VLapPengirimankainjadi',$data);  


}

 //fungsi untuk tampil laporan produksi
function reset(){

redirect(base_url('Pengiriman_kainjadi/laporan')); 

}


//fungsi untuk menampilkan list WO difilter oleh customer
public function listWo(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_customer	= $this->input->post('kd_customer');

    $no_wo          = $this->MWo->getWOByCustomer($kd_customer)->result();

    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($no_wo as $data){

      $lists .= "<option value='".$data->no_wo."'>".$data->no_wo."</option>"; // Tambahkan tag option ke variabel $lists

    }
    
    $callback = array('list_no_wo'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

    echo json_encode($callback); // konversi varibael $callback menjadi JSON

  }


public function listTrGrey(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $no_partai              = $this->input->post('no_partai');
   
    $key = array(
    	'stock_kain.no_partai'  => $no_partai,
    	'partai_tb.status'     => 'F'
    );

    $no_tr_grey		   	= $this->MStock_kain->getKainjadiByKey($key)->result();
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = NULL;"<option value=''>Pilih</option>";
    
 foreach($no_tr_grey as $data){
   
      $lists .= "<h5><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>&nbsp".$data->no_tr_grey."&nbsp|&nbsp".$data->nm_kain."&nbsp|&nbsp".$data->gramasi."&nbsp|&nbsp".$data->setting."&nbsp|&nbsp".$data->kg_fin."&nbsp|&nbsp".$data->nm_warna."</input></h5>"; // Tambahkan tag option ke variabel $lists
   
    }
    
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

    echo json_encode($callback); // konversi varibael $callback menjadi JSON

  }

}

?>