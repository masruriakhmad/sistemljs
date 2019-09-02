<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenerimaan_grey extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//untuk CRUD penerimaan benang
	function readPenerimaan_grey(){
			$this->db->select('*');
 			$this->db->from('terimagrey_tb');
		 	$this->db->join('grey_tb','grey_tb.kd_kain				=terimagrey_tb.kd_kain');
		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin			=terimagrey_tb.kd_mesin');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang		=terimagrey_tb.kd_gudang');
		 	$this->db->join('customer_tb','customer_tb.kd_customer	=terimagrey_tb.kd_customer');
		 	//$this->db->join('user_tb','user_tb.kd_user				=terimagrey_tb.kd_user');
		 	$this->db->where('status',1);
		 	//$this->db->order_by('no_tr_grey','DESC');
 			$query = $this->db->get();
 			return $query;

	}

	//untuk mengambil rekap penerimaan grey by Tanggal sekarang
	function getByTanggal($tanggal,$no_produksi){
			$this->db->select('*');
 			$this->db->from('terimagrey_tb');
		 	$this->db->join('grey_tb','grey_tb.kd_kain				=terimagrey_tb.kd_kain');
		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin			=terimagrey_tb.kd_mesin');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang		=terimagrey_tb.kd_gudang');
		 	$this->db->join('customer_tb','customer_tb.kd_customer	=terimagrey_tb.kd_customer');
		 	//$this->db->join('user_tb','user_tb.kd_user				=terimagrey_tb.kd_user');
		 	$this->db->where('status',1);
		 	$this->db->like('tgl',$tanggal);
		 	$this->db->like('no_produksi',$no_produksi);

		 	//$this->db->order_by('no_tr_grey','DESC');
 			$query = $this->db->get();
 			return $query;

	}


	//fungsi untuk create penerimaan
	function getDate(){
			date_default_timezone_set('Asia/Jakarta');
			return date('Y-m-d H:i:s');
	}

		//fungsi untuk create penerimaan
	function getDateOnly(){
			date_default_timezone_set('Asia/Jakarta');
			return date('Y-m-d');
	}


	//fungsi untuk create penerimaan
	function createPenerimaan_grey($data){
			$query = $this->db->insert('terimagrey_tb',$data);
			return $query;
	}

	//fungsi untuk mendapatkan nomor penerimaan
		function get_no_tr_grey(){
        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_grey,6)) AS kd_max FROM terimagrey_tb ");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $inisial="PRG";
        date_default_timezone_set('Asia/Jakarta');
        return $inisial.date('y').$kd;
     }

     
     //fungsi untuk mendapatkan nomor gulung
		function get_no_gulung($kd_mesin){
        $q = $this->db->query("SELECT MAX(RIGHT(no_gulung,4)) AS kd_max FROM terimagrey_tb WHERE kd_mesin='$kd_mesin'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
       
        return $kd;
     }
    

	//fungsi untuk batal penerimaan
	function batalPenerimaan_grey($no_tr_grey,$table,$data){
			$this->db->where('no_tr_grey', $no_tr_grey);
			$query = $this->db->update($table, $data);
			return $query;
	}
	
	
	function deletePenerimaan_grey($no_tr_grey,$table,$data){
			$this->db->where('no_tr_grey', $no_tr_grey);
			$query = $this->db->delete('terimagrey_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($no_tr_grey){

			$this->db->select('*');
			$this->db->from('terimagrey_tb');
			$this->db->where('no_tr_grey', $no_tr_grey);
			$query = $this->db->get();
			return $query->row();
	}

}	

?>
