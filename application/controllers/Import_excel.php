<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Benang extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');

   $this->load->model('MBenang');
   $this->load->model('MGrey');
   $this->load->model('MVendor');
   $this->load->model('MSubcon');
   $this->load->model('MStock_akhir_benang');
   $this->load->model('MStock_kain');

   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']     = $this->MBenang->readBenang();
   $data['kd_jenis']   = $this->MBenang->getKd_jenis();
   $this->load->view('Unggah/VUnggah_excel', $data);
   
 }


//fungsi unggah benang
 function unggahBenang(){
 
  //field  kd_jenis|jenis_benang

 }

 //fungsi unggah kain all
 function unggahStock_kain(){
 
  //field no_tr_grey | kd_kain | kd_jenis |no_produksi | kd_mesin | kd_gudang | kd_customer | no_wo | gramasi | kg_grey | kd_subcon | no_tr_maklun | kg_fin | setting |kd_warna | status

 }

//fungsi unggah Grey
 function unggahGrey(){
 //field kd_kain|nm_kain|kd_jenis
 

 }

 //unggah warna
  function unggahwarna(){
 //field kd_warna|nm_kain|kd_jenis
 

 }

  //unggah Customer
  function unggahCustomer(){
 //field 
 

 }

  //unggah subcon
  function unggahSubcon(){
 //field 
 

 }

  //unggah vendor
  function unggahvendors(){
 //field 
 

 }



}

?>