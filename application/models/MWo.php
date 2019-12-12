<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MWo extends CI_Model{
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->database();
	
	}

	//fungsi untuk read wo
	function readWo(){
	
			$this->db->select('*, SUM(jml_rol) AS subtotal_rol');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('grey_tb','grey_tb.kd_kain =  wo_tb.kd_kain');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer'); 			
 	
 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('user_tb','user_tb.kd_user         	   =  wo_tb.kd_user');
 	
 			$this->db->join('status','status.id         		   =  wo_tb.status_wo');
 	
 			$this->db->where('status_wo !=',0);
 	
 			$this->db->group_by('no_wo');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//fungsi untuk read wo
	function getWo(){
	
			$this->db->select('*','CONCAT(kd_warna) AS kd');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');
 	
 			$this->db->where('status_wo !=','0');
 	
 			//$this->db->group_by('no_wo');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

		//fungsi untuk read wo
	function getListWo(){
	
			$this->db->select('*','CONCAT(kd_warna) AS kd');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');
 	
 			$this->db->where('status_wo !=','0');
 	
 			$this->db->group_by('no_wo');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//fungsi untuk read wo by customer
	//controler pengiriman kain jadi ajax lisWo
	function getWoByCustomer($kd_customer){
	
			$this->db->select('*');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');
 	
 			$this->db->where('status_wo !=','0');
 	
 			$this->db->where('wo_tb.kd_customer',$kd_customer);
 	
 			$this->db->group_by('no_wo');
 	
 			$query = $this->db->get();
 	
 			return $query;
	
	}

	//fungsi untuk read list order
	function readlistOrder(){

 			$kd_user=$this->session->userdata('kd_user');	
 	
 			$this->db->select('*');
 	
 			$this->db->from('wo_tb');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');
 	
 			$this->db->join('grey_tb','grey_tb.kd_kain =  wo_tb.kd_kain');
 	
 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');
 	
 			$this->db->where('status_wo','T');
 	
 			$this->db->where('kd_user',$kd_user);	
	
	 		$query = $this->db->get();
 	
 			return $query;
	
	}

	//fungsi untuk get list tahun
	function getListTahun(){

			$this->db->select('tgl');
			
			$this->db->from('wo_tb');
			
			$this->db->group_by('year(tgl)');

			$query = $this->db->get();
 	
 			return $query;

	}

	//fungsi untuk get list tahun
	function getSpk($key){

			$this->db->select('*, SUM(jml_rol) AS jumlah_rol');
			
			$this->db->from('wo_tb');
 	
 			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');
 	
 			$this->db->join('grey_tb','grey_tb.kd_kain =  wo_tb.kd_kain');
 	
 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');
			
			$this->db->where($key);

			$this->db->group_by('wo_tb.kd_kain');

			$query = $this->db->get();
 	
 			return $query;

	}
	
	//fungsi create benang
	function createWo($data){
	
			$query = $this->db->insert('wo_tb',$data);
	
			return $query;
	
	}

	function editWo($id,$table,$data){
	
			$this->db->where('id', $id);
	
			$query = $this->db->edit($table, $data);
	
			return $query;
	
	}

	//fungsi update benang
	function updateWo($id,$table,$data){
	
			$this->db->where('id', $id);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//fungsi update benang
	function updateWo1($no_wo,$table,$data){
	
			$this->db->where('no_wo', $no_wo);
	
			$query = $this->db->update($table, $data);
	
			return $query;
	
	}

	//fungsi delete wo
	function deleteWo($id){

			$this->db->where('id', $id);

			$query = $this->db->delete('wo_tb');

			return $query;

	}

	//fungsi delete lsit order
	function deleteList($key){

			$this->db->where($key);

			$query = $this->db->delete('wo_tb');

			return $query;

	}

	//fungsi delete wo
	function deleteWoByNo_wo($no_wo){

			$this->db->where('no_wo', $no_wo);

			$query = $this->db->delete('wo_tb');

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getById($id){

			$this->db->select('*');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

			$this->db->where('id', $id);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mendapatkan data by id
	function getByWo($no_wo){

			$this->db->select('*');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('user_tb', 'user_tb.kd_user            = wo_tb.kd_user');

			$this->db->where('no_wo', $no_wo);

			$query = $this->db->get();

			return $query;

	}

	//fungsi untuk mendapatkan data yang digunakan untuk status wo
	function getByNo_wo($no_wo){

			$this->db->select('*,SUM(jml_rol) AS jumlah_rol');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('user_tb', 'user_tb.kd_user            = wo_tb.kd_user');

 			$this->db->group_by('no_wo');

			$this->db->where('no_wo', $no_wo);

			$query = $this->db->get();

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getByWo1($no_wo){

			$this->db->select('*');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

			$this->db->where('no_wo', $no_wo);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk mendapatkan data by id
	function getByKey($key){
			
			$this->db->select('*, SUM(jml_rol) AS subtotal_rol');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('status','status.id         		   =  wo_tb.status_wo');

 			$this->db->where('status_wo !=',0);

 			$this->db->group_by('no_wo');

 			$this->db->where($key);	

			$query = $this->db->get();

			return $query;

	}

		//fungsi untuk mendapatkan data by id
	function getByKey1($key){
			
			$this->db->select('*, SUM(jml_rol) AS subtotal_rol');

			$this->db->from('wo_tb');

			$this->db->join('customer_tb','customer_tb.kd_customer =  wo_tb.kd_customer');

			$this->db->join('grey_tb','grey_tb.kd_kain			   =  wo_tb.kd_kain');

 			$this->db->join('benang_tb', 'benang_tb.kd_jenis       = grey_tb.kd_jenis');

 			$this->db->join('status','status.id         		   =  wo_tb.status_wo');

 			$this->db->where('status_wo !=',0);

 			$this->db->group_by('wo_tb.id');

 			$this->db->where($key);	

			$query = $this->db->get();

			return $query;

	}

	//fungsi untuk mendapatkan nomor wo
	function get_no_wo(){

		date_default_timezone_set('Asia/Jakarta');

		$date=date('Y-m-d');

        $q = $this->db->query("SELECT MAX(RIGHT(no_wo,6)) AS kd_max FROM wo_tb");

        $kd = "";

        if($q->num_rows()>0){

            foreach($q->result() as $k){

                $tmp = ((int)$k->kd_max)+1;

                $kd = sprintf("%06s", $tmp);

            }

        }else{

            $kd = "000001";

        }

        $inisial="WO";

        date_default_timezone_set('Asia/Jakarta');

        return $inisial.date('y').$kd;

     }


	function getDate(){

			date_default_timezone_set('Asia/Jakarta');

			return date('Y-m-d H:i:s');

	}

}	

?>