<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wo extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   $this->load->helper('url');

   $this->load->model('MWo');

   $this->load->model('MCustomer');

   $this->load->model('MWarna');

   $this->load->model('MBenang');

   $this->load->model('MGrey');

   $this->load->model('MStock_kain');

   $this->load->library('session');

 }

//fungsi tampilan index 
function index(){

	 $data['result']     = $this->MWo->readWo();

   $data['tahun']      = $this->MWo->getListTahun()->result();

   $this->load->view('Kesma/VWo', $data);
   
 }

 //fungsi tampilan detail WO
function detailWo($no_wo){

   $key =array(

    'no_wo' => $no_wo

   );

   $data['detail']       = $this->MWo->getByKey1($key);

   $data['grey']         = $this->MStock_kain->getGreyByWo($no_wo);

   $data['maklun']       = $this->MStock_kain->getMAklunByWo($no_wo);

   $data['kainjadi']     = $this->MStock_kain->getKainjadiByWo($no_wo);

   $this->load->view('Kesma/VDetailWo', $data);
   
 }

 //fungsi filter wo by tanggal
 function filterWo(){

  $tglawal= $this->input->post('tglawal');

  $tglakhir= $this->input->post('tglakhir');

  $key    =array(

    'tgl >='=> $tglawal,

    'tgl <='=> $tglakhir,

  );

  $data['result']     = $this->MWo->getbyKey($key);

  $this->load->view('Kesma/VWo', $data);

 }

//fungsi untuk link tampilan input
 function create(){

  $data['result4']     = $this->MWo->get_no_wo();

  $data['result']      = $this->MWo->readlistOrder();

  $data['result1']     = $this->MCustomer->readCustomer();

  $data['result2']     = $this->MGrey->readGrey();
  
  $data['result3']     = $this->MWarna->readWarna();

 	$this->load->view('Kesma/VFormWo',$data);
 
 }

//fungsi untuk proses input record list barang yang di pesan dulu ( sebagian tabel WO)
 function createListWo(){

  $kd_kain           = $this->input->post('kd_kain');
 
  $kd_warna          = $this->input->post('kd_warna');
 
  $gramasi           = $this->input->post('gramasi');
 
  $setting           = $this->input->post('setting');
 
  $jml_rol           = $this->input->post('jml_rol');
 
  $kd_user           = $this->session->userdata('kd_user');

  $data              = array(

      'kd_kain'    =>$kd_kain,

      'warna'      =>$kd_warna,

      'gramasi'     =>$gramasi,

      'setting'     =>$setting,

      'jml_rol'     =>$jml_rol,

      'kd_user'     =>$kd_user,

    );
  
  $insert      = $this->MWo->createWo($data);

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Wo/create')); 

 }

//fungsi untuk proses input record
 function createProses(){

  $id                = $this->input->post('id');
 
 	$no_wo             = $this->input->post('no_wo');
 
  $tgl               = $this->MWo->getDate();
 
  $kd_customer       = $this->input->post('kd_customer');
 
  $kd_user           = $this->session->userdata('kd_user');

  $jumlah            = count($id);

  $status_wo         = 1;

 	$data              = array(

      'tgl'          =>$tgl,

      'no_wo'        =>$no_wo,

      'kd_customer'  =>$kd_customer,

      'status_wo'    =>$status_wo

    );

  //buat perulangan untuk seva sejumlah tr grey yang dipilih
  for($x=0;$x<$jumlah;$x++){

   $key          = $id[$x];

   $insert       = $this->MWo->updateWo($key,'wo_tb',$data);

  }

 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Wo')); 

 }


 //proses update data ke database
 function update(){

  $id                = $this->input->post('id');

  $no_wo             = $this->input->post('no_wo');

  $kd_customer       = $this->input->post('kd_customer');

  $kd_kain           = $this->input->post('kd_kain');

  $kd_warna          = $this->input->post('kd_warna');

  $gramasi           = $this->input->post('gramasi');

  $setting           = $this->input->post('setting');

  $jml_rol           = $this->input->post('jml_rol');

  $kd_user           = $this->session->userdata('kd_user');

  //fungsi untuk update record
  $data              = array(

      'kd_customer' =>$kd_customer,

      'kd_kain'     =>$kd_kain,

      'warna'       =>$kd_warna,

      'gramasi'     =>$gramasi,

      'setting'     =>$setting,

      'jml_rol'     =>$jml_rol,

      'kd_user'     =>$kd_user,

    );

  $update = $this->MWo->updateWo($id, 'wo_tb', $data);

  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');

    redirect(base_url('wo'));

  }else{

    echo "Gagal";

  }

 }

//fungsi untuk menghapus record per nomor wo
function delete($no_wo){
  
  $this->MWo->deleteWoByNo_wo($no_wo);

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('Wo'));

 }

//fungsi untuk menghapus record bt status dan user yang login pada saat buat wo
function deleteList($id){

  $key =array(

    'id'=> $id

  );

  $this->MWo->deleteList($key);

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');

  redirect(base_url('Wo/create'));

 }

 //fungsi untuk menghapus record bt status dan user yang login pada cancel pembuatan wo
