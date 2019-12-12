<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

 function __construct()

 {

	parent::__construct();

	$this->load->helper('text');

   	$this->load->helper('url');

   	$this->load->model('MUser');

   	$this->load->model('MPenerimaan_benang');

   	$this->load->model('MProduksi');

   	$this->load->model('MMesin');

   	$this->load->library('session');

 }

 //fungsi untuk menuju home
 function index(){

 	$data['kd_user']		= $this->session->userdata('kd_user');

 	$data['nm_user']		= $this->session->userdata('nm_user');

 	$data['username']		= $this->session->userdata('username');

 	$data['level']			= $this->session->userdata('level');

  $data['result'] 		= $this->MProduksi->readProduksi();

	$data['no_produksi']	= $this->MProduksi->get_no_produksi();

 	//print_r($this->session->userdata());
 	$this->load->view('Kesma/VHome', $data);

 }

}

?>