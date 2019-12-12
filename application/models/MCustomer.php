<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCustomer extends CI_Model{
	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	 private $_table = 'customer_tb';
	
	//untuk CRUD di tabel
	//fungsi create
	function createCustomer($data){

			$query = $this->db->insert($this->_table,$data);

			return $query;

	}

	//fungsi create customer dari excel
	function insertCustomer($data){

			$query = $this->db->insert_batch($this->_table,$data);

			return $query;

	}

	//fungsi read
	function readCustomer(){
			$this->db->select('*');

			$this->db->from($this->_table);

			$this->db->order_by('nm_customer','ASC');

			$query = $this->db->get();

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

			$query = $this->db->delete($this->_table);

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_customer){

			$this->db->select('*');

			$this->db->from($this->_table);

			$this->db->where('kd_customer', $kd_customer);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mengambil nama colom
	//controller customer/import
	function getColoumnName(){

			$query = $this->db->list_fields($this->_table);

			return $query;

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

       		}

       		else{

            		$kd = "000001";

        	}

        	$inisial="C";

        	return $inisial.$kd;

     }	 

}

?>
