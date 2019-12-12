<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPengiriman_grey extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//untuk tampilan laporan
	//controller Pengiriman_grey/laporan
	function getAll(){

			$this->db->select('*');
 			
 			$this->db->from('kirimgrey_tb');
 			
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=kirimgrey_tb.kd_subcon');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=kirimgrey_tb.kd_user');
		 	
		 	$this->db->where('status !=',0);
 			
 			$query = $this->db->get();

 			return $query;


	}

	//untuk tampilan laporan
	//controller Pengiriman_grey/filter laporan
	function getByRangeTgl($key){

			$this->db->select('*');
 			
 			$this->db->from('kirimgrey_tb');
 			
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=kirimgrey_tb.kd_subcon');
		 	
		 	$this->db->join('user_tb','user_tb.kd_user						=kirimgrey_tb.kd_user');

		 	$this->db->where($key);
		 	
		 	$this->db->where('status !=',0);
 			
 			$query = $this->db->get();

 			return $query;

	}

	//untuk CRUD penerimaan benang
	function readPengiriman_grey(){
	
			$this->db->select('*');
 	
 			$this->db->from('kirimgrey_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=kirimgrey_tb.kd_subcon');
	
		 	$this->db->join('user_tb','user_tb.kd_user						=kirimgrey_tb.kd_user');
	
		 	$this->db->where('status','1');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

		//untuk CRUD penerimaan benang
	function readReturPengiriman_grey(){
	
			$this->db->select('*');
 	
 			$this->db->from('kirimgrey_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=kirimgrey_tb.kd_subcon');
	
		 	$this->db->join('user_tb','user_tb.kd_user						=kirimgrey_tb.kd_user');
	
		 	$this->db->where('status','R');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

		//untuk CRUD penerimaan benang
	function getById($no_tr_maklun){
	
			$this->db->select('*');
 	
 			$this->db->from('kirimgrey_tb');
 	
 			$this->db->join('subcon_tb','subcon_tb.kd_subcon				=kirimgrey_tb.kd_subcon');
	
		 	$this->db->join('user_tb','user_tb.kd_user						=kirimgrey_tb.kd_user');
	
		 	$this->db->where('no_tr_maklun',$no_tr_maklun);
 	
 			$query = $this->db->get()->row();
 	
 			return $query;
	
	}

	//get maklun by subcon untuk form create penerimaan kain jadi
	function getMaklunBySubcon($kd_subcon){
	
		    $this->db->select('*');
 	
 			$this->db->from('kirimgrey_tb');
	
		 	$this->db->where('kd_subcon',$kd_subcon);
 	
 			$query = $this->db->get()->result();
 	
 			return $query;

	}

	//fungsi untuk create penerimaan
	function getDate(){
	
			date_default_timezone_set('Asia/Jakarta');
	
			return date('Y-m-d H:i:s');
	
	}

	//fungsi untuk create penerimaan
	function createPengiriman_grey($data){
	
			$query = $this->db->insert('kirimgrey_tb',$data);
	
			return $query;
	}

	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_tr_maklun(){
    
        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_maklun,6)) AS kd_max FROM kirimgrey_tb WHERE SUBSTRING(no_tr_maklun,4,2)=SUBSTRING(CURDATE(),3,2)");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%06s", $tmp);
    
            }
    
        }else{
    
            $kd = "000001";
    
        }
    
        $inisial="KRM";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('y').$kd;
    
     }

	//fungsi untuk batal penerimaan
	function batalPengiriman_grey($no_tr_maklun,$table,$data){
	
			$this->db->where('no_tr_maklun', $no_tr_maklun);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}
	
	//fungsi untuk delete pengiriman grey
	function deletePengiriman_grey($no_tr_maklun,$table,$data){
	
			$this->db->where('no_tr_maklun', $no_tr_maklun);
	
			$query = $this->db->delete('kirimgrey_tb');
	
			return $query;
	
	}

}	

?>
