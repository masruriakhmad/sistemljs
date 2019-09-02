<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCustomer extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	

	//untuk CRUD di tabel
	//fungsi create
	function createCustomer($data){
			$query = $this->db->insert('customer_tb',$data);
			return $query;
	}

	//fungsi read
	function readCustomer(){
			$query = $this->db->query("SELECT * FROM customer_tb");
			return $query;
	}

	//fungsi update
	function updateCustomer($kd_customer,$table,$data){
			$this->db->where('kd_customer', $kd_customer);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete
	function deleteCustomer($kd_customer){
			$this->db->where('kd_customer', $kd_customer);
			$query = $this->db->delete('customer_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_customer){

			$this->db->select('*');
			$this->db->from('customer_tb');
			$this->db->where('kd_customer', $kd_customer);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk mendapatkan nomor otomatis
		function getKd_customer(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_customer,6)) AS kd_max FROM customer_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $inisial="C";
        return $inisial.$kd;
     }	
}

?>
