<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MJarum extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//fungsi untuk read benang ke export excel
	function fetch_data(){

	        $this->db->order_by("kd_jarum", "ASC");

            $query = $this->db->get("jarum");

            return $query->result();

	}

	//fungsi untuk read jarum
	function readJarum(){

			$this->db->select('*');

 			$this->db->from('jarum');

 			$this->db->where('kd_jarum !=','0');

			//$this->db->order_by('kd_jarum','DESC');

 			$query = $this->db->get();

 			return $query;

	}
	//
	function cariJarum($key){

			$this->db->select('*');

 			$this->db->from('jarum');

 			$this->db->like($key);

			//$this->db->order_by('kd_jarum','DESC');

 			$query = $this->db->get();

 			return $query;

	}
	
	//fungsi create jarum
	function createJarum($data){

			$query = $this->db->insert('jarum',$data);

			return $query;

	}

	//fungsi create jarum dari excel
	function insertJarum($data){

			$query = $this->db->insert_batch('jarum',$data);

			return $query;

	}

	function editJarum($kd_jarum,$table,$data){

			$this->db->where('kd_jarum', $kd_jarum);

			$query = $this->db->edit($table, $data);

			return $query;

	}

	//fungsi update jarum
	function updateJarum($kd_jarum,$table,$data){

			$this->db->where('kd_jarum', $kd_jarum);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//fungsi delete jarum
	function deleteJarum($kd_jarum){

			$this->db->where('kd_jarum', $kd_jarum);

			$query = $this->db->delete('jarum');

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_jarum){

			$this->db->select('*');

			$this->db->from('jarum');

			$this->db->where('kd_jarum', $kd_jarum);

			$query = $this->db->get();

			return $query->row();

	}

	function getjumlah($kd_jarum){

			$this->db->select('jumlah');

			$this->db->from('jarum');

			$this->db->where('kd_jarum', $kd_jarum);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mengambil nama colom
	//controller Benang/import
	function getColoumnName(){

		$query = $this->db->list_fields('jarum');

		return $query;

	}

	//fungsi untuk mendapatkan nomor penerimaan
	function getKd_jarum(){

        $q = $this->db->query("SELECT MAX(RIGHT(kd_jarum,3)) AS kd_max FROM jarum");

        $kd = "";

        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%03s", $tmp);
    
            }
    
        }else{
    
            $kd = "001";
    
        }
    
        $inisial="JRM";
    
        return $inisial.$kd;
    
     }

}	

?>