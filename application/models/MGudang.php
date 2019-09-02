<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MGudang extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	

	//untuk CRUD di tabel
	//fungsi create
	function createGudang($data){
			$query = $this->db->insert('gudang_tb',$data);
			return $query;
	}

	//fungsi read
	function readGudang(){
			$query = $this->db->query("SELECT * FROM gudang_tb");
			return $query;
	}

	//fungsi update
	function updateGudang($kd_gudang,$table,$data){
			$this->db->where('kd_gudang', $kd_gudang);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete
	function deleteGudang($kd_gudang,$table,$data){
			$this->db->where('kd_gudang', $kd_gudang);
			$query = $this->db->delete('gudang_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_gudang){

			$this->db->select('*');
			$this->db->from('gudang_tb');
			$this->db->where('kd_gudang', $kd_gudang);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan nomor otomatis
		function getKd_gudang(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_gudang,4)) AS kd_max FROM gudang_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="G";
        return $inisial.$kd;
     }	
}

?>
