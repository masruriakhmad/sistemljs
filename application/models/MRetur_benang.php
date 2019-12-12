<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRetur_benang extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//untuk tampilan laporan
	//controller Pengiriman_grey/laporan
	function getAll(){

			$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');
		 	
		 	$this->db->where('status !=',0);
 			
 			$query = $this->db->get();

 			return $query;

	}

	//untuk tampilan laporan
	//controller Pengiriman_grey/filter laporan
	function getByRangeTgl($key){

			$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');

		 	$this->db->where($key);
		 	
		 	$this->db->where('status !=',0);
 			
 			$query = $this->db->get();

 			return $query;

	}

	function readRetur_benang(){
	
			$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');
		 	
		 	$this->db->where('status !=',0);
 			
 			$query = $this->db->get();

 			return $query;
	
	}

		//untuk CRUD penerimaan benang
	function getById($no_retur_benang){
	
			$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');

		 	$this->db->where('no_retur_benang',$no_retur_benang);
 	
 			$query = $this->db->get()->row();
 	
 			return $query;
	
	}

	//get maklun by subcon untuk form create penerimaan kain jadi
	function getByVendor($kd_vendor){
	
		  	$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');

		 	$this->db->where('kd_vendor',$kd_vendor);
 	
 			$query = $this->db->get();
 	
 			return $query;

	}

	//get maklun by subcon untuk form create penerimaan kain jadi
	function getByJenis($kd_jenis){
	
		  	$this->db->select('*');
 			
 			$this->db->from('retur_benang_tb');
 			
 			$this->db->join('vendor_tb','vendor_tb.kd_vendor	    		=retur_benang_tb.kd_vendor');

 			$this->db->join('benang_tb','benang_tb.kd_jenis	         		=retur_benang_tb.kd_jenis');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=retur_benang_tb.kd_user');

		 	$this->db->where('kd_jenis',$kd_jenis);
 	
 			$query = $this->db->get();
 	
 			return $query;

	}

	//fungsi untuk create penerimaan
	function getDate(){
	
			date_default_timezone_set('Asia/Jakarta');
	
			return date('Y-m-d H:i:s');
	
	}

	//fungsi untuk create penerimaan
	function createRetur_benang($data){
	
			$query = $this->db->insert('retur_benang_tb',$data);
	
			return $query;
	}

	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_retur_benang(){
    
        $q = $this->db->query("SELECT MAX(RIGHT(no_retur_benang,6)) AS kd_max FROM retur_benang_tb");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%06s", $tmp);
    
            }
    
        }else{
    
            $kd = "000001";
    
        }
    
        $inisial="RTB";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('y').$kd;
    
     }

	//fungsi untuk batal penerimaan
	function batalRetur_benang($no_retur_benang,$table,$data){
	
			$this->db->where('no_retur_benang', $no_retur_benang);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//fungsi untuk batal penerimaan
	function updateRetur_benang($no_retur_benang,$table,$data){
	
			$this->db->where('no_retur_benang', $no_retur_benang);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}
	
	//fungsi untuk delete pengiriman grey
	function deleteRetur_benang($no_retur_benang){
	
			$this->db->where('no_retur_benang', $no_retur_benang);
	
			$query = $this->db->delete('retur_benang_tb');
	
			return $query;
	
	}

}	

?>
