<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MStock_kain extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//menampilkan data dari stock akhir grey
	function readStock_kain(){
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->group_by('nm_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock akhir grey
	function getKainGramasi(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->group_by('nm_kain');
		 	$this->db->group_by('gramasi');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock akhir grey
	function getAllGrey(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','G');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data all grey
	function getAllMaklun(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','M');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data all kain jadi
	function getAllKainjadi(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','F');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock terjual
	function getAllJual(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','J');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock berdasar kunci tertentu
	function getByKey($key){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna');
		 	$this->db->where($key);
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock akhir grey
	function getGramasi(){
			$this->db->select('DISTINCT(gramasi)');
 			$this->db->from('stock_kain');
		 	$this->db->where('status','G');
 			$query = $this->db->get();
 			return $query;
	}

	//fungsi untuk get by id
	function getById($no_tr_grey){

         $this->db->select('*');
         $this->db->from('stock_kain');
         $this->db->where('no_tr_grey', $no_tr_grey);
         $query = $this->db->get();
         return $query->row();
      }

     //fungsi untuk get by key status (grey,maklun,finis,jual)
	function getByStatus($status){

         $this->db->select('*');
         $this->db->from('stock_kain');
         $this->db->where('status', $status);
         $query = $this->db->get();
         return $query;
      }

    //menampilkan data dari stock akhir grey
	function getKain(){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->where('status','G');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock grey
	function getStockGrey(){
			$this->db->select('* ,COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','G');
		 	$this->db->group_by('nm_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock maklun
	function getStockmaklun(){
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon		    =	stock_kain.kd_subcon');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','M');
		 	$this->db->group_by('nm_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data dari stock grey
	function getStockKainjadi(){
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon		    =	stock_kain.kd_subcon');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','F');
		 	$this->db->group_by('nm_kain');
 			$query = $this->db->get();
 			return $query;
	}

	function getTrByKey($key){

		$this->db->select('*');
		$this->db->from('stock_kain');
		//$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		$this->db->where($key);
		$this->db->where('status','G');
		$query= $this->db->get();
		return $query->result();

	}

	//getALL by Key untuk tampilan WO dan laporan pengiriman grey pdf
	function getAllByKey($key){
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, SUM(kg_grey) AS jumlah_kg, GROUP_CONCAT(no_tr_grey) AS list_grey, GROUP_CONCAT(kg_grey) AS list_kg');
 			$this->db->from('stock_kain');
 			$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->group_by('stock_kain.kd_partai');
		 	$this->db->where($key);
 			$query = $this->db->get();
 			return $query;
	}

    //untuk menampilkan barang yang sedang di proses dari tampilan wo
    //menampilkan data grey by no wo
	function getGreyByWo($no_wo){
			$this->db->select('*, COUNT(no_tr_grey) AS jml');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','G');
		 	$this->db->where('no_wo',$no_wo);
		 	$this->db->group_by('stock_kain.kd_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data grey by no wo
	function getMaklunByWo($no_wo){
			$this->db->select('*, COUNT(no_tr_grey) AS jml');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','M');
		 	$this->db->where('no_wo',$no_wo);
		 	$this->db->group_by('stock_kain.kd_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//menampilkan data grey by no wo
	function getKainjadiByWo($no_wo){
			$this->db->select('*, COUNT(no_tr_grey) AS jml');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
		 	$this->db->where('status','F');
		 	$this->db->where('no_wo',$no_wo);
		 	$this->db->group_by('stock_kain.kd_kain');
 			$query = $this->db->get();
 			return $query;
	}

	//fungsi untuk filter kain by partai form penerimaan kainjadi
	function getKainByPartai($kd_partai){
			$this->db->select('*');
 			$this->db->from('stock_kain');
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
		 	$this->db->where('status','M');
		 	$this->db->where('kd_partai',$kd_partai);
		 	$this->db->group_by('stock_kain.kd_kain');
 			$query = $this->db->get()->result();
 			return $query;
	}

	//controler penerimaan_kainjadi/detailPenerimaanKainjadi
	//fungsi untuk mendapatkan data by tr tr  kainjadi untuk penerimaan kain jadi untuk detail penerimaan kainjadi
	function getByTrKainjadi($no_tr_kainjadi){

			$this->db->select('* , COUNT(stock_kain.no_tr_grey) AS jml_rol, GROUP_CONCAT(stock_kain.no_tr_grey) AS list_grey');
			$this->db->from('stock_kain');
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer');
			$this->db->where('stock_kain.no_tr_kainjadi', $no_tr_kainjadi);
			$this->db->where('stock_kain.status', 'F');
			$this->db->group_by('stock_kain.kd_partai');
			$query = $this->db->get();
			return $query;
	}



     //fungsi untuk create stock kain
	function createStock_kain($data){
			$query = $this->db->insert('stock_kain',$data);
			return $query;
	}
	//fungsi untuk update stock kain by no_tr_grey
	function updateStock_kain($no_tr_grey,$table,$data){
			$this->db->where('no_tr_grey', $no_tr_grey);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi untuk update stock kain by no_tr_maklun
	function updateStock_kainByNo_tr_maklun($no_tr_maklun,$table,$data){
			$this->db->where('no_tr_maklun', $no_tr_maklun);
			$query = $this->db->update($table, $data);
			return $query;
	}

	//fungsi untuk update stock kain by no_tr_kainjadi
	function updateStock_kainByNo_tr_kainjadi($no_tr_kainjadi,$table,$data){
			$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);
			$query = $this->db->update($table, $data);
			return $query;
	}
	
	//fungsi untuk delete stock kain
	function deleteStock_kain($no_tr_grey){
			$this->db->where('no_tr_grey', $no_tr_grey);
			$query = $this->db->delete('stock_kain');
			return $query;
	}

}	

?>
