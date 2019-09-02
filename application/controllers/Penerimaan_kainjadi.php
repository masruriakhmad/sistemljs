<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_kainjadi extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   //load model yang diperlukan
   $this->load->helper('url');
   $this->load->model('MPenerimaan_kainjadi');
   $this->load->model('MPengiriman_grey');
   $this->load->model('MStock_kain');
   $this->load->model('MGrey');
   $this->load->model('MPartai');
   $this->load->model('MMesin');
   $this->load->model('MGudang');
   $this->load->model('MCustomer');
   $this->load->model('MProduksi');
   $this->load->model('MSubcon');
   $this->load->model('MWarna');
   $this->load->model('MUser');
   $this->load->library('session');
 }


//fungsi tampilan index
function index(){
	
  $data['result'] 		= 	$this->MPenerimaan_kainjadi->readPenerimaan_kainjadi();
	$this->load->view('Kesma/VPenerimaankainjadi', $data);

 }

//detail penrimaan kainjadi
 function detailPenerimaanKainjadi($no_tr_kainjadi){

   $data['result']      = $this->MStock_kain->getByTrKainjadi($no_tr_kainjadi);
   $this->load->view('Kesma/VDetailterimakainjadi', $data);

 }
 //fungsi detail per partai saat create penerimaan
 function detailListTerimaKainjadi($kd_partai){

  $data['result']      = $this->MPartai->getByKd_partai($kd_partai);
  $this->load->view('Kesma/VDetailListTerimakainjadi', $data);

 }

//fungsi untuk tampilan create
function create(){

  $data['nomor']     = $this->MPenerimaan_kainjadi->get_no_tr_kainjadi();
  $data['result']    = $this->MPartai->readPartaiByP();//status buffer (proses)
	$data['result1']	 =	$this->MGudang->readGudang();
	$data['result2']	 =	$this->MSubcon->readSubcon();
	$data['warna']	   =	$this->MWarna->readWarna();

	$this->load->view('Kesma/VFormPenerimaankainjadi',$data);
}

//fungsi proses post create penerimaan kainjadi
function createProses(){

	$this->form_validation->set_rules('no_mobil','no_mobil','required');
	$this->form_validation->set_rules('supir','supir','required');
  
	if($this->form_validation->run() !=false){
    //ambil data dari partai tb dengan status p user sama dan no tr_kainjadi sama
    $no_tr_kainjadi = $this->input->post('no_tr_kainjadi');
    $data=$this->MPartai->getNo_greyByKainjadi($no_tr_kainjadi);

    foreach($data AS $row){
      $array_text[] = $row->no_tr_grey;
      $kd_subcon    = $row->kd_subcon;
      $kd_warna[]   = $row->kd_warna;
      $kg_fin[]     = $row->kg_fin;
      $setting[]    = $row->setting;
    }

	//untuk input ke table terima kainjadi
	
	 $tgl    		= $this->MPenerimaan_kainjadi->getDate();
	 $no_mobil 	= $this->input->post('no_mobil');
	 $supir 		 	= $this->input->post('supir');
	 $ket 		 	  = $this->input->post('ket');
	 $kd_user 		= $this->session->userdata('kd_user');

	//untuk tabel stock kain
	 $no_tr_grey	= implode(';',$array_text);
	 $jumlah 		  = count($array_text);
	 $kd_gudang   = 'G005';//$this->input->post('kd_gudang');
	 $status 		  = 'F';

		$data=array(	
	'no_tr_kainjadi'=>$no_tr_kainjadi,
	'tgl'			      =>$tgl,
	'kd_subcon'	    =>$kd_subcon,
	'no_mobil'	    =>$no_mobil,
	'supir '	      =>$supir,
	'jumlah'		    =>$jumlah,
	'no_tr_grey'	  =>$no_tr_grey,
	'ket'			      =>$ket,
	'kd_user' 		  =>$kd_user
	);

//update data pada stock kain dan status menjadi F
//mengubah status di partai tb menjadi F
for($x=0;$x<$jumlah;$x++){
	$key 				  = $array_text[$x];
	$kd_warna1 		= $kd_warna[$x];
	$kg_fin1 			= $kg_fin[$x];
	$setting1 		= $setting[$x];

	$data1 				= array(
		'no_tr_kainjadi'=> $no_tr_kainjadi,
		'kd_gudang' 	  => $kd_gudang,
		'kg_fin'		    => $kg_fin1,
		'setting'		    => $setting1,
		'kd_warna'		  => $kd_warna1,
		'status'		    => $status
	);

  $data2        = array(
    'status'    => $status
  );

    $updateStock   = $this->MStock_kain->updateStock_kain($key,'stock_kain',$data1);
    $updatePartai  = $this->MPartai->updatePartaiByNo_tr_grey($key,'partai_tb',$data2);
}

//insert ke pengiriman kain jadi
$insert = $this->MPenerimaan_kainjadi->createPenerimaan_kainjadi($data);
$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Penerimaan_kainjadi')); 	
  
}else{

	redirect(base_url('Penerimaan_kainjadi/create'));

}
	
}