function deleteAllList(){  

  $kd_user = $this->session->userdata('kd_user');

  $key =array(

    'status_wo' => 'T',

    'kd_user'   => $kd_user

  );

  $this->MWo->deleteList($key);

  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dibatalkan </div>');

  redirect(base_url('Wo'));

 }

 //fungsi untuk tutup wo
 //set status wo jadi nol
 //kembalikan stock pada stock kain no wo dan kd customer jadi nol
 function closeWo($no_wo){

  $status_wo=array(

    'status_wo' => 0

  );

  $data=array(

    'no_wo'       =>0,

    'kd_customer' =>0

  );

  $updateWo    = $this->MWo->updateWo1($no_wo,'wo_tb',$status_wo);

  $updateStock = $this->MStock_kain->updateStock_kainByWo($no_wo,'stock_kain',$data);

  $this->session->set_flashdata('notifhapus','<div class="alert alert-success alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>WO berhasil ditutup </div>');

  redirect(base_url('Wo'));

 }

 public function cetakWo($no_wo){

  $data['result']     =   $this->MWo->getByWo($no_wo)->row();

  $data['detail']     =   $this->MWo->getByWo($no_wo)->result();
  
  $this->load->library('pdf');

   $this->pdf->setPaper('A4', 'potrait');
  
   $this->pdf->filename = "Lap-".$no_wo."pdf.";
  
   $this->pdf->load_view('Lap/VLapWo', $data);
//$this->load->view('Lap/VLapWo', $data);
}

//fungsi untuk ajax detail wo (po sedang diproses)
function ProsGrey(){
    $no_wo   = $this->input->post('no_wo');
    $kd_kain = $this->input->post('kd_kain');

    $key=array(
      'kd_kain'  =>$kd_kain,
    );

    $no_tr_grey  = $this->MStock_kain->getByKey($key)->result();
    $jml_grey    = count($no_tr_grey);

    $hasil       = $jml_grey;

    $callback = array('jml_grey'=>$hasil); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    echo json_encode($callback);


}
//fungsi untuk cetak SPK
function cetakSpk(){

   $bulan = $this->input->post('bulan');

   $tahun = $this->input->post('tahun');

   $key = array(

    'year(tgl)'  => $tahun,

    'month(tgl)' => $bulan

   );

   $data['detail']    =   $this->MWo->getSpk($key)->result();

   $data['tahun']     =   $this->input->post('tahun');

   $bln               =   $this->input->post('bulan');

   if($bln==1){

    $data['bulan']   = 'Januari';

   }elseif ($bln==2) {
     
     $data['bulan']   = 'Februari';

   }elseif($bln==3){

     $data['bulan']   = 'Maret';

   }elseif($bln==4){

    $data['bulan']   = 'April';

   }elseif($bln==5){

    $data['bulan']   = 'Mei';

   }elseif($bln==6){

    $data['bulan']   = 'Juni';

   }
   elseif($bln==7){

    $data['bulan']   = 'Juli';

   }elseif($bln==8){

    $data['bulan']   = 'Agustus';

   }elseif($bln==9){

    $data['bulan']   = 'September';

   }elseif($bln==10){

    $data['bulan']   = 'Oktober';

   }elseif($bln==11){

    $data['bulan']   = 'November';

   }elseif($bln==12){

    $data['bulan']   = 'Desember';

   }

  // print_r($data['detail']);
   
  
   $this->load->library('pdf');

   $this->pdf->setPaper('A4', 'potrait');
  
   $this->pdf->filename = "Lap-SPK-Bulan-".$bulan."-Tahun-".$tahun."pdf.";
  
   $this->pdf->load_view('Lap/VLapSpk', $data);

  // $this->load->view('Lap/VLapSpk', $data);
   

}

function statusWo(){ 
 
  //cari jumlah wo berdasar nomor wo
    $jumlah_order = $this->MWo->getByNo_wo($no_wo)->result();
  
    foreach($jumlah_order AS $row){

      echo $order = $row->jumlah_rol;

    }  
  //cari stock berdasar nomor wo
    $jumlah_stock = $this->MStock_kain->getByNo_wo($no_wo)->result();
  
    foreach($jumlah_stock AS $baris){

      echo $stock = $baris->jumlah_rol;

    }
 
  //jika stock>0 dan < jml order 'proses'
    if($stock>0 && $stock<$order){
      
      //unbah status wo jadi proses
      $data = array(

        'status_wo'=> 'P'

      );

      $this->MWo->updateWo1($no_wo,'wo_tb',$data);
    
    }
    //jika stock = order
    elseif($stock == $order){

      //ubah status jadi selesai
      $data = array(

        'status_wo'=> 'F'

      );

      $this->MWo->updateWo1($no_wo,'wo_tb',$data);
    }

    else{

      //ubah status jadi belum dibuat
      $data = array(

        'status_wo'=> '1'

      );

      $this->MWo->updateWo1($no_wo,'wo_tb',$data);

    }

     redirect(base_url('Wo'));

}


}

?>