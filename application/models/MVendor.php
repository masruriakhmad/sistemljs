<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVendor extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//untuk CRUD di tabel
	function createVendor($data){
			$query = $this->db->insert('vendor_tb',$data);
			return $query;
	}

	function readVendor(){
			$this->db->select('*');
 			$this->db->from('vendor_tb');
 			$this->db->where('kd_vendor !=','J000');
 			$query = $this->db->get();
 			return $query;
 	}

	function updateVendor($kd_vendor,$table,$data){
			$this->db->where('kd_vendor', $kd_vendor);
			$query = $this->db->update($table, $data);
			return $query;
	}

	function deleteVendor($kd_vendor,$table,$data){
			$this->db->where('kd_vendor', $kd_vendor);
			$query = $this->db->delete('vendor_tb');
			return $query;
	}	

	function getById($kd_vendor){

			$this->db->select('*');
			$this->db->from('vendor_tb');
			$this->db->where('kd_vendor', $kd_vendor);
			$query = $this->db->get();
			return $query->row();
	}

		//fungsi untuk mendapatkan nomor otomatis
	function getKd_vendor(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_vendor,3)) AS kd_max FROM vendor_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="V";
        return $inisial.$kd;
     }	
	
}

?>
