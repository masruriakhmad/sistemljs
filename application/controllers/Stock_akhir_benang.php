<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_akhir_benang extends CI_Controller {

 function __construct()
 
 {
 
   parent::__construct();
 
   //load model yang diperlukan
   $this->load->helper('url');
 
   $this->load->model('MStock_akhir_benang');
 
   $this->load->model('MBenang');
 
   $this->load->model('MVendor');
 
   $this->load->model('Mgudang');
 
   $this->load->model('MUser');

   $this->load->library('session');

   $this->load->library('excel');

   $this->load->library('form_validation');

 }

//fungsi tampilan index
function index(){

	 $data['result'] = $this->MStock_akhir_benang->readStock_akhir_benang();

	 $this->load->view('Kesma/VStock_akhir_benang', $data);

 }

  //function untuk bypass stock awal
 function StockAwal(){

  $data['result'] = $this->MStock_akhir_benang->getAll();

  $this->load->view('Webmaster/VStockAwalBenang', $data);

 }

//fungsi search engine
function cari(){

 	$keyword		= $this->input->post('keyword');

 	$data['cari'] = $this->MStock_akhir_benang->cariBenang();

 	$this->load->view('', $data);

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
           $kd_benang    = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
       
           $kd_jenis     = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

           $kd_jvendor   = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

           $kd_gudang    = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

           $stock        = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

           $data[] = array(

            'kd_benang'       => $kd_benang,

            'kd_jenis'        => $kd_jenis,
            
            'kd_vendor'       => $kd_vendor,

            'kd_gudang'       => $kd_gudang,

            'stock'           => $stock

           );

        }

      }

      $this->MStock_akhir_benang->insertStock_akhir_benang($data);

    }

  }

//fungsi untuk export excel
function export(){

      $this->load->model("MStock_akhir_benang");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MStock_akhir_benang->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Stock Benang');

      $object->getActiveSheet()->setTitle('Data Stock Benang');

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);

        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);

        $column++;

      }

      $stock_benang_data = $this->MStock_akhir_benang->readStock_akhir_benang()->result();

      $excel_row = 3;

      foreach($stock_benang_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_benang);//import

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->kd_jenis);//import

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->kd_vendor);//import

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->kd_gudang);//import

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->stock);//import

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-stock-akhir-benang.xls"');

      $object_writer->save('php://output');

    }

}

?>