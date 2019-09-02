<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TopUp extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('MTop_up');
   $this->load->library('session');
 }


//fungsi tampilan index 
function index(){
	 $data['result']     = $this->MTop_up->readTop_up();
   $this->load->view('Kesma/VTopUp', $data);
   
 }

//fungsi tampilan index 
function detailTopUp($no_produksi){

   $data['result']     = $this->MTop_up->getByKey(array('no_produksi'=>$no_produksi));
   $this->load->view('Kesma/VTopUp', $data);
   
 }


}

?>