//fungsi untuk batal penerimaan atau mengubah field status menjadi 0
function batalProses($no_tr_kainjadi){

	$status_kain  ='M';
	$status			  = 0;
	$kd_gudang    = 'G003';

//update into database
  $data            = array(
    'status'        => $status
  );
//update into database
  $data1            = array(
    'no_tr_kainjadi'=> NULL,
    'kg_fin'        => NULL,
    'setting'       => NULL,
    'kd_warna'      => NULL,
    'status'        => $status_kain
  );

//update into database
	$data2 				    = array(
		'no_tr_kainjadi'=> NULL,
		'kg_fin'		    => NULL,
		'setting'		    => NULL,
		'kd_warna'		  => NULL,
		'kd_gudang' 	  => $kd_gudang,
		'status'		    => $status_kain
	);

//update partai kembalikan semula
$updatePartai      = $this->MPartai->updatePartaiByNo_tr_kainjadi($no_tr_kainjadi,'partai_tb',$data1);
//update stock kain kembalikan semula
$updateStock_kain  = $this->MStock_kain->updateStock_kainByNo_tr_kainjadi($no_tr_kainjadi,'stock_kain',$data2);
//update data di penerimaan status menjadi nol
$update   = $this->MPenerimaan_kainjadi->batalPenerimaan_kainjadi($no_tr_kainjadi, 'terimakainjadi_tb', $data);
$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Batalkan </div>');

 	redirect(base_url('Penerimaan_kainjadi')); 

 }

//fungsi untuk cetak surat jalan penerimaan kainjadi
 function cetakProses($no_tr_kainjadi){

  $data['detail']       = $this->MPenerimaan_kainjadi->getById($no_tr_kainjadi);
  $data['partai']       = $this->MStock_kain->getAllByKey(array('no_tr_kainjadi'=>$no_tr_kainjadi));

  
  $this->load->library('pdf');
  $this->pdf->setPaper('A4', 'potrait');
  $this->pdf->filename = "laporan-Penerimaan-kainjadi.pdf.";
  $this->pdf->load_view('Lap/VLapPenerimaanKainjadi', $data);
//$this->load->view('Lap/VLapPenerimaanKainjadi', $data);
}

