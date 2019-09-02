<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MGrey extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//fungsi untuk read benang
	function readGrey(){
			$this->db->select('*');
 			$this->db->from('grey_tb');
 			$this->db->join('benang_tb','benang_tb.kd_jenis = grey_tb.kd_jenis');
 			$query = $this->db->get();
 			return $query;
	}

	//fungsi ambil data berdasar key
	function getKainByKey($kd_jenis){

			$this->db->select('*');
			$this->db->from('grey_tb');
			$this->db->where('kd_jenis', $kd_jenis);
			//$this->db->join('benang_tb','benang_tb.kd_jenis = grey_tb.kd_jenis');
   			$query = $this->db->get();
			return $query->result();
	}

	//fungsi ambil kode jenis by kode kain
	function getJenisByKain($kd_kain){

			$this->db->select('*');
			$this->db->from('grey_tb');
			$this->db->where('kd_kain', $kd_kain);
			//$this->db->join('benang_tb','benang_tb.kd_jenis = grey_tb.kd_jenis');
   			$query = $this->db->get();
			return $query->row();
	}

	function getKain(){
			$this->db->select('*');
 			$this->db->from('grey_tb');
 			$query = $this->db->get();
 			return $query;
	}

	
	//fungsi create benang
	function createGrey($data){
			$query = $this->db->insert('grey_tb',$data);
			return $query;
	}
	//fungsi update benang
	function updateGrey($kd_kain,$table,$data){
			$this->db->where('kd_kain', $kd_kain);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete benang
	function deleteGrey($kd_kain,$table,$data){
			$this->db->where('kd_kain', $kd_kain);
			$query = $this->db->delete('grey_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_grey){

			$this->db->select('*');
			$this->db->from('grey_tb');
			$this->db->where('kd_grey', $kd_grey);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan nomor penerimaan
		function getKd_kain(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_kain,3)) AS kd_max FROM grey_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="K";
        return $inisial.$kd;
     }
}	

?>