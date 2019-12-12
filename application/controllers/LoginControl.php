<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginControl extends CI_Controller {

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
 function home(){

 	$data['kd_user']		= $this->session->userdata('kd_user');

 	$data['nm_user']		= $this->session->userdata('nm_user');

 	$data['username']		= $this->session->userdata('username');

 	$data['level']			= $this->session->userdata('level');

    $data['result'] 		= $this->MProduksi->readProduksi();

	$data['no_produksi']	= $this->MProduksi->get_no_produksi();

	redirect(base_url('Home'));

 	//print_r($this->session->userdata());
 	//$this->load->view('Kesma/VHome', $data);

 }

 //fungsi untuk menuju Form Edit Password
function admin(){

	$this->load->view('FormAdmin');

}

//fungsi untuk login
function index(){

	$this->load->view('VFormLogin');

}

//fungsi untuk login gagal

//fungsi login


public function login()

	{

		$data = array('username' => $this->input->post('username') , 

					  'password' => md5($this->input->post('password'))

					  );

		$hasil = $this->MUser->cek_user($data);

		if ($hasil->num_rows() == 1){

			foreach($hasil->result() as $sess)

            {

              $sess_data['logged_in'] = 'Sudah Login';

              $sess_data['kd_user']   = $sess->kd_user;

              $sess_data['nm_user']   = $sess->nm_user;

              $sess_data['username']  = $sess->username;

              $sess_data['level']     = $sess->level;

              $this->session->set_userdata($sess_data);

              redirect('LoginControl/home');

            }
			
		}
	
		else
	
		{
	
			echo " <script>alert('Gagal Login: Cek username , password!');history.go(-1);</script>";
	
		}

}

//fungsi logout
function logout(){

	$this->session->unset_userdata('username', $row['username']);

	$this->session->unset_userdata('nm_user', $row['nm_user']);

	$this->session->unset_userdata('kd_user', $row['kd_user']);

	$this->session->unset_userdata('password', $row['password']);

	$this->session->unset_userdata('level', $row['level']);

	redirect(base_url('LoginControl/index'));

	}

function lupaPassword(){

	$this->load->view('VLupaPassword');

	}

}

?>