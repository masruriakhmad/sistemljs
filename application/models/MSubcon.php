<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MSubcon extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	

	//untuk CRUD di tabel
	//fungsi create
	function createSubcon($data){
			$query = $this->db->insert('subcon_tb',$data);
			return $query;
	}

	//fungsi read
	function readSubcon(){
			$query = $this->db->query("SELECT * FROM subcon_tb");
			return $query;
	}

	//fungsi update
	function updateSubcon($kd_subcon,$table,$data){
			$this->db->where('kd_subcon', $kd_subcon);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete
	function deleteSubcon($kd_subcon,$table,$data){
			$this->db->where('kd_subcon', $kd_subcon);
			$query = $this->db->delete('subcon_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_subcon){

			$this->db->select('*');
			$this->db->from('subcon_tb');
			$this->db->where('kd_subcon', $kd_subcon);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan nomor otomatis
		function getKd_subcon(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_subcon,4)) AS kd_max FROM subcon_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        $inisial="S";
        return $inisial.$kd;
     }	
}

?>
