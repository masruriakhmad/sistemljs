<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_kain extends CI_Controller {

 function __construct()

 {

   parent::__construct();

   //load model yang diperlukan
   $this->load->helper('url');

   $this->load->model('MStock_kain');

   $this->load->model('MGrey');

   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');

 }

//fungsi tampilan index
function index(){

	 $data['result'] = $this->MStock_kain->readStock_kain();

	 $data['judul']  = "Data Stock Grey";

	//print_r($data);
	 $this->load->view('Kesma/VStock_kain', $data);

 }

 //fungsi tampilan stock grey
function tampilGrey(){

	 $data['result'] = $this->MStock_kain->getStockGrey();

	 $data['judul']  = "Data Stock Grey";

	 $this->load->view('Kesma/VStock_kain', $data);

 }

//fungsi tampilan stock grey
function tampilDetailGrey($kd_kain){

   $key= array(

    'stock_kain.kd_kain' => $kd_kain,

    'status'  => 'G'

   );

   $data['result'] = $this->MStock_kain->getDetailStock($key);


   $this->load->view('Kesma/VDetailStock_grey', $data);

 }


 //fungsi tampilan stock maklun
function tampilMaklun(){

	 $data['result'] = $this->MStock_kain->getStockMaklun();

	

	 $this->load->view('Kesma/VStock_kainmaklun', $data);

 }

//fungsi tampilan stock maklun grup by kain
function tampilDetailMaklunPerKain($kd_subcon){

   $key= array(

    'stock_kain.kd_subcon' => $kd_subcon,

    'status'  => 'M'

   );

   $data['result'] = $this->MStock_kain->getDetailStockMaklunPerkain($key);

   $this->load->view('Kesma/VDetailStock_maklunPerKain', $data);

 }

//fungsi tampilan stock maklun grup by kain per partai
function tampilDetailMaklunPerPartai($param){

   $kd_subcon = SUBSTR($param,0,5);

   $kd_kain = SUBSTR($param,5);

   $key= array(

    'stock_kain.kd_subcon' => $kd_subcon,

    'stock_kain.kd_kain'   => $kd_kain,

    'status'  => 'M'

   );

   $data['result'] = $this->MStock_kain->getDetailStockMaklunPerPartai($key);

   $this->load->view('Kesma/VDetailStock_maklunPerPartai', $data);

 }

 //fungsi tampilan stock maklun per gulung
function tampilDetailMaklun($kd_partai){

   $key= array(

    'stock_kain.kd_partai' => $kd_partai,

    'status'  => 'M'

   );

   $data['result'] = $this->MStock_kain->getDetailStock($key);

   $this->load->view('Kesma/VDetailStock_maklun', $data);

 }

 //fungsi tampilan stock maklun
function tampilkainjadi(){

	 $data['result'] = $this->MStock_kain->getStockKainjadi();

	 $this->load->view('Kesma/VStock_kainjadinew', $data);

 }

   //fungsi tampilan stock grey
function tampilDetailKainjadiPerKain($kd_kain){

   $key= array(

    'stock_kain.kd_kain' => $kd_kain,
    
    'status'  => 'F'

   );

   $data['result'] = $this->MStock_kain->getDetailStockKainjadi($key);

   $this->load->view('Kesma/VStock_kainjadi', $data);

}

  //fungsi tampilan stock grey
function tampilDetailKainjadi($param){

  $kd_kain   = SUBSTR($param,0,4);

  $no_partai = SUBSTR($param,4);


   $key= array(

    'stock_kain.no_partai' => $no_partai,

    'stock_kain.kd_kain' => $kd_kain,
    
    'status'  => 'F'

   );

   $data['result'] = $this->MStock_kain->getDetailStock($key);

   $this->load->view('Kesma/VDetailStock_kainjadi', $data);

 }

//fungsi untuk export excel
function export(){

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MStock_kain->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Stock Kain');

      $object->getActiveSheet()->setTitle('Data Master Stock Kain');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $stock_data = $this->MStock_kain->getAll()->result();

      $excel_row = 3;

      foreach($stock_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->no_tr_grey);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->kd_kain);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->no_produksi);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->kd_mesin);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->kd_gudang);

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->kd_customer);

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->no_wo);

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->gramasi);

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->kg_grey);

        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->kd_partai);

        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->kd_subcon);

        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->no_tr_maklun);

        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->no_tr_kainjadi);

        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->kg_fin);

        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->setting);

        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->kd_warna);

        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->no_jual);

        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row->status);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-Stock-kain.xls"');

      $object_writer->save('php://output');

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
          //baca data dari excel berdasar matrik kolom dan baris (kolom,baris)
           $no_tr_grey   = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $kd_kain      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $no_produksi  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $kd_mesin     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

           $kd_gudang    = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $kd_customer  = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

           $no_wo        = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

           $gramasi      = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

           $kg_grey      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

           $kd_partai    = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

           $kd_subcon    = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

           $no_tr_maklun = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

           $no_tr_kainjadi= $worksheet->getCellByColumnAndRow(12, $row)->getValue();

           $kd_fin       = $worksheet->getCellByColumnAndRow(13, $row)->getValue();

           $setting      = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

           $kd_warna     = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

           $status       = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

           $data[] = array(

            'no_tr_grey'    => $no_tr_grey,

            'kd_kain'       => $kd_kain,
            
            'no_produksi'   => $no_produksi,

            'kd_mesin'      => $kd_mesin,

            'kd_gudang'     => $kd_gudang,
            
            'kd_customer'   => $kd_customer,

            'no_wo'         => $no_wo,

            'gramasi'       => $gramasi,

            'kg_grey'       => $kd_grey,

            'kd_partai'     => $kd_partai,
            
            'kd_subcon'     => $kd_subcon,

            'no_tr_maklun'  => $no_tr_maklun,

            'no_tr_kainjadi'=> $no_tr_kainjadi,
            
            'kg_fin'        => $kg_fin,

            'setting'       => $setting,

            'kd_warna'      => $kd_warna,
            
            'status'        => $status


           );

        }

      }

      $this->MStock_kain->insertStock_kain($data);

    }

  }

