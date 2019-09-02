<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProduksi extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//untuk CRUD produksi
	function readProduksi(){
			$this->db->select('*');
 			$this->db->from('produksi_tb');
 			$this->db->join('stock_akhir_benang','stock_akhir_benang.kd_benang	=	produksi_tb.kd_benang');
		 	$this->db->join('benang_tb','benang_tb.kd_jenis						=	stock_akhir_benang.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor					=	stock_akhir_benang.kd_vendor');
		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin						=	produksi_tb.kd_mesin');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang					=	produksi_tb.kd_gudang');
		 	$this->db->join('user_tb','user_tb.kd_user 			 				=	produksi_tb.kd_user');
		 	$this->db->where('status',1);
 			$query = $this->db->get();
 			return $query;
	}

	function getById($no_produksi){

			$this->db->select('*');
			$this->db->from('produksi_tb');
			$this->db->where('no_produksi', $no_produksi);
			//$this->db->join('mesin_tb','mesin_tb.kd_mesin						=	produksi_tb.kd_mesin');
			$query = $this->db->get();
			return $query->row();
		}

	//fungsi untuk mengcreate produksi
	function createProduksi($data){
			$query = $this->db->insert('produksi_tb',$data);
			return $query;
	}

	//update produksi
	function updateProduksi($no_produksi,$table,$data_update){
			$this->db->where('no_produksi', $no_produksi);
			$query = $this->db->update($table, $data_update);
			return $query;
	}


	 //fungsi untuk mengambil tanggal hari ini
     function getDate(){
     	date_default_timezone_set('Asia/Jakarta');
		return date('Y-m-d H:i:s');

     }
     
	//fungsi untuk mendapatkan nomor penerimaan
		function get_no_produksi(){
        $q = $this->db->query("SELECT MAX(RIGHT(no_produksi,4)) AS kd_max FROM produksi_tb WHERE DATE(tgl)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        $inisial="PRO";
        date_default_timezone_set('Asia/Jakarta');
        return $inisial.date('ymd').$kd;
     }

	//fungsi untuk batal produksi (indikasi batal produksi adalah status=2)
	function selesaiProduksi($no_produksi,$table,$data){
			$this->db->where('no_produksi', $no_produksi);
			$query = $this->db->update($table, $data);
			return $query;
	}













/*
	function deleteProsuksi($no_produksi,$table,$data){
			$this->db->where('no_produksi', $no_produksi);
			$query = $this->db->delete('produksi_tb');
			return $query;
	}*/

}	

?>