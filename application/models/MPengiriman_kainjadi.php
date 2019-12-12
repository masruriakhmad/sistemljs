<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPengiriman_kainjadi extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//untuk laporan pengiriman kain jadi
	//controler Pengirimann_kain jadi/laporan
	function getAll(){

			$this->db->select('*');

 			$this->db->from('kirimkainjadi_tb');

 			$this->db->where('status !=',0);

 			$this->db->join('customer_tb','customer_tb.kd_customer = kirimkainjadi_tb.kd_customer');

 			$this->db->join('user_tb','user_tb.kd_user = kirimkainjadi_tb.kd_user');

 			$query = $this->db->get();

 			return $query;

	}

	//untuk laporan pengiriman kain jadi
	//controler Pengirimann_kain jadi/laporanFilter
	function getByRangeTgl($key){

		     $this->db->select('*');

 			$this->db->from('kirimkainjadi_tb');

 			$this->db->where('status !=',0);

 			$this->db->join('customer_tb','customer_tb.kd_customer = kirimkainjadi_tb.kd_customer');

 			$this->db->join('user_tb','user_tb.kd_user = kirimkainjadi_tb.kd_user');

 			$this->db->where($key);

 			$query = $this->db->get();

 			return $query;

	
	}

	//untuk CRUD penerimaan benang
	function readPengiriman_kainjadi(){

			$this->db->select('*');

 			$this->db->from('kirimkainjadi_tb');

 			$this->db->where('status !=',0);

 			$this->db->join('customer_tb','customer_tb.kd_customer = kirimkainjadi_tb.kd_customer','left');

 			$query = $this->db->get();

 			return $query;

	}

	//fungsi untuk create penerimaan
	function getDate(){

			date_default_timezone_set('Asia/Jakarta');

			return date('Y-m-d H:i:s');

	}

	//fungsi untuk create penerimaan
	function createPengiriman_kainjadi($data){
	
			$query = $this->db->insert('kirimkainjadi_tb',$data);
	
			return $query;
	
	}

	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_jual(){
    
        $q = $this->db->query("SELECT MAX(RIGHT(no_jual,4)) AS kd_max FROM kirimkainjadi_tb WHERE DATE(tgl)=CURDATE()");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%04s", $tmp);
    
            }
    
        }else{
    
            $kd = "0001";
    
        }
    
        $inisial="IDJ";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('ymd').$kd;
    
     }

	//fungsi untuk batal penerimaan
	function batalPengiriman_kainjadi($no_jual,$table,$data){
	
			$this->db->where('no_jual', $no_jual);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}
	
	function deletePengiriman_kainjadi($no_jual,$table,$data){
	
			$this->db->where('no_jual', $no_jual);
	
			$query = $this->db->delete('kirimkainjadi_tb');
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by id
	function getById($no_jual){

			$this->db->select('*');
	
			$this->db->from('kirimkainjadi_tb');
	
			$this->db->join('customer_tb','customer_tb.kd_customer = kirimkainjadi_tb.kd_customer');
	
			$this->db->join('user_tb','user_tb.kd_user             = kirimkainjadi_tb.kd_user');
	
			$this->db->where('no_jual', $no_jual);
	
			$query = $this->db->get();
	
			return $query->row();
	
	}

}	

?>
