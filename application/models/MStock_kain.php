<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MStock_kain extends CI_Model{
	function __construct(){
	
		parent::__construct();
	
		$this->load->database();
	
	}

	//get All
	function getAll(){
	
			$this->db->select('*');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');

		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin       		=	stock_kain.kd_mesin','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon			=	stock_kain.kd_subcon','left');

		    $this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where('stock_kain.status !=','0');

		 	$this->db->order_by('no_tr_grey','ASC');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//get detail Stock By key
	function getDetailStock($key){
	
			$this->db->select('*');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon			=	stock_kain.kd_subcon','left');

		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where($key);

		 	$this->db->where('stock_kain.status !=','0');

		 	$this->db->order_by('no_tr_grey','ASC');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//get detail Stock By key
	function getDetailStockMaklunPerKain($key){
	
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, SUM(kg_grey) AS jumlah_kg_grey, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon			=	stock_kain.kd_subcon','left');

		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where($key);

		 	$this->db->where('stock_kain.status !=','0');

		 	$this->db->group_by('stock_kain.kd_kain');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

		//get detail Stock By key
	function getDetailStockMaklunPerPartai($key){
	
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, SUM(kg_grey) AS jumlah_kg_grey, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon			=	stock_kain.kd_subcon','left');

		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where($key);

		 	$this->db->where('stock_kain.status !=','0');

		 	$this->db->group_by('stock_kain.kd_partai');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

		//get detail Stock By key
	function getDetailStockKainjadi($key){
	
			$this->db->select('*,COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi, SUM(kg_grey) AS jumlah_kg_grey, SUM(kg_fin) AS jumlah_kg_fin');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon			=	stock_kain.kd_subcon','left');

		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where($key);

		 	$this->db->where('stock_kain.status !=','0');

		 	$this->db->group_by('no_partai');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//menampilkan data dari stock akhir grey
	function readStock_kain(){
	
			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->where('stock_kain.status !=','0');
	
		 	$this->db->group_by('kd_kain');
 	
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

		 	$this->db->where('stock_kain.status !=','0');
 	
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

	//fungsi untuk get by No wo untuk status WO 
	function getByNo_wo($no_wo){

			$this->db->select('*,COUNT(no_tr_grey) AS jumlah_rol');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');
	
		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna');

			$this->db->group_by('no_wo');	 	
	
		 	$this->db->where('no_wo',$no_wo);

		 	$this->db->where('stock_kain.status !=','0');
 	
 			$query = $this->db->get();
 	
 			return $query;

	}

	//menampilkan data dari stock berdasar kunci tertentu
	function getByKey($key){
	
			$this->db->select('*');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');
	
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

         $this->db->join('warna_tb', 'warna_tb.kd_warna = stock_kain.kd_warna');

         $this->db->join('grey_tb', 'grey_tb.kd_kain = stock_kain.kd_kain');

         $this->db->join('customer_tb', 'customer_tb.kd_customer = stock_kain.kd_customer');
    
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

			$this->db->select('* ,SUM(kg_grey) AS jumlah_kg_grey,COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi');

 			$this->db->from('stock_kain');

		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');

		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->where('status','G');

		 	$this->db->group_by('stock_kain.kd_kain');

 			$query = $this->db->get();

 			return $query;

	}

	//menampilkan data dari stock maklun
	function getStockmaklun(){

			$this->db->select('*, SUM(kg_grey) AS jumlah_kg_grey,COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi, GROUP_CONCAT(DISTINCT(nm_kain)) AS list_kain');

 			$this->db->from('stock_kain');

		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon		    =	stock_kain.kd_subcon');

		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->where('status','M');

		 	$this->db->group_by('stock_kain.kd_subcon');

 			$query = $this->db->get();

 			return $query;

	}

	//menampilkan data dari stock grey
	function getStockKainjadi(){

			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(DISTINCT(gramasi)) AS list_gramasi, SUM(kg_grey) AS jumlah_kg_grey, SUM(kg_fin) AS jumlah_kg_fin');

 			$this->db->from('stock_kain');

		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');

		 	$this->db->join('subcon_tb','subcon_tb.kd_subcon		    =	stock_kain.kd_subcon','left');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');
	
		 	$this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where('status','F');

		 	$this->db->group_by('stock_kain.kd_kain');

 			$query = $this->db->get();

 			return $query;

	}

	function getTrByKey($key){


		$this->db->select('*');

		$this->db->from('stock_kain');

		$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');

		$this->db->where($key);

		$this->db->where('status','G');

		$query= $this->db->get();

		return $query->result();

	}

	//getALL by Key untuk tampilan WO dan laporan pengiriman grey pdf
	function getAllByKey($key){

			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, SUM(kg_fin) AS jumlah_kg ,SUM(kg_grey) AS jumlah_kg_grey, GROUP_CONCAT(no_tr_grey) AS list_grey, GROUP_CONCAT(

				kg_fin) AS list_kg, GROUP_CONCAT(kg_grey) AS list_kg_grey');

 			$this->db->from('stock_kain');

 			$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	
		 	$this->db->join('warna_tb','warna_tb.kd_warna       		=	stock_kain.kd_warna','left');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->group_by('stock_kain.no_partai');

		 	$this->db->where($key);

 			$query = $this->db->get();

 			return $query;

	}

		//getALL by Key untuk tampilan WO dan laporan pengiriman grey pdf
	function getAllByKey1($key){

			$this->db->select('*, COUNT(no_tr_grey) AS jumlah_rol, SUM(kg_fin) AS jumlah_kg ,SUM(kg_grey) AS jumlah_kg_grey, GROUP_CONCAT(no_tr_grey) AS list_grey, GROUP_CONCAT(

				kg_fin) AS list_kg, GROUP_CONCAT(kg_grey) AS list_kg_grey');

 			$this->db->from('stock_kain');

 			$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');
		 	
		 	$this->db->join('warna_tb','warna_tb.kd_warna       		=	stock_kain.kd_warna','left');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->group_by('stock_kain.kd_partai');

		 	$this->db->where($key);

 			$query = $this->db->get();

 			return $query;

	}

    //untuk menampilkan barang yang sedang di proses dari tampilan wo
    //menampilkan data grey by no wo
	function getGreyByWo($no_wo){

			$this->db->select('*, COUNT(no_tr_grey) AS jml, SUM(kg_grey) AS jml_kg_grey');

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

			$this->db->select('*, COUNT(no_tr_grey) AS jml, SUM(kg_fin) AS jml_kg_fin');

 			$this->db->from('stock_kain');

		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');

		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->join('warna_tb','warna_tb.kd_warna			=	stock_kain.kd_warna');

		 	$this->db->where('status','F');

		 	$this->db->where('no_wo',$no_wo);

		 	$this->db->group_by('stock_kain.kd_kain');

 			$query = $this->db->get();

 			return $query;

	}

	//get kainjadi by no wo dan kd kain
	//controler pengiriman kain jadi/listTrGrey
	function getKainjadiByKey($key){

			$this->db->select('*');

 			$this->db->from('stock_kain');

 			$this->db->join('partai_tb','partai_tb.no_tr_grey			=	stock_kain.no_tr_grey');

		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain');

		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang');

		 	$this->db->join('warna_tb','warna_tb.kd_warna	    		=	stock_kain.kd_warna');

		 	$this->db->where('.stock_kain.status','F');

		 	$this->db->where($key);

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

			$this->db->select('* , COUNT(stock_kain.no_tr_grey) AS jumlah_rol, GROUP_CONCAT(stock_kain.no_tr_grey) AS list_grey, 

				GROUP_CONCAT(stock_kain.kg_fin) AS list_kg, SUM(stock_kain.kg_fin) AS subtotal_kg ,SUM(kg_fin) AS jumlah_kg');

			$this->db->from('stock_kain');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain','left');

			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer','left');

			$this->db->join('warna_tb', 	  'warna_tb.kd_warna     		= stock_kain.kd_warna','left');

			$this->db->where('stock_kain.no_tr_kainjadi', $no_tr_kainjadi);

			$this->db->where('stock_kain.status !=','0');

			$this->db->group_by('stock_kain.no_partai');

			$query = $this->db->get();

			return $query;

	}

	function getByNo_partai($no_partai){

			$this->db->select('*');

			$this->db->from('stock_kain');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');

			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer');

			$this->db->join('warna_tb', 	  'warna_tb.kd_warna 		    = stock_kain.kd_warna');

			$this->db->where('stock_kain.status !=','0');

			$this->db->where('stock_kain.no_partai', $no_partai);

			$query = $this->db->get();

			return $query;

	}

	//untuk tampil penerimaan
	function getByP(){

			$this->db->select('*');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');

		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin       		=	stock_kain.kd_mesin','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		    $this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->group_by('stock_kain.no_partai');

		 	$this->db->where('status','P');
 	
 			$query = $this->db->get();
 	
 			return $query;

	}

	//untuk create penerimaan
	function getByStatusP(){

			$this->db->select('*');
 	
 			$this->db->from('stock_kain');
	
		 	$this->db->join('grey_tb','grey_tb.kd_kain					=	stock_kain.kd_kain','left');

		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin       		=	stock_kain.kd_mesin','left');
	
		 	$this->db->join('customer_tb','customer_tb.kd_customer		=	stock_kain.kd_customer','left');
	
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang			=	stock_kain.kd_gudang','left');

		    $this->db->join('warna_tb','warna_tb.kd_warna			    =	stock_kain.kd_warna','left');

		 	$this->db->where('status','P');
 	
 			$query = $this->db->get();
 	
 			return $query;

	}

	 //fungsi untuk mengambil nama colom
	//controller vendors/import
	function getColoumnName(){

			$query = $this->db->list_fields('stock_kain');

			return $query;

	}

			//fungsi create customer dari excel
	function insertStock_kain($data){

			$query = $this->db->insert_batch('stock_kain',$data);

			return $query;

	}

     //fungsi untuk create stock kain
	function createStock_kain($data){

			$query = $this->db->insert('stock_kain',$data);

			return $query;

	}

	//fungsi untuk update stock kain by wo
	function updateStock_kainByWo($no_wo,$table,$data){

			$this->db->where('no_wo', $no_wo);

			$query = $this->db->update($table, $data);

			return $query;

	}
	//fungsi untuk update stock by key
	function updateStock_kainByKey($key,$table,$data){

			$this->db->where($key);

			$query = $this->db->update($table, $data);

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

	//fungsi untuk update stock kain by no_jual
	function updateStock_kainByNo_jual($no_jual,$table,$data){

			$this->db->where('no_jual', $no_jual);

			$query = $this->db->update($table, $data);

			return $query;

	}

		//fungsi untuk update stock kain by kd_partai
	function updateStock_kainByKd_partai($kd_partai,$table,$data){

			$this->db->where('kd_partai', $kd_partai);

			$query = $this->db->update($table, $data);

			return $query;

	}
	
	//fungsi untuk delete stock kain
	function deleteStock_kain($no_tr_grey){

			$this->db->where('no_tr_grey', $no_tr_grey);

			$query = $this->db->delete('stock_kain');

			return $query;

	}
	//untuk delete berdasar kunci
	function deleteStock_kainByKey($key){

			$this->db->where($key);

			$query = $this->db->delete('stock_kain');

			return $query;

	}


	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_tr_grey(){

        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_grey,6)) AS kd_max FROM stock_kain WHERE SUBSTRING(no_tr_grey,4,2)=SUBSTRING(CURDATE(),3,2) ");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd  = sprintf("%06s", $tmp);
    
            }
    
        }else{
    
            $kd = "000001";
    
        }
    
        $inisial="PRG";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('y').$kd;
    
     }

     //fungsi untuk mendapatkan nomor penerimaan grey khusus untuk bypass penerimaan kainjadi
	function get_no_tr_greyNew(){

        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_grey,6)) AS kd_max FROM stock_kain WHERE SUBSTRING(no_tr_grey,4,2)='15' ");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd  = sprintf("%06s", $tmp);
    
            }
    
        }else{
    
            $kd = "000001";
    
        }
    
        $inisial="PRG";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.'15'.$kd;
    
     }

    //fungsi untuk mendapatkan nomor SKU 
	function getSku($kd_mesin,$no_mesin){

        $q = $this->db->query("SELECT MAX(RIGHT(sku,5)) AS kd_max FROM stock_kain WHERE kd_mesin = '$kd_mesin' AND SUBSTRING(no_tr_grey,4,2)=SUBSTRING(CURDATE(),3,2)");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd  = sprintf("%05s", $tmp);
    
            }
    
        }else{
    
            $kd = "00001";
    
        }
    
        $inisial="$no_mesin";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial."-".date('y').$kd;
    
     }


}	

?>
