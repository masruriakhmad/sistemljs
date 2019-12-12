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

			$this->db->order_by('nm_kain','ASC');
 	
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

		//fungsi create customer dari excel
	function insertGrey($data){

			$query = $this->db->insert_batch('grey_tb',$data);

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
	function getById($kd_kain){

			$this->db->select('*');

			$this->db->from('grey_tb');

			$this->db->where('kd_kain', $kd_kain);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mengambil nama colom
	//controller customer/import
	function getColoumnName(){

			$query = $this->db->list_fields('grey_tb');

			return $query;

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

     function getlistwobyid($id){
    		$this->db->select('*');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('grey_tb','grey_tb.kd_kain =  wo_tb.kd_kain');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer'); 			
 	
 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('user_tb','user_tb.kd_user         	   =  wo_tb.kd_user');
 	
 			$this->db->join('status','status.id         		   =  wo_tb.status_wo');
 	
 			$this->db->where('status_wo !=',0);

 			$this->db->where('wo_tb.kd_kain', $id);

 			$this->db->group_by('wo_tb.no_wo');

 			$query = $this->db->get();
 	
 			return $query->result();


    }

}	

?>