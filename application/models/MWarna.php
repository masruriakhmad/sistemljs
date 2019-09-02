<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MWarna extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	

	//untuk CRUD di tabel
	//fungsi create
	function createWarna($data){
			$query = $this->db->insert('warna_tb',$data);
			return $query;
	}

	//fungsi read
	function readWarna(){

			$this->db->select('*');
			$this->db->from('warna_tb');
			$this->db->join('benang_tb','benang_tb.kd_jenis  =  warna_tb.kd_jenis');
			$this->db->where('kd_warna !=','0');
			$query = $this->db->get();
			return $query;
	}

	//fungsi update
	function updateWarna($kd_warna,$table,$data){
			$this->db->where('kd_warna', $kd_warna);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete
	function deleteWarna($kd_warna,$table,$data){
			$this->db->where('kd_warna', $kd_warna);
			$query = $this->db->delete('warna_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_warna){

			$this->db->select('*');
			$this->db->from('warna_tb');
			$this->db->join('benang_tb','benang_tb.kd_jenis  =  warna_tb.kd_jenis');
			$this->db->where('kd_warna', $kd_warna);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan data kd_warna by kd kain untuk penerimaan kainjadi
	function getWarnaByJenis($kd_jenis){

			$this->db->select('*');
			$this->db->from('warna_tb');
			$this->db->join('benang_tb','benang_tb.kd_jenis  =  warna_tb.kd_jenis');
			$this->db->where('warna_tb.kd_jenis', $kd_jenis);
			$query = $this->db->get();
			return $query->result();
	}

	//fungsi untuk mendapatkan nomor otomatis
		function getKd_warna(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_warna,4)) AS kd_max FROM warna_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        $inisial="W";
        return $inisial.$kd;
     }	
}

?>
