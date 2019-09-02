<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produksi extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   //load model yang diperlukan
   $this->load->helper('url');
   $this->load->model('MProduksi');
   $this->load->model('MPenerimaan_benang');
   $this->load->model('MStock_akhir_benang');
   $this->load->model('MMesin');
   $this->load->model('MCustomer');
   $this->load->model('MBenang');
   $this->load->model('MVendor');
   $this->load->model('MGudang');
   $this->load->model('MUser');
   $this->load->model('MGrey');
   $this->load->model('MWo');
   $this->load->model('MPenerimaan_grey');
   $this->load->model('MTop_up');
   $this->load->library('session');
 }

//fungsi tampilan index
function index(){
	 $data['result'] 		= $this->MProduksi->readProduksi();
	 $data['no_produksi']	= $this->MProduksi->get_no_produksi();
	 $this->load->view('Kesma/VProduksi', $data);

 }

//fungsi untuk tampilan create
function create(){
	$data['no_produksi']	=   $this->MProduksi->get_no_produksi();

	$data['result1']		=	$this->MStock_akhir_benang->readStock_akhir_benang();
	$data['result2']		=	$this->MMesin->readMesin();
	$data['result3']		=	$this->MGudang->readGudang();
	$data['result4']		=	$this->MWo->readWo();
	$data['result5']		=	$this->MGrey->readGrey();

	$this->load->view('Kesma/VFormProduksi', $data);
}

//untuk menampilkan data yang akan dibatalkan
 public function editProduksi($no_produksi){
 	$this->db->where('no_produksi', $no_produksi);
 	$data['edit'] 			=   $this->MProduksi->readProduksi()->row_array();
 	$data['result1']		=	$this->MStock_akhir_benang->readStock_akhir_benang();
	$data['result2']		=	$this->MMesin->readMesin();
	$data['result3']		=	$this->MGudang->readGudang();
	$data['result4']		=	$this->MWo->getWo();
	$data['result5']		=	$this->MGrey->readGrey();//jenis kain
	$data['result6']		=	$this->MPenerimaan_grey->get_no_tr_grey();
 	

 	$this->load->view('Kesma/VFormPenerimaangrey',$data);
 }

//fungsi proses post create penerimaan
function createProses(){

	$this->form_validation->set_rules('kd_benang','kd_benang','required');
	$this->form_validation->set_rules('kd_mesin','kd_mesin','required');
	$this->form_validation->set_rules('jumlah','jumlah','required');
	$this->form_validation->set_rules('kg','kg','required');

if($this->form_validation->run()!= false){

	$no_produksi	=$this->MProduksi->get_no_produksi();//$this->input->post('no_produksi');
	$tgl			=$this->MProduksi->getDate();//$this->input->post('tgl');
	$kd_benang		=$this->input->post('kd_benang');
	$kd_mesin		=$this->input->post('kd_mesin');
	$kd_gudang		='G002';//$this->input->post('kd_gudang');
	$kd_user		=$this->session->userdata('kd_user');
	$jumlah			=$this->input->post('jumlah');
	$kg 			=$this->input->post('kg');
	$hasilkg		=$jumlah*$kg;
	$ket			=$this->input->post('ket');

	$data  			=$this->MStock_akhir_benang->getById($kd_benang);
	$stock 			=$data->stock;

	if($stock<$hasilkg){

	redirect(base_url('Produksi/create'));

	}else{

	//simpan ke database
	$data=array(	
		'no_produksi'	=>$no_produksi,
		'tgl'			=>$tgl,
		'kd_benang'		=>$kd_benang,
		'kd_mesin'		=>$kd_mesin,
		'kd_gudang'		=>$kd_gudang,
		'kd_user'		=>$kd_user,
		'jumlah'		=>$jumlah,
		'kg'			=>$hasilkg,
		'kg_akhir'		=>$hasilkg,
		'ket'			=>$ket
	);
	//simpan ke topup
	$data1=array(
 		'tgl' 		 	=>$tgl,
 		'no_produksi'	=>$no_produksi,
 		'kd_benang'	 	=>$kd_benang,
 		'jumlah'     	=>$jumlah,
 		'kg' 		 	=>$hasilkg,
 		'ket' 			=>'Stock Awal',
 		'kd_user'    	=>$kd_user,
 		'status_topup'  =>'1',
 	);


$insert = $this->MProduksi->createProduksi($data);
$insert1= $this->MTop_up->createTop_up($data1);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Produksi')); 

	}

}else{

	redirect(base_url('Produksi/create'));

}

}
 

