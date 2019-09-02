<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DataUser{

	protected $ci;
	function __construct(){

		$this->ci=& get_instance();
	}

	function user_login(){
		$this->ci->load->model('MUser');
		$kd_user   = $this->ci->session->userdata('username');
		$user_data = $this->ci->MUser->getById($kd_user); 
		return $user_data;
	}

}


?>