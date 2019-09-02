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
//   $this->load->library('session');
 }



//fungsi tampilan index
function index(){
	 $data['result'] = $this->MStock_akhir_benang->readStock_akhir_benang();
	 $this->load->view('Kesma/VStock_akhir_benang', $data);

 }

//fungsi search engine
 function cari(){
 	$keyword		= $this->input->post('keyword');
 	$data['cari'] = $this->MStock_akhir_benang->cariBenang();
 	$this->load->view('', $data);

 }

}

?>