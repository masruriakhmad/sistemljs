<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->MBenang();
 }


//fungsi tampilan index 
function index(){
   $data['result'] = $this->MBenang->readBenang();
   $this->load->view('coba',$data);
   
 }


}

?>