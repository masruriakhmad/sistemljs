<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenerimaan_kainjadi extends CI_Model{
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->database();
	
	}

	//untuk laporan penerimaan kain jadi
	//controler Penerimaan_kain jadi/laporan
	function getAll(){
	
			$this->db->select('*');
 	
 			$this->db->from('terimakainjadi_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon = terimakainjadi_tb.kd_subcon');
 	
 			$this->db->join('user_tb','user_tb.kd_user = terimakainjadi_tb.kd_user');
 	
 			$this->db->where('status !=',0);
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//untuk laporan penerimaan kain jadi
	//controler Penerimaan_kain jadi/laporan
	function getByRangeTgl($key){
	
			$this->db->select('*');
 	
 			$this->db->from('terimakainjadi_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon = terimakainjadi_tb.kd_subcon');
 	
 			$this->db->join('user_tb','user_tb.kd_user = terimakainjadi_tb.kd_user');

 			$this->db->where($key);

 			$this->db->where('status !=',0);
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//untuk CRUD penerimaan benang
	function readPenerimaan_kainjadi(){
	
			$this->db->select('*');
 	
 			$this->db->from('terimakainjadi_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon = terimakainjadi_tb.kd_subcon');
 	
 			$this->db->join('user_tb','user_tb.kd_user = terimakainjadi_tb.kd_user');
 	
 			$this->db->where('status',1);
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//fungsi untuk mendapatkan data by id (no_tr_kainjadi)
	function getById($no_tr_kainjadi){
	
			$this->db->select('*');
 	
 			$this->db->from('terimakainjadi_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=terimakainjadi_tb.kd_subcon');
	
		 	$this->db->join('user_tb','user_tb.kd_user						=terimakainjadi_tb.kd_user');
	
		 	$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);
 	
 			$query = $this->db->get()->row();
 	
 			return $query;
	
	}

	//fungsi untuk create penerimaan
	function getDate(){
	
			date_default_timezone_set('Asia/Jakarta');
	
			return date('Y-m-d H:i:s');
	
	}

	//fungsi untuk create penerimaan
	function createPenerimaan_kainjadi($data){
	
			$query = $this->db->insert('terimakainjadi_tb',$data);
	
			return $query;
	
	}

	//fungsi untuk mendapatkan nomor penerimaan
		function get_no_tr_kainjadi(){
    
        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_kainjadi,4)) AS kd_max FROM terimakainjadi_tb WHERE DATE(tgl)=CURDATE()");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%04s", $tmp);
    
            }
    
        }else{
    
            $kd = "0001";
    
        }
    
        $inisial="PRK";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('ymd').$kd;
    
     }

	//fungsi untuk batal penerimaan
	function batalPenerimaan_kainjadi($no_tr_kainjadi,$table,$data){
	
			$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}
	
	function deletePenerimaan_kainjadi($no_tr_kainjadi,$table,$data){
	
			$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);
	
			$query = $this->db->delete('terimakainjadi_tb');
	
			return $query;
	
	}

	//fungsi untuk mengambil nama colom
	//controller Penerimaan_kainjadi/export
	function getColoumnName(){
	
		$query = $this->db->list_fields('terimagrey_tb');
	
		return $query;
	
	}



}	

?>
