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

 //fungsi tampilan stock maklun
function tampilMaklun(){
	 $data['result'] = $this->MStock_kain->getStockMaklun();
	 $data['judul']  = "Data Stock Maklun";

	 $this->load->view('Kesma/VStock_kain', $data);

 }

 //fungsi tampilan stock maklun
function tampilkainjadi(){
	 $data['result'] = $this->MStock_kain->getStockKainjadi();
	 $data['judul']  = "Data Stock Kain Jadi";

	 $this->load->view('Kesma/VStock_kain', $data);

 }

}

?>