//fungsi menyelesaikan produksi dan mengembalikan sisa stok ke satok akhir benang
function selesaiProduksi($no_produksi){

$status			=0;
//insert into database
 	$data = array(

	'status'		=>$status

 		);
 	$key= array(

	'status_topup'	=>$status

 		);

$update      = $this->MProduksi->selesaiProduksi($no_produksi, 'produksi_tb', $data);
$updateTopup = $this->MTop_up->updateByNo_produksi($no_produksi, 'topup_produksi',$key);


$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Stock Berhasil dikembalikan ke Gudang Benang </div>');

	//kalkulasi pengembalian stock
	//pengambilan data produksi berdasarkan no produksi
	$this->db->where('no_produksi', $no_produksi);
 	$query 		= $this->db->get('produksi_tb');
 	$data 		= $this->data['edit'] = $query->row_array();

 	//data data yang dibutuhkan
 	$kd_mesin 	= $data['kd_mesin'];
 	$kd_benang1	= $data['kd_benang'];
 	$kg_akhir 	= $data['kg_akhir'];

 	//kode baru untuk sisa produksi yaitu kode jenis digabung dengan J000 ---> sisa produksi
 	$kd_jenis   = substr($kd_benang1,0,4);//<------jadi kode benang baru 
 	$kd_vendor  = 'V000';
 	$kd_gudang  = 'G001';
 	$kd_benang  = $kd_jenis.$kd_vendor;


 	//cek kode apakah sudah ada atau belum
 	//ambil nilai dari data base berdasar kode benang
 	$cari = $this->MStock_akhir_benang->getById($kd_benang);


 	//jika cari kurang dari 1 maka insert jika tidak maka update
 	if($cari== false){


 	 	//jika data tidak ada
 		$data=array(
 			'kd_benang'=>$kd_benang,
 			'kd_jenis' =>$kd_jenis,
 			'kd_vendor'=>$kd_vendor,
 			'kd_gudang'=>$kd_gudang,
 			'stock'    =>$kg_akhir,

 		);
 	//insert data stock akhir benang
 	$this->MStock_akhir_benang->createStock($data);

 	}else{
 	 		//jika data ada
 		 	//pengembalian stock benang
 	$ambilBenang= $this->MStock_akhir_benang->getById($kd_benang);
 	$stockAwal  = $ambilBenang->stock;
 	$stockAkhir = $stockAwal+$kg_akhir;

 	$stock=array(
 		'stock'=>$stockAkhir
 	);
 	//update data stock akhir benang
 	$this->MStock_akhir_benang->updateStock($kd_benang,'stock_akhir_benang',$stock);

 	}
 	

 	//mencari mesin yang aktif atau tidak
 	$query1 	= $this->db->query
 				("SELECT SUM(kg_akhir) as jumlah FROM produksi_tb WHERE status=1 AND kd_mesin='$kd_mesin'");
 	$data1	 	= $query1->result();
 	foreach ($data1 as $row){
 	$hasil= $row->jumlah;
 
}

//fungsi jika kg akhir dengan kd mesin tersebut jumlahnya nol maka mesin di reset
	if($hasil==0){
	$data=array(
		'kd_benang' => 0,
		'status_mesin' 	=> 0,

	);

	$this->MMesin->resetMesin($kd_mesin,'mesin_tb',$data);
	redirect(base_url('Produksi'));
}else{
	redirect(base_url('Produksi'));
}

}

function topUp($no_produksi){

	$data['produksi']	    =   $this->MProduksi->getById($no_produksi);
	//a,bil nilai kd benang berdasar nomor produksi
	$kd_benang              =   $data['produksi']->kd_benang;
	//ambil string kd jenis yaitu 4 digit awal
	$kd_jenis 				=   substr($kd_benang,0,4);
	//tampilkan stock berdasar kd jenis
	
	$key= array(
		'kd_benang'=>$kd_jenis
	);
	
	$data['result1']		=	$this->MStock_akhir_benang->getByKey($key);
	
	$this->load->view('Kesma/VFormTopUp',$data);
}