//untuk cetak detal pengiriman grey
function cetakDetailProses($no_tr_kainjadi){

  $data['detail']       = $this->MPenerimaan_kainjadi->getById($no_tr_kainjadi);
  $data['partai']       = $this->MStock_kain->getAllByKey(array('no_tr_kainjadi'=>$no_tr_kainjadi));

  
   $this->load->library('pdf');

  $this->pdf->setPaper('A4', 'potrait');
  $this->pdf->filename = "laporan-Detail-Penerimaan-kainjadi.pdf.";
  $this->pdf->load_view('Lap/VLapDetailPenerimaanKainjadi', $data);
// $this->load->view('Lap/VLapDetailPenerimaanKainjadi', $data);

}
//fungsi untuk membuat barcode
 function barcode($no_tr_grey){

 	
 	$this->zend->load('zend/Barcode');
  Zend_barcode::render('code128','image',array('text'=> $no_tr_grey));

 }

 function cetakLabelMasal($no_tr_kainjadi){


//cetak label berdasar no tr kainjadi
 $key =array(
 		'no_tr_kainjadi'=> $no_tr_kainjadi,
 		'status'        => 'F',
 	);
  
 	$data['result'] = $this->MStock_kain->getByKey($key);
	$this->load->view('Label/TemplateBarcode',$data); 
 }
//cetak label berdasar no partai
function cetakLabelPartai($kd_partai){


 $key =array(
    'kd_partai'=> $kd_partai,
    'status'        => 'F',
  );
  
  $data['result'] = $this->MStock_kain->getByKey($key);
  $this->load->view('Label/TemplateBarcode',$data); 
 }

 //fungsi untuk ajax filter no tr grey yang ada di partai berdasarkan subcon
 public function listGrey(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_subcon     = $this->input->post('kd_subcon');
    $status_partai = 'M';

    $key=array(

    	'kd_subcon'=>$kd_subcon,
    	'status'   =>$status
    );

    $no_tr_grey  = $this->MPartai->getByKey($key);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<input type='hidden' value='' required>Silahkan Pilih</input>";
    
    foreach($no_tr_grey as $data){
      $lists .= "<h4><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>Kode Partai:&nbsp".$data->kd_partai."Nomor Gulung:&nbsp".$data->no_tr_grey."&nbsp(no WO&nbsp:&nbsp".$data->no_wo."&nbsp-->&nbsp".$data->nm_customer.")</input></h4>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }

  public function listMaklun(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_subcon 		= $this->input->post('kd_subcon');
    $no_tr_maklun   = $this->MPengiriman_grey->getMaklunBySubcon($kd_subcon);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($no_tr_maklun as $data){
      $lists .= "<option value='".$data->no_tr_maklun."'>".$data->no_tr_maklun."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_no_tr_maklun'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }


    public function listPartai(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $no_tr_maklun     = $this->input->post('no_tr_maklun');
    $kd_kain          = $this->MPartai->getPartaiByMaklun($no_tr_maklun);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($kd_kain as $data){
      $lists .= "<option value='".$data->kd_partai."'>".$data->kd_partai."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_partai'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }

  public function listKain(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_partai 		= $this->input->post('kd_partai');
    $kd_kain		   	= $this->MStock_kain->getKainByPartai($kd_partai);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";//NULL;
    
    foreach($kd_kain as $data){
      $lists .= "<option value='".$data->kd_kain."'>".$data->nm_kain."&nbspGramasi&nbsp".$data->gramasi."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_kain'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }

    //ajax tampilan filter warna
    public function listWarna(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_kain      = $this->input->post('kd_kain');

    $kd_jenis     = $this->MGrey->getJenisByKain($kd_kain)->kd_jenis;
    $kd_warna     = $this->MWarna->getWarnaByJenis($kd_jenis);

    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
   $lists = "<option value=''>Pilih</option>";
    
    foreach($kd_warna as $data){
      $lists .= "<option value='".$data->kd_warna."'>".$data->nm_warna."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_warna'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON

  }

  public function listTrGrey(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $kd_partai			  = $this->input->post('kd_partai');
    $no_tr_grey		   	= $this->MPartai->getNo_greyByPartai($kd_partai);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = NULL;"<option value=''>Pilih</option>";
    
    foreach($no_tr_grey as $data){
      $lists .= "<h4><input type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>".$data->no_tr_grey."</input></h4>
                     <input type='text' name='kg_fin[]' placeholder='kg'></input>
                     <input type='text' name='setting[]' placeholder='setting'></input>
                     <br> "; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }

}

?>