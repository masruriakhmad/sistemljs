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
 function detailListTerimaKainjadi($no_partai){

  $data['result']      = $this->MPartai->getByNo_partai($no_partai);

  $this->load->view('Kesma/VDetailListTerimakainjadi', $data);

 }

 //fungsi detail nomor gulung untuk cetak barcode
 function detailNoGulung($no_partai){

  $key = array(

    'no_partai' => $no_partai

  );

  $data['result']      = $this->MStock_kain->getByKey($key);

  $this->load->view('Kesma/VDetailgulungterimakainjadi', $data);

 }

 //fungsi detail nomor per gulung untuk cetak barcode
 function detailPerGulung($no_tr_grey){

  $key = array(

    'no_tr_grey' => $no_tr_grey

  );

  $data['result']      = $this->MStock_kain->getByKey($key);

  $this->load->view('Kesma/VDetailgulungterimakainjadi', $data);

 }

//fungsi detail nomor gulung untuk cetak barcode
//fungsi untuk tampilan create
function create(){

  $data['nomor']     = $this->MPenerimaan_kainjadi->get_no_tr_kainjadi();

  $data['result']    = $this->MPartai->readPartaiByP();//status buffer (proses)

	$data['result1']	 =	$this->MGudang->readGudang();

	$data['result2']	 =	$this->MSubcon->readSubcon();

	$data['warna']	   =	$this->MWarna->readWarna();

  $data['kain']      =  $this->MGrey->readGrey();

  $data['partai']    =  $this->MPartai->getListKdPartai();

  $data['subcon']    =  $this->MSubcon->readSubcon();

  $data['warna']     =  $this->MWarna->readWarna();

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

      $no_partai[]  = $row->no_partai;

      $kd_subcon    = $row->kd_subcon;

      $kd_warna[]   = $row->kd_warna;

      $kg_fin[]     = $row->kg_fin;

      $setting[]      = $row->setting;

    }

	//untuk input ke table terima kainjadi
	
	 $tgl    		  = $this->MPenerimaan_kainjadi->getDate();

	 $no_mobil 	  = $this->input->post('no_mobil');

	 $supir 		 	= $this->input->post('supir');

	 $ket 		 	  = $this->input->post('ket');

	 $kd_user 		= $this->session->userdata('kd_user');

	//untuk tabel stock kain
	 $no_tr_grey	= implode(';',$array_text);

	 $jumlah 		  = count($array_text);

	 $kd_gudang   = 'G005';//$this->input->post('kd_gudang');

	 $status 		  = 'F';

		$data=array(	

	     'no_tr_kainjadi' =>$no_tr_kainjadi,

	     'tgl'			      =>$tgl,

	     'kd_subcon'	    =>$kd_subcon,

	     'no_mobil'	      =>$no_mobil,

	     'supir '	        =>$supir,

	     'jumlah'		      =>$jumlah,

	     'no_tr_grey'	    =>$no_tr_grey,

	     'ket'			      =>$ket,

	     'kd_user' 		    =>$kd_user

	);

