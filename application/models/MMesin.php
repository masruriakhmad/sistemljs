<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMesin extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//fungsi untuk read mesin
	function readMesin(){
			$this->db->select('*');
 			$this->db->from('mesin_tb');
 			$this->db->order_by('no_mesin','ASC');
 			$query = $this->db->get();
 			return $query;
	}
	
	//fungsi create mesin
	function createMesin($data){
			$query = $this->db->insert('mesin_tb',$data);
			return $query;
	}
	//fungsi update mesin
	function updateMesin($kd_mesin,$table,$data){
			$this->db->where('kd_mesin', $kd_mesin);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi delete mesin
	function deleteMesin($kd_mesin,$table,$data){
			$this->db->where('kd_mesin', $kd_mesin);
			$query = $this->db->delete('mesin_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($kd_mesin){

			$this->db->select('*');
			$this->db->from('mesin_tb');
			$this->db->where('kd_mesin', $kd_mesin);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk get by key
	function getMesinByKey($kd_benang){

         $this->db->select('*');
         $this->db->from('mesin_tb');
         //$this->db->join('benang_tb','benang_tb.kd_jenis		=	stock_akhir_benang.kd_jenis');
		 //$this->db->join('vendor_tb','vendor_tb.kd_vendor	    =	stock_akhir_benang.kd_vendor');
         //$this->db->where('kd_benang', $kd_benang);
         $this->db->where('status_mesin',0);
         $this->db->or_where('kd_benang',$kd_benang);
         $query = $this->db->get();
         return $query->result();
      }

	//fungsi reset mesin
	function resetMesin($kd_mesin,$table,$data){
			$this->db->where('kd_mesin', $kd_mesin);
			$query = $this->db->update($table, $data);
			return $query;
	}


	//fungsi untuk mendapatkan nomor otomatis
		function getKd_mesin(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_mesin,3)) AS kd_max FROM mesin_tb");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        $inisial="M";
        return $inisial.$kd;
     }
}	

?>