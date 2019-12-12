<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVendorjarum extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//untuk CRUD di tabel
	function createVendorjarum($data){

			$query = $this->db->insert('vendor_jarum',$data);

			return $query;

	}

	//fungsi create dari excel
	function insertVendorjarum($data){

			$query = $this->db->insert_batch('vendor_jarum',$data);

			return $query;

	}

	function readVendorjarum(){

			$this->db->select('*');

 			$this->db->from('vendor_jarum');

			$this->db->order_by('nm_vendorjarum','ASC');

 			$query = $this->db->get();

 			return $query;

 	}

	function updateVendorjarum($kd_vendorjarum,$table,$data){

			$this->db->where('kd_vendorjarum', $kd_vendorjarum);

			$query = $this->db->update($table, $data);

			return $query;

	}

	function deleteVendorjarum($kd_vendorjarum,$table,$data){

			$this->db->where('kd_vendorjarum', $kd_vendorjarum);

			$query = $this->db->delete('vendor_jarum');

			return $query;

	}	

	function getById($kd_vendorjarum){

			$this->db->select('*');

			$this->db->from('vendor_jarum');

			$this->db->where('kd_vendorjarum', $kd_vendorjarum);

			$query = $this->db->get();

			return $query->row();

	}

    //fungsi untuk mengambil nama colom
	//controller vendors/import
	function getColoumnName(){

			$query = $this->db->list_fields('vendor_jarum');

			return $query;

	}

		//fungsi untuk mendapatkan nomor otomatis
	function getkd_vendorjarum(){

        $q = $this->db->query("SELECT MAX(RIGHT(kd_vendorjarum,3)) AS kd_max FROM vendor_jarum");

        $kd = "";

        if($q->num_rows()>0){

            foreach($q->result() as $k){

                $tmp = ((int)$k->kd_max)+1;

                $kd = sprintf("%03s", $tmp);

            }

        }else{

            $kd = "001";

        }

        $inisial="VJ";

        return $inisial.$kd;

     }	
	
}

?>
