<?php
class MUser extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*
	public function get_memberByUsername($username){
		return $this->db->get->get_where('username', array('username'=>$username))->row();
	
	}  */

	//fungsi untuk mendapatkan data by id
	function getById($kd_user){

			$this->db->select('*');
			$this->db->from('user_tb');
			//$this->db->join('akses_tb','akses_tb.id_akses=user_tb.level')
			$this->db->where('kd_user', $kd_user);
			$query = $this->db->get();
			return $query;
	}

	//fungsi untuk login
	public function cek_user($data){
		$query = $this->db->get_where('user_tb',$data);
		return $query;
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	//fungsi untuk create user
	function createUser($data){
		$query =$this->db->insert('user_tb',$data);
		return $query;
	}

	function update($kd_user, $table, $data){
		$this->db->where('kd_user', $kd_user);
		$query = $this->db->update($table, $data);
		return $query;
	}
	//fungsi untuk delete user
	function deleteUser($kd_user){
		$this->db->where('kd_user', $kd_user);
		$query = $this->db->delete('user_tb');
		return $query;
	}


	function lihatUser(){
		$query = $this->db->query("SELECT * FROM user_tb");
		return $query;
	}

	//other function
	function get_mysqli(){
		$db = (array)get_instance()->db;
		return mysqli_connect('localhost',$db['username'],$db['password'],$db['database']);
	}

	function read($table, $cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get($table);
		return $query;
	}

	//new
	function resetPassword($level,$pass){
			$this->db->trans_start();
			$this->db->where("level",$level);
			$this->db->update("user_tb",$pass);
			$this->db->trans_complete();
			
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			} else {
				// any trans error?
				if ($this->db->trans_status() === FALSE) {
					return false;
				}
				return true;
			}
		}


	//fungsi untuk mendapatkan kd_user
		function getKd_user(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_user,3)) AS kd_max FROM user_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="U";
        return $inisial.$kd;
     }

	
		
}
?>