<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MBenang extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//fungsi untuk read benang ke export excel
	function fetch_data(){
	        $this->db->order_by("kd_jenis", "ASC");
            $query = $this->db->get("benang_tb");
            return $query->result();
	}

	//fungsi untuk read benang
	function readBenang(){
			$this->db->select('*');
 			$this->db->from('benang_tb');
 			$this->db->where('kd_jenis !=','0');
 			$query = $this->db->get();
 			return $query;
	}
	
	//fungsi create benang
	function createBenang($data){
			$query = $this->db->insert('benang_tb',$data);
			return $query;
	}
	//fungsi create benang dari excel
	function insertBenang($data){
			$query = $this->db->insert_batch('benang_tb',$data);
			return $query;
	}

	function editBenang($kd_jenis,$table,$data){
			$this->db->where('kd_jenis', $kd_jenis);
			$query = $this->db->edit($table, $data);
			return $query;
	}

	//fungsi update benang
	function updateBenang($kd_jenis,$table,$data){
			$this->db->where('kd_jenis', $kd_jenis);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete benang
	function deleteBenang($kd_jenis){
			$this->db->where('kd_jenis', $kd_jenis);
			$query = $this->db->delete('benang_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_jenis){

			$this->db->select('*');
			$this->db->from('benang_tb');
			$this->db->where('kd_jenis', $kd_jenis);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mengambil nama colom
	//controller Benang/import
	function getColoumnName(){
		$query = $this->db->list_fields('benang_tb');
		return $query;
	}

	//fungsi untuk mendapatkan nomor penerimaan
		function getKd_jenis(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_jenis,3)) AS kd_max FROM benang_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="J";
        return $inisial.$kd;
     }
}	

?>