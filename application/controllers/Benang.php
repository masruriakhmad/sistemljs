<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Benang extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MBenang');
   $this->load->library('session');
   $this->load->library('excel');
   $this->load->library('form_validation');
 }


//fungsi tampilan index 
function index(){
	 $data['result']     = $this->MBenang->readBenang();
   $data['kd_jenis']   = $this->MBenang->getKd_jenis();
   $this->load->view('Kesma/VBenang', $data);
   
 }


//fungsi untuk link tampilan input
 function create()
 {
 	$this->load->view('Kesma/VFormbenang');
 }


//fungsi untuk proses input record
 function createProses(){
 	$kd_jenis          = $this->MBenang->getKd_jenis();
 	$jenis_benang      = $this->input->post('jenis_benang');

 	$data              = array(

      'kd_jenis'     =>$kd_jenis,
      'jenis_benang' =>$jenis_benang
    );
 	
  $insert		   = $this->MBenang->createBenang($data);


 	 $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data Berhasil ditambahkan </div>');

 	redirect(base_url('Benang')); 
 }


//untuk menampilkan data yang akan diedit
 function edit($kd_jenis){
 	$this->db->where('kd_jenis', $kd_jenis);
 	$query = $this->db->get('benang_tb');
 	$this->data['edit'] = $query->row_array();

 	$this->load->view('Kesma/VFormeditbenang', $this->data);
 }

 //proses update data ke database
 function update(){
   $kd_jenis  = $this->input->post('kd_jenis');
  $jenis_benang  = $this->input->post('jenis_benang');

  //fungsi untuk update record
  $data = array(
      'kd_jenis'=>$kd_jenis,
      'jenis_benang'=>$jenis_benang
     
    );

  $update = $this->MBenang->updateBenang($kd_jenis, 'benang_tb', $data);
  if($update){
    $this->session->set_flashdata('notifedit','<div class="alert alert-primary alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil diubah </div>');
    redirect(base_url('Benang'));
  }else{
    echo "Gagal";
  }

 }

//fungsi untuk menghapus record
  function delete($kd_jenis){
  $this->db->delete('benang_tb', array('kd_jenis'=>$kd_jenis));
  $this->session->set_flashdata('notifhapus','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data Berhasil dihapus </div>');
  redirect(base_url('Benang'));
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
        $query = $this->MBenang->getColoumnname();

        for($row=3; $row<=$highestRow; $row++){
          //baca data dari excel berdasar matrik kolom dan baris (cell) kolom 1
           $kd_jenis     = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
          //baca data dari excel berdasar matrik kolom dan baris (cell) kolom 2
           $jenis_benang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();




           $data[] = array(

            'kd_jenis'       => $kd_jenis,
            'jenis_benang'   => $jenis_benang

           );

        }

      }

      $this->MBenang->insertBenang($data);

      $this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> Data dari EXCEL Berhasil ditambahkan </div>');

      redirect(base_url('Benang')); 

    }

  }

//fungsi untuk export excel
function export(){

      $this->load->model("MBenang");

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      // Nama Field Baris Pertama
      $table_columns = $this->MBenang->getColoumnName();

      $column = 0;

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'Data Master Benang');
      $object->getActiveSheet()->setTitle('Data Master Benang');

      foreach($table_columns as $field){


        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
        $object->getActiveSheet()->getColumnDimension()->setAutoSize(true);
        $object->getSheet(0)->getStyle('A3:C3')->getBorders()->getAllBorders()->getColor()->setRGB('949FA8');
        $column++;

      }

      $benang_data = $this->MBenang->fetch_data();

      $excel_row = 3;

      foreach($benang_data as $row){

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_jenis);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->jenis_benang);

        $excel_row++;

      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Data-master-benang.xls"');

      $object_writer->save('php://output');

    }

}

?>