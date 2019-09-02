<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTop_up extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//fungsi untuk read benang
	function readTop_up(){
			$this->db->select('*');
 			$this->db->from('topup_produksi');
 			$this->db->join('stock_akhir_benang','stock_akhir_benang.kd_benang	=	topup_produksi.kd_benang');
		 	$this->db->join('benang_tb','benang_tb.kd_jenis						=	stock_akhir_benang.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor					=	stock_akhir_benang.kd_vendor');
		 	$this->db->join('user_tb','user_tb.kd_user							=	topup_produksi.kd_user');
		 	$this->db->where('ststus_topup','1');
 			$query = $this->db->get();
 			return $query;
	}
	
	//fungsi create benang
	function createTop_up($data){
			$query = $this->db->insert('topup_produksi',$data);
			return $query;
	}

	function editTop_up($id_p,$table,$data){
			$this->db->where('id_p', $id_p);
			$query = $this->db->edit($table, $data);
			return $query;
	}

	//fungsi update by id
	function updateTop_up($id_p,$table,$data){
			$this->db->where('id_p', $id_p);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi update by key
	function updateByNo_produksi($no_produksi,$table,$key){
			$this->db->where('no_produksi', $no_produksi);
			$query = $this->db->update($table, $key);
			return $query;
	}

	//fungsi delete benang
	function deleteTop_up($id_p){
			$this->db->where('id_p', $id_p);
			$query = $this->db->delete('topup_produksi');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($id_p){

			$this->db->select('*');
			$this->db->from('topup_produksi');
			$this->db->join('stock_akhir_benang','stock_akhir_benang.kd_benang	=	topup_produksi.kd_benang');
		 	$this->db->join('benang_tb','benang_tb.kd_jenis						=	stock_akhir_benang.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor					=	stock_akhir_benang.kd_vendor');
		 	$this->db->join('user_tb','user_tb.kd_user							=	topup_produksi.kd_user');
			$this->db->where('id_p', $id_p);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan data by key
	function getByKey($key){

			$this->db->select('*');
			$this->db->from('topup_produksi');
			$this->db->join('stock_akhir_benang','stock_akhir_benang.kd_benang	=	topup_produksi.kd_benang');
		 	$this->db->join('benang_tb','benang_tb.kd_jenis						=	stock_akhir_benang.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor					=	stock_akhir_benang.kd_vendor');
		 	$this->db->join('user_tb','user_tb.kd_user							=	topup_produksi.kd_user');
			$this->db->where($key);
			$query = $this->db->get();
			return $query;
	}

}	

?>