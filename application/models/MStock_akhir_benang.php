<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MStock_akhir_benang extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//menampilkan data dari stock akhir benang all 
	//controler stock akhir benang /stcok awal
	//bypass
	function getAll(){

			$this->db->select('*');

 			$this->db->from('stock_akhir_benang');
		 	
		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=	stock_akhir_benang.kd_jenis','left');
		 	
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=	stock_akhir_benang.kd_vendor','left');
		 	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=	stock_akhir_benang.kd_gudang','left');
 			
 			$query = $this->db->get();
 			
 			return $query;

	}

	//menampilkan data dari stock akhir benang
	function readStock_akhir_benang(){

			$this->db->select('*');

 			$this->db->from('stock_akhir_benang');
		 	
		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=	stock_akhir_benang.kd_jenis');
		 	
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=	stock_akhir_benang.kd_vendor');
		 	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=	stock_akhir_benang.kd_gudang');
 			
 			$query = $this->db->get();
 			
 			return $query;

	}

	//menampilkan data dari stock akhir benang berdasar kunci atau key
	function getByKey($key){

			$this->db->select('*');

 			$this->db->from('stock_akhir_benang');

		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=	stock_akhir_benang.kd_jenis');

		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=	stock_akhir_benang.kd_vendor');

		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=	stock_akhir_benang.kd_gudang');

		 	$this->db->like($key);

 			$query = $this->db->get();

 			return $query;

	}

		//fungsi create Stock benang
	function createStock($data){

			$query = $this->db->insert('stock_akhir_benang',$data);

			return $query;

	}

	//fungsi insert stock benang dari excel
	function insertStock_akhir_benang($data){

			$query = $this->db->insert('stock_akhir_benang',$data);

			return $query;

	}

	//fungsi update Stock
	function updateStock($kd_benang,$table,$data){

			$this->db->where('kd_benang', $kd_benang);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//menampilkan data dari stock akhir benang berdasar tanggal
	function cariByTanggal($tgl_awal,$tgl_akhir){

			$this->db->select('*');

 			$this->db->from('stock_akhir_benang');

		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=	stock_akhir_benang.kd_jenis');

		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=	stock_akhir_benang.kd_vendor');

		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=	stock_akhir_benang.kd_gudang');

		 	$this->db->where('tanggal >=',$tgl_awal);

			$this->db->where('tanggal <=',$tgl_akhir);

 			$query = $this->db->get();

 			return $query;

	}

	//fungsi get by id
	function getById($kd_benang){

			$this->db->select('*');

			$this->db->from('stock_akhir_benang');

			$this->db->where('kd_benang', $kd_benang);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mengambil nama colom
	//controller Stock akhir benang/import
	function getColoumnName(){

			$query = $this->db->list_fields('stock_akhir_benang');

			return $query;

	}

}	

?>