//update data pada stock kain dan status menjadi F
//mengubah status di partai tb menjadi F
for($x=0;$x<$jumlah;$x++){

	$key 				  = $array_text[$x];

  $no_partai1   = $no_partai[$x];

	$kd_warna1 		= $kd_warna[$x];

	$kg_fin1 			= $kg_fin[$x];

	$setting1 		= $setting[$x];

	$data1 				= array(
	
  	'no_tr_kainjadi'=> $no_tr_kainjadi,

    'no_partai'     => $no_partai1,
	
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

    'no_partai'     => NULL,

    'kg_fin'        => NULL,

    'setting'       => NULL,

    'kd_warna'      => NULL,

    'status'        => $status_kain

  );

//update into database
	$data2 				    = array(

		'no_tr_kainjadi'=> NULL,

    'no_partai'     => NULL,

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

 //fungsi untuk  tampil edit kg per gulung saat terima kainjadi
 function editPerGulungTampil($no_tr_grey){

  $data['result']  = $this->MStock_kain->getById($no_tr_grey);

  $data['kain']    = $this->MGrey->readGrey()->result();


  $data['kd_kain'] = $this->MStock_kain->getById($no_tr_grey);

  $kd_kain         = $data['kd_kain']->kd_kain;

  $kd_jenis        = $this->MGrey->getJenisByKain($kd_kain)->kd_jenis;

  $data['warna']   = $this->MWarna->getWarnaByJenis($kd_jenis);

  $this->load->view('Kesma/VDetailgulungterimakainjadiedit',$data);

 }

 //fungsi untuk edit kg per gulung saat terima kainjadi
 function editPerGulungProses(){

  $no_tr_grey = $this->input->post('no_tr_grey');

  $kg_fin     = $this->input->post('kg_fin');

  $setting    = $this->input->post('setting');

  $kd_kain    = $this->input->post('kd_kain');

  $kd_warna   = $this->input->post('kd_warna');

  $data       = array(


    'kg_fin'  => $kg_fin,

    'kd_kain'  => $kd_kain,

    'setting'  => $setting,

    'kd_warna'=> $kd_warna

  );

    $data1       = array(


    'kg_fin'  => $kg_fin,

    'setting'  => $setting,

    'kd_warna'=> $kd_warna

  );

  $update        = $this->MStock_kain->updateStock_kain($no_tr_grey,'stock_kain',$data);

  $update_partai = $this->MPartai->updatePartaiByTrGrey($no_tr_grey,'partai_tb',$data1);

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil Diubah</div>');

  redirect(base_url('Penerimaan_kainjadi/detailPerGulung/'.$no_tr_grey)); 

 }

 //fungsi untuk  tampil edit kg per gulung saat terima kainjadi
 function editPerNoPartaiTampil($no_partai){

  $data['result'] = $this->MStock_kain->getByNo_partai($no_partai)->row();

  $kd_kain        = $data['result']->kd_kain;

  $kd_jenis       = $this->MGrey->getJenisByKain($kd_kain)->kd_jenis;

  $data['warna']  = $this->MWarna->getWarnaByJenis($kd_jenis);

  $this->load->view('Kesma/VDetailterimakainjadiedit',$data);

 }

 //fungsi untuk edit kg per gulung saat terima kainjadi
 function editPerNoPartaiProses(){

  $no_partai  = $this->input->post('no_partai');

  $kd_warna   = $this->input->post('kd_warna');

  $setting    = $this->input->post('setting');

  $no_tr_kainjadi = $this->input->post('no_tr_kainjadi');

  $key        = array(

    'no_partai' => $no_partai

  );

  $data       = array(

    'kd_warna'  => $kd_warna,

    'setting'   => $setting

  );

  $update        = $this->MStock_kain->updateStock_kainByKey($key,'stock_kain',$data);

  $update_partai = $this->MPartai->updatePartaiByKey($key,'partai_tb',$data);

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil Diubah</div>');

  redirect(base_url('Penerimaan_kainjadi/detailPenerimaanKainjadi/'.$no_tr_kainjadi)); 

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
 	
  	'no_tr_kainjadi'=> $no_tr_kainjadi
 	
  );
  
 	$data['result'] = $this->MStock_kain->getByKey($key);
	
  $this->load->view('Label/TemplateBarcode',$data); 
 
 }

//cetak label berdasar no partai
function cetakLabelPartai($no_partai){

 $key =array(
  
    'no_partai'=> $no_partai
  
  );
  
  $data['result'] = $this->MStock_kain->getByKey($key);
  
  $this->load->view('Label/TemplateBarcode',$data); 
 
 }

 //cetak label berdasar no gulung
function cetakLabelGulung($no_tr_grey){

 $key =array(
  
    'no_tr_grey'=> $no_tr_grey
  
  );
  
  $data['result'] = $this->MStock_kain->getByKey($key);
  
  $this->load->view('Label/TemplateBarcode',$data); 
 
 }

//fungsi untuk tampil laporan penerimaan kain jadi
function laporan(){

  $data['result'] = $this->MPenerimaan_kainjadi->getAll();

  $this->load->view('Lap-transaksi/VLapPenerimaankainjadi',$data);

}

//fungsi untuk filter laporan penerimaan kai jadi berdasarkan tanggal
function laporanFilter(){

  $tglAwal  = $this->input->post('tglawal');

  $tglAkhir = $this->input->post('tglakhir');

  $key = array(

    'tgl >'=> $tglAwal,

    'tgl <'=> $tglAkhir

  );

  $this->session->set_flashdata('tglAwal',$tglAwal);

  $this->session->set_flashdata('tglAkhir',$tglAkhir);

  $data['result']  = $this->MPenerimaan_kainjadi->getByRangeTgl($key);

  //$data['result']  = $this->MPenerimaan_kainjadi->getByTgl($tglAwal,$tglAkhir);

  $this->load->view('Lap-transaksi/VLapPenerimaankainjadi',$data);  


}

 //fungsi untuk tampil laporan produksi
function reset(){

redirect(base_url('Penerimaan_kainjadi/laporan')); 

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

        //cek apakah jumlah nama dan urutan field sama
        $query = $this->MPenerimaan_grey->getColoumnname();

        for($row=3; $row<=$highestRow; $row++){
          
           $no_tr_grey      = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
         
           $sku       = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $tgl       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $kd_mesin      = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
         
           $no_produksi   = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $kd_kain       = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
         
           $kd_gudang     = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

           $kd_customer     = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
         
           $no_wo       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

           $operator      = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
         
           $gramasi     = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

           $kg_grey       = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
         
           $ket       = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

           $bs_garis      = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
         
           $bs_lubang   = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

           $kd_user       = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
         
           $status      = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

           $data[] = array(

            'no_tr_grey'   => $no_tr_grey,

            'sku'      => $sku,

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

            'status'       => $status,

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

      $this->load->model("MPenerimaan_kainjadi");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MPenerimaan_grey->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Penerimaan Kain Jadi');

      $object->getActiveSheet()->setTitle('Data Penerimaan Grey');

      foreach($table_columns as $field){


        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $object->getSheet(0)->getStyle('A3:C3')->getBorders()->getAllBorders()->getColor()->setRGB('949FA8');

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

      header('Content-Disposition: attachment;filename="Data-Penerimaan-Greige.xls"');

      $object_writer->save('php://output');

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
    $kd_subcon 		  = $this->input->post('kd_subcon');

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
    //$no_tr_maklun     = $this->input->post('no_tr_maklun');

    $kd_subcon        = $this->input->post('kd_subcon');

    $partai           = $this->MPartai->getPartaiBySubcon($kd_subcon);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($partai as $data){

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

    $kd_partai    = $this->input->post('kd_partai');

    $kd_kain      = $this->MStock_kain->getKainByPartai($kd_partai);

    if($kd_kain==FALSE){

       $lists = "<option value=''>Pilih</option>";

    }else{

    foreach($kd_kain as $row){

      $kode_kain=$row->kd_kain;

    }

    //$kd_kain      = $this->input->post('kd_kain');

    $kd_jenis     = $this->MGrey->getJenisByKain($kode_kain)->kd_jenis;

    $kd_warna     = $this->MWarna->getWarnaByJenis($kd_jenis);

    //print_r($kd_warna);

    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
   $lists = "<option value=''>Pilih</option>";
    
    foreach($kd_warna as $data){

      $lists .= "<option value='".$data->kd_warna."'>".$data->nm_warna."</option>"; // Tambahkan tag option ke variabel $lists

    }

  }
    
    $callback = array('list_warna'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

    echo json_encode($callback); // konversi varibael $callback menjadi JSON

  }

      //ajax tampilan filter warna
    public function listWarnaNew(){
    // Ambil data ID Provinsi yang dikirim via ajax post

    $kd_kain      = $this->input->post('kd_kain');

    $kd_jenis     = $this->MGrey->getJenisByKain($kd_kain)->kd_jenis;

    $kd_warna     = $this->MWarna->getWarnaByJenis($kd_jenis);

    //print_r($kd_warna);

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
    $no=1;
    foreach($no_tr_grey as $data){

      $lists .= "
      <div class='col-md-6'>
      <h5>".$no." <input  type='checkbox' name='no_tr_grey[]' value='".$data->no_tr_grey."'>".$data->no_tr_grey." | ".$data->nm_kain."</input></h5>
      </div>
      <div class='col-md-6'>
      <input type='text' name='kg_fin[]' placeholder='Kg'></input>
      <br> 
      </div>"; // Tambahkan tag option ke variabel $lists
      
                     
                     $no++;

    }
    
    $callback = array('list_no_tr_grey'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

    echo json_encode($callback); // konversi varibael $callback menjadi JSON

  }


//bypasssss
//untuk by pass penerimaan kain jadi
   //fungsi untuk proses update record  partai_tb (data sementara penerimaan kain jadi)
 
 function createListTerimaNew(){

  //$index              = $this->input->post('id'); //berisi array dari cekbox

  $kd_kain            = $this->input->post('kd_kain');
 
  $no_partai          = $this->input->post('no_partai');//no partai dari maklun
  
  $kd_warna           = $this->input->post('kd_warna');
 
  $kg_fin             = $this->input->post('kg_fin');//berisi array dari checkbox
 
  $setting            = $this->input->post('setting');

  $no_tr_kainjadi     = $this->MPenerimaan_kainjadi->get_no_tr_kainjadi();
 
  $kd_user            = $this->session->userdata('kd_user');
  
  //print_r($no_tr_grey);
  //hitung jumlah tr gre yang dipilih
  $jumlah_dipilih = count($kg_fin);
 
 //buat perulangan untuk seva sejumlah tr grey yang dipilih
  for($x=0;$x<$jumlah_dipilih;$x++){
 
    $kg_fin_val   = $kg_fin[$x];

    $no_tr_grey         = $this->MStock_kain->get_no_tr_greyNew();//untuk bypass

    $data=array(

      'no_tr_grey'  => $no_tr_grey,

      'kd_kain'     => $kd_kain,

      'no_tr_kainjadi '=> $no_tr_kainjadi,

      'no_partai'   => $no_partai,
 
      'kd_warna '   => $kd_warna,
 
      'kg_fin '     => $kg_fin_val,
 
      'setting '    => $setting,
 
      'status'      => 'P',
 
    );

    $data_partai=array(

      'no_tr_grey'  => $no_tr_grey,

      'no_tr_kainjadi'=> $no_tr_kainjadi,

      'no_partai'   => $no_partai,
 
      'kd_warna '   => $kd_warna,
 
      'kg_fin '     => $kg_fin_val,
 
      'setting '    => $setting,
 
      'status'      => 'P',

      'kd_user'     => $kd_user
 
    );

    $insertPartai = $this->MPartai->createPartai($data_partai);

    $insert=$this->MStock_kain->createStock_kain($data);
 
  }

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Penerimaan_kainjadi/createNew')); 
 
 }

  //fungsi delete list (update partai TB ke semula)
 function deleteListTerimaNew($no_partai){

  $kd_user        = $this->session->userdata('kd_user');
  
  $key=array(
  
    'no_partai'     => $no_partai,
  
    'status'        => 'P'
  
  );
  

  $delete=$this->MStock_kain->deleteStock_kainByKey($key);

  $deletePartai=$this->MPartai->deletePartaiByKey($key);

   redirect(base_url('Penerimaan_kainjadi/createNew')); 

 }

 //fungsi delete all list (update partai TB ke semula)
 function deleteAllListTerimaNew($no_tr_kainjadi){

  $kd_user        = $this->session->userdata('kd_user');

  $key=array(

    'no_tr_kainjadi'=> $no_tr_kainjadi,

    'status'        => 'P'

  );

  
  $delete=$this->MStock_kain->deleteStock_kainByKey($key);

  $deletePartai=$this->MPartai->deletePartaiByKey($key);

   redirect(base_url('Penerimaan_kainjadi/createNew')); 

   $this->session->set_flashdata('notif','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil dibatalkan </div>');

   redirect(base_url('Penerimaan_kainjadi')); 

 }

 //fungsi untuk tampilan create barang sebelum sistem ada
function createNew(){

  $data['result']    =  $this->MStock_kain->getByP();

  $data['kain']      =  $this->MGrey->readGrey();

  $data['subcon']    =  $this->MSubcon->readSubcon();

  $data['warna']     =  $this->MWarna->readWarna();

  $data['nomor']     = $this->MPenerimaan_kainjadi->get_no_tr_kainjadi();

  $data['result1']   =  $this->MGudang->readGudang();

  $data['result2']   =  $this->MSubcon->readSubcon();

//print_r($this->MStock_kain->getByP()->result());

  $this->load->view('Kesma/VFormPenerimaankainjadinew',$data);

}

//fungsi untuk proses new penerimaan yang ada sebelum sistem
function createProsesNew(){

   $no_tr_kainjadi = $this->input->post('no_tr_kainjadi');

   $kd_subcon      = $this->input->post('kd_subcon');

   $tgl         = $this->MPenerimaan_kainjadi->getDate();

   $no_mobil    = $this->input->post('no_mobil');

   $supir       = $this->input->post('supir');

   $ket         = $this->input->post('ket');

   $kd_user     = $this->session->userdata('kd_user');

   $no_tr_grey  = $this->MStock_kain->GetByStatusP()->result();

  foreach($no_tr_grey AS $row){

   $hasil[] = $row->no_tr_grey;

  }
   
   $jumlah = count($hasil);

   $list_gulung = implode(';',$hasil);

    $key = array(

      'no_tr_kainjadi' => $no_tr_kainjadi

    );

    $data = array(

      'kd_subcon' => $kd_subcon,

      'status'    => 'F'

    );

    $data_penerimaan_kainjadi =array(

      'no_tr_kainjadi' => $no_tr_kainjadi,

      'tgl'            => $tgl,

      'kd_subcon'      => $kd_subcon,

      'no_mobil'       => $no_mobil,

      'supir'          => $supir,

      'no_tr_grey'     => $list_gulung,

      'jumlah'         => $jumlah,

      'ket'            => $ket,

      'kd_user'        => $kd_user,

    );

    $data_partai = array(

      'kd_subcon'  => $kd_subcon,

      'status'     => 'F'

    );


    $insert = $this->MPenerimaan_kainjadi->createPenerimaan_kainjadi($data_penerimaan_kainjadi);

    $update = $this->MStock_kain->updateStock_kainByKey($key,'stock_kain',$data);

    $update_partai= $this->MPartai->updatePartaiByKey($key,'partai_tb',$data_partai);

  $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

  redirect(base_url('Penerimaan_kainjadi'));  

}
 //fungsi tampilan detail partai 
function detailPartaiTerimaNew($no_partai){

   $key =array(

    'partai_tb.no_partai' => $no_partai,

    'partai_tb.status'    => 'P',

    //'kd_user'   => $this->session->userdata('kd_user')

   );

   $data['result']      = $this->MPartai->getByKunci($key);
   
   $this->load->view('Kesma/VListPartaiTerima', $data);
   
 }

  //fungsi untuk  tampil edit list terima
 function editNew($no_tr_grey){

  $data['result'] = $this->MPartai->getById($no_tr_grey);

  $this->load->view('Kesma/VListpartaiterimaeditnew', $data);

 }

 function editNewProses(){

  $no_tr_grey = $this->input->post('no_tr_grey');

  $kg_fin     = $this->input->post('kg_fin');

  $no_partai  = $this->input->post('no_partai');

  $data = array(

    'kg_fin' => $kg_fin

  );

    $updatePartai = $this->MPartai->updatePartaiByTrGrey($no_tr_grey,'partai_tb',$data);

    $updateStock  =$this->MStock_kain->updateStock_kain($no_tr_grey,'stock_kain',$data);

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil diubah </div>');

  redirect(base_url('Penerimaan_kainjadi/detailPartaiTerimaNew/'.$no_partai));  

 }

 function deleteNew($no_tr_grey){

    $key =array(

      'no_tr_grey'=> $no_tr_grey

    );

    $updatePartai = $this->MPartai->deletePartaiByKey($key);

    $updateStock  =$this->MStock_kain->deleteStock_kain($no_tr_grey);

   $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil diubah </div>');

  redirect(base_url('Penerimaan_kainjadi/createNew'));  

 }


}

?>