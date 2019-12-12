<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_grey extends CI_Controller {
 function __construct()
 
 {
 
   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');
   
   $this->load->model('MPenerimaan_grey');
   
   $this->load->model('MStock_kain');
   
   $this->load->model('MGrey');
   
   $this->load->model('MMesin');
   
   $this->load->model('MGudang');
   
   $this->load->model('MCustomer');
   
   $this->load->model('MProduksi');
   
   $this->load->model('MUser');
   
   $this->load->model('MWo');
   
   $this->load->library('session');
 
 }

//fungsi tampilan index
function index(){
 
  date_default_timezone_set('Asia/Jakarta');
  $tgl  = date('Y-m-d H:i:s');
  $tgla = date('Y-m-d H:i:s', strtotime('-14 day', strtotime($tgl)));

  $key = array(
    'tgl <=' => $tgl,
    'tgl >=' => $tgla);
  $data   = array( 
    'tgl' =>$tgl,
    'tgla' => $tgla);
	$data['result'] 		  = $this->MPenerimaan_grey->readPenerimaan_grey($key);

	$data['no_tr_grey']		=	$this->MStock_kain->get_no_tr_grey();

  

	$this->load->view('Kesma/VPenerimaangrey',$data);

 }

 //fungsi tampilan rekap penerimaan
function rekap($no_produksi){

	$tanggal 				    =	$this->MPenerimaan_grey->getDateOnly();
	
	$data['result'] 		= 	$this->MPenerimaan_grey->getByTanggal($tanggal,$no_produksi);

	$this->load->view('Kesma/VPenerimaangrey',$data);

 }

  function edit($no_tr_grey){  
  
  $data['result']     =   $this->MPenerimaan_grey->getById($no_tr_grey);

  $data['kain']       =   $this->MGrey->readGrey();

  $data['wo']         =   $this->MWo->readWo();

  $this->load->view('Kesma/VPenerimaangreyedit',$data);

 }


function editProses(){

  $no_tr_grey  = $this->input->post('no_tr_grey');

  $kd_kain     = $this->input->post('kd_kain');

  $gramasi     = $this->input->post('gramasi');

  $bs_garis    = $this->input->post('bs_garis');

  $bs_lubang   = $this->input->post('bs_lubang');

  $ket         = $this->input->post('ket');

  $no_wo       = $this->input->post('no_wo');

  $query       = $this->MWo->getByWo1($no_wo);

  $kd_customer = $query->kd_customer; 

  $data        =array(


    'kd_kain'   => $kd_kain,

    'gramasi'   => $gramasi,

    'bs_garis'  => $bs_garis,

    'bs_lubang' => $bs_lubang,

    'ket'       => $ket,

    'no_wo'     => $no_wo,

    'kd_customer'=> $kd_customer

  ); 

  $data1        =array(

    'kd_kain'   => $kd_kain,

    'gramasi'   => $gramasi,

    'no_wo'     => $no_wo,

    'kd_customer'=> $kd_customer

  );

  $update            = $this->MPenerimaan_grey->updatePenerimaan_grey($no_tr_grey,'terimagrey_tb',$data);

  $update_stock      = $this->MStock_kain->updateStock_kain($no_tr_grey,'stock_kain',$data1);

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil diubah </div>');


  redirect(base_url('Penerimaan_grey')); 

}
 
//fungsi proses post create penerimaan
function createProses(){

	//validasi form
	$this->form_validation->set_rules('kd_mesin','kd_mesin','required');

	$this->form_validation->set_rules('no_produksi','no_produksi','required');

	$this->form_validation->set_rules('kd_kain','kd_kain','required');

	$this->form_validation->set_rules('kd_gudang','kd_gudang','required');

	$this->form_validation->set_rules('gramasi','gramasi','required|numeric');

	$this->form_validation->set_rules('kg_grey','kg_grey','required|numeric');

	$no_produksi	=$this->input->post('no_produksi');

	// cek validasi
	if($this->form_validation->run() !=false){

	$no_mesin       = $this->MProduksi->getById($no_produksi)->no_mesin;

	$kd_mesin       = $this->MProduksi->getById($no_produksi)->kd_mesin;

	$sku 		    = $this->MStock_kain->getSku($kd_mesin,$no_mesin);

	$no_tr_grey		= $this->MStock_kain->get_no_tr_grey();

	$tgl			= $this->MPenerimaan_grey->getDate();

	$kd_mesin		= $this->input->post('kd_mesin');

	$no_produksi	= $this->input->post('no_produksi');

	$kd_kain		= $this->input->post('kd_kain');

  $nm_kain    = $this->MGrey->getById($kd_kain)->nm_kain;

	$kd_gudang		= $this->input->post('kd_gudang');

	$no_wo			= $this->input->post('no_wo');

	$query 		    = $this->MWo->getByWo1($no_wo);

	$kd_customer 	= $query->kd_customer; 

	$operator		=$this->input->post('operator');

	$gramasi		=$this->input->post('gramasi');

	$kg_grey		=$this->input->post('kg_grey');

	$bs_garis		=$this->input->post('bs_garis');

	$bs_lubang		=$this->input->post('bs_lubang');

	$ket			=$this->input->post('ket');

	$kd_user		=$this->session->userdata('kd_user');

	//cek kg akhir di tabel produksi
	$data=$this->MProduksi->getById($no_produksi);

	$kg_akhir=$data->kg_akhir;

	//cek apakah kg grey melebihi kg yang di peoduksi
	if($kg_grey>$kg_akhir){

		$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Kg grey melebihi Kg tersedia </div>');

	redirect(base_url('Produksi/editProduksi/'.$no_produksi)); 

	}else{

		$data=array(	

	'no_tr_grey'	=>$no_tr_grey,

	'sku'			=>$sku,

	'tgl'			=>$tgl,

	'kd_mesin'		=>$kd_mesin,

	'no_produksi'	=>$no_produksi,

	'kd_kain'		=>$kd_kain,

	'kd_gudang'		=>$kd_gudang,

	'kd_customer'	=>$kd_customer,

	'no_wo'			=>$no_wo,

	'operator'		=>$operator,

	'gramasi'		=>$gramasi,

	'kg_grey'		=>$kg_grey,

	'bs_garis'		=>$bs_garis,

	'bs_lubang'		=>$bs_lubang,

	'ket'			=>$ket,

  'kd_user'     =>$kd_user

);

$insert = $this->MPenerimaan_grey->createPenerimaan_grey($data);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

$this->session->set_flashdata('gramasi',$gramasi);

$this->session->set_flashdata('operator',$operator);

$this->session->set_userdata('nm_kain',$nm_kain);

$this->session->set_userdata('kd_kain',$kd_kain);

$this->session->set_flashdata('no_wo',$no_wo);

 	redirect(base_url('Produksi/editProduksi/'.$no_produksi)); 

	}
	
}else{

	$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> Lengkapi Data terlebih dahulu </div>');

	redirect(base_url('Produksi/editProduksi/'.$no_produksi));

}
	
}

//untuk menampilkan data yang akan dibatalkan
 function batalProses($no_tr_grey){

 		$status			=0;

 		$query 	  		= $this->MPenerimaan_grey->getById($no_tr_grey);

		$kg_grey  		= $query->kg_grey;

		$no_produksi  	= $query->no_produksi;

		$kg_akhir 		= $this->MProduksi->getById($no_produksi)->kg_akhir;

		$jumlahkg 		= $kg_grey + $kg_akhir;

//insert into database
 	$data = array(

	'status'		=>$status,

 		);

 	$data1 = array(

	'kg_akhir'		=>$jumlahkg,

 		);

$update        = $this->MPenerimaan_grey->deletePenerimaan_grey($no_tr_grey);

$Stock_kembali = $this->MProduksi->updateProduksi($no_produksi, 'produksi_tb', $data1);

$update_stock_kain = $this->MStock_kain->deleteStock_kain($no_tr_grey);

$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil batalkan </div>');

 	redirect(base_url('Penerimaan_grey'));  	

 }

 //fungsi untuk tampil laporan produksi
function laporan(){
  date_default_timezone_set('Asia/Jakarta');
	$tgl  = date('Y-m-d H:i:s');
  $tgla = date('Y-m-d H:i:s', strtotime('-14 day', strtotime($tgl)));

  $key = array(
    'tgl <=' => $tgl,
    'tgl >=' => $tgla);
    $this->session->set_flashdata('tglAwal',$tgla);

    $this->session->set_flashdata('tglAkhir',$tgl);

  $data['result']       = $this->MPenerimaan_grey->readPenerimaan_grey($key);

  //$data['no_tr_grey']   = $this->MStock_kain->get_no_tr_grey();

	$this->load->view('Lap-transaksi/VLapPenerimaangrey',$data);

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

	$data['result']  = $this->MPenerimaan_grey->getByRangeTgl($key);

	$this->load->view('Lap-transaksi/VLapPenerimaangrey',$data);	


}

 //fungsi untuk tampil laporan produksi
function reset(){

redirect(base_url('Penerimaan_grey/laporan')); 

}

//fungsi untuk proses import excel
  function import(){

  if(isset($_FILES["file"]["name"])){

      $path = $_FILES["file"]["tmp_name"];

      //object baru dari php excel
      $object = PHPExcel_IOFactory::load($path);

      //perulangan untuk membaca file excel
      foreach($object->getWorksheetIterator() as $worksheet){
        //row tertinggi
        $highestRow = $worksheet->getHighestRow();
        //colom tertinggi
        $highestColumn = $worksheet->getHighestColumn();

        for($row=3; $row<=$highestRow; $row++){
          
           $no_tr_grey      = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
         
           $sku             = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $tgl             = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $kd_mesin        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
         
           $no_produksi     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $kd_kain         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
         
           $kd_gudang       = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

           $kd_customer     = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
         
           $no_wo           = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

           $operator        = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
         
           $gramasi         = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

           $kg_grey         = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
         
           $ket             = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

           $bs_garis        = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
         
           $bs_lubang     = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

           $kd_user       = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
         
           $status      = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

           $data[] = array(

            'no_tr_grey'   => $no_tr_grey,

            'sku'          => $sku,

            'tgl'          => $tgl,

            'kd_mesin'     => $kd_mesin,

            'no_produksi'  => $no_produksi,

            'kd_kain'      => $kd_kain,

            'kd_gudang'    => $kd_gudang,

            'kd_customer'  => $kd_customer,

            'no_wo'        => $no_wo,

            'operator'     => $operator,

            'gramasi'      => $gramasi,

            'kg_grey'      => $kg_grey,

            'ket'          => $ket,

            'bs_garis'     => $bs_garis,

            'bs_lubang'    => $bs_lubang,

            'kd_user'      => $kd_user,

            'status'       => $status

           );

        }

      }

      $this->MPenerimaan_grey->insertPenerimaan_grey($data);

      $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data dari EXCEL Berhasil ditambahkan </div>');

      redirect(base_url('Penerimaan_grey')); 

    }

  }

//fungsi untuk export excel
function export(){

      $this->load->model("MPenerimaan_grey");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MPenerimaan_grey->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Penerimaan Grey');

      $object->getActiveSheet()->setTitle('Data Penerimaan Grey');

      foreach($table_columns as $field){


        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $column++;

      }

      $penerimaan_grey_data = $this->MPenerimaan_grey->getAll()->result();

      $excel_row = 3;

      foreach($penerimaan_grey_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->no_tr_grey);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->sku);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->tgl);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->kd_mesin);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->no_produksi);

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->kd_kain);

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->kd_gudang);

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->kd_customer);

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->no_wo);

        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->operator);

        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->gramasi);

        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->kg_grey);

        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->ket);

        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->bs_garis);

        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->bs_lubang);

        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->kd_user);

        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->status);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-Penerimaan-Greige.xlsx"');

      $object_writer->save('php://output');

    }


    //tambahan bypass
    function createNew(){

      $data['mesin'] = $this->MMesin->readMesin();

      $data['kain']  = $this->MGrey->readGrey();


      $this->load->view('Kesma/VFormpenerimaangreynew',$data);

    }

    function createNewProses(){

      $tgl        = $this->MPenerimaan_grey->getDate();

      $kd_mesin   = $this->input->post('kd_mesin');

      $kd_kain    = $this->input->post('kd_kain');

      $kd_gudang  = 'G003';

      $no_wo      = '0';

      $kd_customer= '0'; 

      $gramasi    =$this->input->post('gramasi');

      $kg_grey    =$this->input->post('kg_grey');//array

      $ket        =$this->input->post('ket');

      $kd_user    =$this->session->userdata('kd_user');

      $no_tr_grey1=$this->input->post('no_tr_grey1');

      $no_tr_grey2=$this->input->post('no_tr_grey2');//array


  $jumlah_dipilih = count($kg_grey);

  for($x=0; $x<$jumlah_dipilih; $x++){

      $no_tr_grey   = $no_tr_grey1.$no_tr_grey2[$x];

      $val_kg_grey  = $kg_grey[$x];

    $data=array(  

      'no_tr_grey'  =>$no_tr_grey,

      'tgl'         =>$tgl,

      'kd_mesin'    =>$kd_mesin,

      'kd_kain'     =>$kd_kain,

      'kd_gudang'   =>$kd_gudang,

      'kd_customer' =>$kd_customer,

      'no_wo'       =>$no_wo,

      'gramasi'     =>$gramasi,

      'kg_grey'     =>$val_kg_grey,

      'ket'         =>$ket,

      'kd_user'     =>$kd_user

    );

$insert = $this->MPenerimaan_grey->createPenerimaan_grey($data);


}

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');
  redirect(base_url('Penerimaan_grey')); 

  
    }


 function getlistwo(){
    $id = $this->input->post('id');
    $data=$this->MGrey->getlistwobyid($id);
    $html = "<option value=''>Pilih</option>";
    foreach ($data as $key => $value) {

    $html .= "<option value='".$value->no_wo."'>".$value->no_wo." ".$value->nm_customer."</option>";
    }
  $callback = array('listwo'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
  echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }

}

?>