//fungsi untuk topup benang ke mesin
function topUpProses(){
	
	$no_produksi    = $this->input->post('no_produksi');
	$tgl 			= $this->MProduksi->getDate();
	$kd_benang 		= $this->input->post('kd_benang');
	$jumlah  		= $this->input->post('jumlah');
	$kg 	 		= $this->input->post('kg');
	$ket 			= $this->input->post('ket');
	$kd_user 		= $this->session->userdata('kd_user');
	$hasil_kg   	= $jumlah*$kg;

	//data produksi uang diperlukan
	//ambil dari tabel produksi
	$data['produksi'] = $this->MProduksi->getById($no_produksi);
	//jumlah cones
	$jml_cones_prod   = $data['produksi']->jumlah;
	//kg
	$kg_prod          = $data['produksi']->kg;
	//kg_akhir
	$kg_akhir_prod    = $data['produksi']->kg_akhir;

	//ambil stock dari benang
 	$ambilBenang=$this->MStock_akhir_benang->getById($kd_benang);
 	$stockAwal  =$ambilBenang->stock;
 	
 	

 	//percabangan jika hasil kg melebihi stock awal maka tolak jika tidak maka insert
 	if($hasil_kg>$stockAwal){

 		$this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Gagal total Kg melebihi Stock Benang </div>');

 		redirect(base_url('Produksi'));

 	}else{
 	$stockAkhir =$stockAwal-$hasil_kg;
 	
 	$data2=array(
 		'stock'=>$stockAkhir
 	);
 	//ipdate data stock akhir benang
 	$update=$this->MStock_akhir_benang->updateStock($kd_benang,'stock_akhir_benang',$data2);
 	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	$data=array(
 		'tgl' 		 	=>$tgl,
 		'no_produksi'	=>$no_produksi,
 		'kd_benang'  	=>$kd_benang,
 		'jumlah'     	=>$jumlah,
 		'kg' 		 	=>$hasil_kg,
 		'ket' 		 	=>$ket,
 		'kd_user'    	=>$kd_user,
 		'status_topup'  =>'1'
 	);

 	//hasil setelah topup
	//data dari produksi ditambah data topup
	//jumlah cones yang sedang diproduksi ditambah topup
	$jml_update         = $jml_cones_prod+$jumlah;
	//jumlah kg yang sedang diproduksi ditambah topup
	$kg_update          = $kg_prod+$hasil_kg;
	//jumlah kg_akhir yang sedang diproduksi ditambah topup
	$kg_akhir_update    = $kg_akhir_prod+$hasil_kg;
 	//masukkan ke tabel top up
 	$insert=$this->MTop_up->createTop_up($data);

 	$data_update=array(
 		'jumlah'     =>$jml_update,
 		'kg' 		 =>$kg_update,
 		'kg_akhir'   =>$kg_akhir_update,

 	);
	//update tabel produksi sesuai masukan
 	$update_produksi = $this->MProduksi->updateProduksi($no_produksi, 'produksi_tb', $data_update);
	//tampilkan notifikasi
	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');
	//redirect ke produksi
	redirect(base_url('Produksi'));


 	}


}


//fungsi untuk filter mesin yang non aktif dan bisa di top up
public function listMesin(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_benang_post = $this->input->post('kd_benang');
    $kd_benang 		= substr($kd_benang_post,1,3);
    $kd_mesin  = $this->MMesin->getMesinByKey($kd_benang);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($kd_mesin as $data){
      $lists .= "<option value='".$data->kd_mesin."'>".$data->no_mesin."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_mesin'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }


//fungsi untuk filter kain yang muncul berdasar kd jenis saat penerimaan grey
public function listKain(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_jenis = $this->input->post('kd_jenis');
    $kd_kain  = $this->MGrey->getKainByKey($kd_jenis);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih

    $lists = "<option value='".$this->session->flashdata('kd_kain')."'>".$this->session->flashdata('nm_kain')."</option>";

    foreach($kd_kain as $data){
      $lists .= "<option value='".$data->kd_kain."'>".$data->nm_kain."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_kain'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }



}

?>