<?php
	class Pengaturan extends CI_Controller{
		
		public $data = array(); 
		public $level;

		function __construct(){
			parent::__construct();
			$this->level = $this->session->userdata("level");
			//$this->load->model("MUser","user");
			$this->load->model("MUser");
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->library('user_agent');
			$this->data["nama"] = $this->session->userdata("nama");
		}

		function index(){ //reset password
			if($this->session->userdata('level')=='webmaster'){

				$this->data["result"] = $this->MUser->lihatUser();
				$this->load->view('Pengaturan/VLihatUser',$this->data);

			}else{

				$kd_user = $this->session->userdata('kd_user');
				$this->data["result"] = $this->MUser->getById($kd_user);
				$this->load->view('Pengaturan/VLihatUser',$this->data);

			}
		}
		
		function reset(){ //reset password
			if($this->session->userdata('level')=='webmaster'){

			$this->data["user"] 	= $this->MUser->lihatUser();
			$this->data["konten"] 	= "password/v_reset_password";

			$this->load->view('Pengaturan/VResetPassword',$this->data);


			}else{

			$kd_user = $this->session->userdata('kd_user');
			$this->data["user"]		= $this->MUser->getById($kd_user);
			$this->data["konten"] 	= "password/v_reset_password";

			$this->load->view('Pengaturan/VResetPassword',$this->data);

			}
			
		}

		//fungsi untuk link tampilan ke create user
 		function create(){
			
			$this->load->view('Pengaturan/VFormUser'); 				
 			
 		}

 		//fungsi untuk create proses User baru
 		function createProses(){
 			$kd_user  = $this->MUser->getKd_user();
 			$nm_user  = $this->input->post('nm_user');
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
			$cpassword= $this->input->post('cpassword');
			$level    = $this->input->post('level');

			//insert to database
			if($password == $cpassword){

				$data = array(

					'kd_user' =>$kd_user,
					'nm_user' =>$nm_user,
					'username'=>$username,
					'password'=>md5($password),
					'level'   =>$level
				);

				$insert = $this->MUser->createUser($data);
				$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> User Berhasil ditambahkan </div>');

				redirect(base_url('Pengaturan')); 


			}else{

				$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Gagal!</h4> password dan Confrim Password tidak sama </div>');

				redirect(base_url('Pengaturan/create'));


			}
 			

 		}

 		//fungsi untuk delete user
 		function delete($kd_user){
 			if($this->session->userdata('level')=='webmaster'){


 			$this->MUser->deleteUser($kd_user);
 			$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> User berhasil dihapus </div>');
 			redirect(base_url('Pengaturan'));
 			}else{
 			$this->session->set_flashdata('notif','<div class="alert alert-info alert alert-dismissible fade in" role="alert"><button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="icon fa fa-check"></i> GAGAL!</h4> Hanya Webmaster yang bisa melakukan penghapusan User </div>');
 			redirect(base_url('Pengaturan'));

 			}

 		}

		function resetPass($levelUser){
			if($levelUser == 'operator'){
				$pass = array('password' => md5('operator'));
			}elseif ($levelUser == 'admin') {
				$pass = array('password' => md5('admin'));
			}elseif ($levelUser == 'manager') {
				$pass = array('password' => md5('manager'));
			}elseif ($levelUser == 'webmaster') {
				$pass = array('password' => md5('webmaster'));
			}
			

			$reset = $this->MUser->resetPassword($levelUser,$pass);

			if($reset == TRUE){
						$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																	<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
																	Password berhasil direset.
																</div>
						');
						redirect("Pengaturan");
			}else{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
															<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
															Password gagal direset.
														  </div>
				');
				redirect("Pengaturan");
			}
			
		}

		function editPassword($kd_user){
			$this->db->where('kd_user', $kd_user);
			$query = $this->db->get('user_tb');
			$this->data['edit'] = $query->row_array();
			$this->load->view('Pengaturan/VGantiPassword', $this->data);
		}

		function edit_Password($kd_user){
			$this->db->where('kd_user', $kd_user);
			$query = $this->db->get('user_tb');
			$this->data['edit'] = $query->row_array();
			$this->load->view('Pengaturan/VGantiPassword1', $this->data);
		}


		function updatePassword($kd_user){
			$password = $this->input->post('password');
			$pwbaru = $this->input->post('pwbaru');
			$kpwbaru = $this->input->post('kpwbaru');

			//insert to database
			if(($password == $password) && ($pwbaru ==$kpwbaru)){

				$data = array(
					'password'=>md5($kpwbaru)
				);
				$update = $this->MUser->update($kd_user, 'user_tb', $data);
			}else{
				$errorteks = 'Konfirmasi password salah';
			}

			if($pwbaru=$kpwbaru){
				$this->session->set_flashdata('notif','<div class="col-md-10"><div class="alert alert-info alert alert-dismissible fade in" role="alert"> Password berhasil dirubah <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>');
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('notifGagal','<div class="alert alert-danger alert alert-dismissible fade in" role="alert"> Password baru dan konfirmasi password tidak sama <button type="button " class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				$this->load->view('EditPassGagal');
			}
		}


	}
	
?>