//fungsi bypass stock awal grey maklun kinjadi
function StockAwal(){

   $data['result'] = $this->MStock_kain->getAll();

   $this->load->view('Webmaster/VStockAwal', $data);

 }

//fungsi untuk proses import excel
 function importStockAwal(){

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
          //baca data dari excel berdasar matrik kolom dan baris (kolom,baris)
           $no_tr_grey   = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $kd_kain      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $no_produksi  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $kd_mesin     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

           $kd_gudang    = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $kd_customer  = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

           $no_wo        = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

           $gramasi      = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

           $kg_grey      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

           $kd_partai    = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

           $kd_subcon    = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

           $no_tr_maklun = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

           $no_tr_kainjadi= $worksheet->getCellByColumnAndRow(12, $row)->getValue();

           $kd_fin       = $worksheet->getCellByColumnAndRow(13, $row)->getValue();

           $setting      = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

           $kd_warna     = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

           $no_jual      = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

           $status       = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

           $data[] = array(

            'no_tr_grey'    => $no_tr_grey,

            'kd_kain'       => $kd_kain,
            
            'no_produksi'   => $no_produksi,

            'kd_mesin'      => $kd_mesin,

            'kd_gudang'     => $kd_gudang,
            
            'kd_customer'   => $kd_customer,

            'no_wo'         => $no_wo,

            'gramasi'       => $gramasi,

            'kg_grey'       => $kd_grey,

            'kd_partai'     => $kd_partai,
            
            'kd_subcon'     => $kd_subcon,

            'no_tr_maklun'  => $no_tr_maklun,

            'no_tr_kainjadi'=> $no_tr_kainjadi,
            
            'kg_fin'        => $kg_fin,

            'setting'       => $setting,

            'kd_warna'      => $kd_warna,

            'no_jual'       => $no_jual,
            
            'status'        => $status


           );

        }

      }

      $this->MStock_kain->insertStock_kain($data);

    }

  }

}

?>