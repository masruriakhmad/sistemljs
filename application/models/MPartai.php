<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPartai extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//fungsi untuk read benang
	function readPartai(){

			$this->db->select('*');

			$this->db->from('partai_tb');

			$this->db->join('subcon_tb',  'subcon_tb.kd_subcon 		= partai_tb.kd_subcon');

			$this->db->join('stock_kain', 'stock_kain.no_tr_grey 	= partai_tb.no_tr_grey');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 			= stock_kain.kd_kain');

			$this->db->join('status', 	  'status.status 	= partai_tb.status');

 			$query = $this->db->get();

 			return $query;

	}

	//fungsi untuk read partai yang berstatus T 
	function readPartaiByT(){

			$this->db->select('*, COUNT(partai_tb.no_tr_grey) AS jumlah_rol, SUM(stock_kain.kg_grey) AS jumlah_kg_grey');//, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(no_tr_grey) AS list_grey');

			$this->db->from('partai_tb');

			$this->db->join('stock_kain', 'stock_kain.no_tr_grey 	= partai_tb.no_tr_grey');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 			= stock_kain.kd_kain');

			$this->db->where('partai_tb.status','T');

			$this->db->where('partai_tb.kd_user',$this->session->userdata('kd_user'));

			$this->db->group_by('partai_tb.kd_partai');

 			$query = $this->db->get();

 			return $query;

	}

    //fungsi untuk read partai yang berstatus P untuk list penerimaan kainjadi 
	function readPartaiByP(){

			$this->db->select('partai_tb.no_partai,partai_tb.no_tr_grey,stock_kain.kd_kain,stock_kain.gramasi,grey_tb.nm_kain');//, COUNT(no_tr_grey) AS jumlah_rol, GROUP_CONCAT(no_tr_grey) AS list_grey');

			$this->db->from('partai_tb');

			$this->db->join('stock_kain', 'stock_kain.no_tr_grey 	= partai_tb.no_tr_grey');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 			= stock_kain.kd_kain');

			$this->db->where('partai_tb.status','P');

			$this->db->where('partai_tb.kd_user',$this->session->userdata('kd_user'));

			$this->db->group_by('partai_tb.no_partai');

 			$query = $this->db->get();

 			return $query;

	}

	function getListKdPartai(){


			$this->db->select('*');

			$this->db->from('partai_tb');

			$this->db->join('subcon_tb',  'subcon_tb.kd_subcon 		= partai_tb.kd_subcon');

			$this->db->join('stock_kain', 'stock_kain.no_tr_grey 	= partai_tb.no_tr_grey');

			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 			= stock_kain.kd_kain');

			$this->db->join('status', 	  'status.status 	= partai_tb.status');

			$this->db->group_by('partai_tb.kd_partai');

			$this->db->order_by('partai_tb.kd_partai','DESC');

 			$query = $this->db->get();

 			return $query;


	}
	
	//fungsi create partai
	function createPartai($data){

			$query = $this->db->insert('partai_tb',$data);

			return $query;

	}

	//fungsi update partai
	function updatePartai($kd_partai,$table,$data){

			$this->db->where('kd_partai', $kd_partai);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//fungsi update partai by key
	function updatePartaiByKey($key,$table,$data){

			$this->db->where($key);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//fungsi update partai
	function updatePartaiByTrGrey($no_tr_grey,$table,$data){

			$this->db->where('no_tr_grey', $no_tr_grey);

			$query = $this->db->update($table, $data);

			return $query;

	}
	
	//fungsi update partai by tr kainjadi
	function updatePartaiByTrKainjadi($no_tr_kainjadi,$table,$data){

			$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//fungsi update partai berdasar parameter tr maklun
	function updateStatusPartai($no_tr_maklun,$table,$data){

			$this->db->where('no_tr_maklun', $no_tr_maklun);

			$query = $this->db->update($table, $data);

			return $query;
	}

	
	//fungsi update partai berdasar parameter tr maklun
	function updatePartaiByNo_tr_grey($no_tr_grey,$table,$data){
	
			$this->db->where('no_tr_grey', $no_tr_grey);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//controller penerimaan_kainjadi/batalProses
	//fungsi update partai berdasar parameter tr maklun
	function updatePartaiByNo_tr_kainjadi($no_tr_kainjadi,$table,$data){
	
			$this->db->where('no_tr_kainjadi', $no_tr_kainjadi);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//controller pengiriman_kainjadi/batalProses
	//fungsi update partai berdasar parameter no jual
	function updatePartaiByNo_jual($no_jual,$table,$data){
	
			$this->db->where('no_jual', $no_jual);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//fungsi delete dengan parameter kd partai
	function deletePartai($kd_partai){
	
			$this->db->where('kd_partai', $kd_partai);
	
			$query = $this->db->delete('partai_tb');
	
			return $query;
	
	}

	//fungsi delete dengan parameter kd partai
	function deletePartaiByKey($key){
	
			$this->db->where($key);
	
			$query = $this->db->delete('partai_tb');
	
			return $query;
	
	}

	//fungsi delete dengan parameter no tr Maklun
	function deleteMaklun($no_tr_maklun){
	
			$this->db->where('no_tr_maklun', $no_tr_maklun);
	
			$query = $this->db->delete('partai_tb');
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by id
	function getByKd_partai($kd_partai){

			$this->db->select('*');
	
			$this->db->from('partai_tb');

			$this->db->join('warna_tb','warna_tb.kd_warna = partai_tb.kd_warna','left');

			$this->db->join('stock_kain','stock_kain.no_tr_grey = partai_tb.no_tr_grey','left');

			$this->db->join('grey_tb','grey_tb.kd_kain = stock_kain.kd_kain');

			$this->db->join('customer_tb','customer_tb.kd_customer = stock_kain.kd_customer');			
	
			$this->db->where('partai_tb.kd_partai', $kd_partai);
	
			$query = $this->db->get();
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by no partai
	function getByNo_partai($no_partai){

			$this->db->select('*');
	
			$this->db->from('partai_tb');

			$this->db->join('warna_tb','warna_tb.kd_warna = partai_tb.kd_warna');
	
			$this->db->where('no_partai', $no_partai);
	
			$query = $this->db->get();
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by tr Maklun
	function getByTrMaklun($no_tr_maklun){

			$this->db->select('* , COUNT(partai_tb.no_tr_grey) AS jml_rol, GROUP_CONCAT(partai_tb.no_tr_grey) AS list_grey,GROUP_CONCAT(stock_kain.kg_grey) AS list_kg_grey, SUM(stock_kain.kg_grey) AS subtotal_kg_grey');
	
			$this->db->from('partai_tb');
	
			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer','left');
	
			$this->db->where('partai_tb.no_tr_maklun', $no_tr_maklun);
	
			$this->db->group_by('partai_tb.kd_partai');
	
			$query = $this->db->get();
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by tr tr  kainjadi untuk penerimaan kain jadi
	function getByTrKainjadi($no_tr_kainjadi){

			$this->db->select('* , COUNT(partai_tb.no_tr_grey) AS jml_rol, GROUP_CONCAT(partai_tb.no_tr_grey) AS list_grey');
	
			$this->db->from('partai_tb');
	
			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer');
	
			$this->db->where('partai_tb.no_tr_kainjadi', $no_tr_kainjadi);
	
			$this->db->where('partai_tb.status', 'F');
	
			$this->db->group_by('partai_tb.kd_partai');
	
			$query = $this->db->get();
	
			return $query;
	
	}

	function getByStatus($status){

			$this->db->select('*');
	
			$this->db->from('partai_tb');

			$this->db->where('status',$status);

			$this->db->where('no_partai != ',NULL);

			$this->db->group_by('no_partai');

			$this->db->order_by('no_partai');
	
			$query = $this->db->get();
	
			return $query;

	}

	//fungsi untuk mendapatkan data by key
	function getByKey($key){

			$this->db->select('*');
	
			$this->db->from('partai_tb');
	
			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer');
	
			$this->db->join('warna_tb', 	  'warna_tb.kd_warna 			= stock_kain.kd_warna');
	
			$this->db->where($key);
	
			$query = $this->db->get();
	
			return $query->result();
	
	}

			//fungsi untuk mendapatkan data by key
	function getByKey1($key){

			$this->db->select('*');
	
			$this->db->from('partai_tb');
	
			$this->db->where($key);
	
			$query = $this->db->get();
	
			return $query->result();
	
	}

	//fungsi untuk mendapatkan data list no partai
	function getListNoPartai($key){

			$this->db->select('*,COUNT(partai_tb.no_tr_grey) AS jumlah_rol');
	
			$this->db->from('partai_tb');
	
			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('customer_tb', 	  'customer_tb.kd_customer 		= stock_kain.kd_customer');
	
			$this->db->join('warna_tb', 	  'warna_tb.kd_warna 			= stock_kain.kd_warna');
	
			$this->db->where($key);

			$this->db->group_by('partai_tb.no_partai');
	
			$query = $this->db->get();
	
			return $query->result();
	
	}

	//fungsi untuk mendapatkan data by key
	function getByKunci($key){

			$this->db->select('*');
	
			$this->db->from('partai_tb');
	
			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('warna_tb', 	  'warna_tb.kd_warna 			= stock_kain.kd_warna');
	
			$this->db->where($key);
	
			$query = $this->db->get();
	
			return $query;
	
	}

	//fungsi untuk mendapatkan data by id
	function getById($no_tr_grey){

			$this->db->select('*');
	
			$this->db->from('partai_tb');

			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
			$this->db->join('warna_tb', 	  'warna_tb.kd_warna 			= stock_kain.kd_warna');
	
			$this->db->where('partai_tb.no_tr_grey',$no_tr_grey);
	
			$query = $this->db->get();
	
			return $query->row();
	
	}


	//fungsi untuk filter partai by no tr maklun form penerimaan kainjadi
	function getPartaiByMaklun($no_tr_maklun){
	
			$this->db->select('*');
 	
 			$this->db->from('partai_tb');

 			//$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			//$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
		 	$this->db->where('status','M');
	
		 	$this->db->where('no_tr_maklun',$no_tr_maklun);
	
		 	$this->db->group_by('kd_partai');
 	
 			$query = $this->db->get()->result();
 	
 			return $query;
	
	}

	//fungsi untuk filter partai by no tr maklun form penerimaan kainjadi
	function getPartaiBySubcon($kd_subcon){
	
			$this->db->select('*');
 	
 			$this->db->from('partai_tb');

 			//$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');
	
			//$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
		 	$this->db->where('status','M');
	
		 	$this->db->where('kd_subcon',$kd_subcon);
	
		 	$this->db->group_by('kd_partai');
 	
 			$query = $this->db->get()->result();
 	
 			return $query;
	
	}

	//fungsi untuk filter no_tr_grey by kd_partai form penerimaan kainjadi
	function getNo_greyByPartai($kd_partai){
	
			$this->db->select('*');
 	
 			$this->db->from('partai_tb');

 			$this->db->join('stock_kain','stock_kain.no_tr_grey 			= partai_tb.no_tr_grey');

 			$this->db->join('grey_tb', 	  'grey_tb.kd_kain 					= stock_kain.kd_kain');
	
		 	$this->db->where('partai_tb.status','M');
	
		 	$this->db->where('partai_tb.kd_partai',$kd_partai);
 	
 			$query = $this->db->get()->result();
 	
 			return $query;
	
	}

    //fungsi untuk copy dari partai ke stock_kain pada penerimaan kainjadi
	function getNo_greyByKainjadi($no_tr_kainjadi){
	
			$this->db->select('*');
 	
 			$this->db->from('partai_tb');
	
		 	$this->db->where('status','P');
	
		 	$this->db->where('no_tr_kainjadi',$no_tr_kainjadi);
 	
 			$query = $this->db->get()->result();
 	
 			return $query;
	
	}



	//fungsi untuk mendapatkan nomor penerimaan
	function getKd_partai(){

		date_default_timezone_set('Asia/Jakarta');
    
        $q = $this->db->query("SELECT MAX(RIGHT(kd_partai,6)) AS kd_max FROM partai_tb WHERE SUBSTRING(kd_partai,4,2)=SUBSTRING(CURDATE(),3,2) AND LEFT(kd_partai,3)='PAR'");
    
        $kd = "";
    
        if($q->num_rows()>0){
    
            foreach($q->result() as $k){
    
                $tmp = ((int)$k->kd_max)+1;
    
                $kd = sprintf("%06s", $tmp);
    
            }
    
        }else{
    
            $kd = "000001";
    
        }
    
        $inisial="PAR";
    
        date_default_timezone_set('Asia/Jakarta');
    
        return $inisial.date('y').$kd;
    
     }

    //fungsi untuk list grey
	function list_grey($no_tr_maklun){
	
			$this->db->select('no_tr_grey');
	
			$this->db->from('partai_tb');
	
			$this->db->where('no_tr_maklun',$no_tr_maklun);
	
			$query = $this->db->get();
 	
 			return $query;
	
	}

}	

?>