<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenggunaanjarum extends CI_Model{
	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	//gett all untuk fungsi laporan
	function getAll(){
 

		    $this->db->select('no_tr_pakaijarum, tgl, nm_jarum, size,  penggunaan_jarum.subjumlah as jumlah,no_mesin, ket, nm_user');

 			$this->db->from('penggunaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum						 =penggunaan_jarum.kd_jarum');

		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin	  			 =penggunaan_jarum.kd_mesin');

		 	$this->db->join('user_tb','user_tb.kd_user					 =penggunaan_jarum.kd_user');

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//untuk laporan filter by tanggal
	function getByKey($key){

			$this->db->select('*');

 			$this->db->from('penggunaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penggunaan_jarum.kd_jarum');

		 	$this->db->join('user_tb','user_tb.kd_user			=penggunaan_jarum.kd_user');

		 	$this->db->where($key);

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//untuk CRUD penggunaan jarum
	function readPenggunaan_jarum(){

			$this->db->select('id, no_tr_pakaijarum, tgl, nm_jarum, size,  penggunaan_jarum.subjumlah as jumlah,no_mesin, ket, nm_user');

 			$this->db->from('penggunaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum						 =penggunaan_jarum.kd_jarum');

		 	$this->db->join('mesin_tb','mesin_tb.kd_mesin	  			 =penggunaan_jarum.kd_mesin');

		 	$this->db->join('user_tb','user_tb.kd_user					 =penggunaan_jarum.kd_user');

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//fungsi untuk create penggunaan
	function getDate(){

			date_default_timezone_set('Asia/Jakarta');

			return date('Y-m-d H:i:s');

	}

	//fungsi untuk create penggunaan
	function createPenggunaan_jarum($data){

			$query = $this->db->insert('penggunaan_jarum',$data);

			return $query;

	}

	//fungsi untuk mendapatkan nomor penggunaan
	function get_no_tr_pakaijarum(){

		date_default_timezone_set('Asia/Jakarta');

		$date=date('Y-m-d');

        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_pakaijarum,4)) AS kd_max FROM penggunaan_jarum WHERE DATE(tgl)=CURDATE()");

        $kd = "";

        if($q->num_rows()>0){

            foreach($q->result() as $k){

                $tmp = ((int)$k->kd_max)+1;

                $kd = sprintf("%04s", $tmp);

            }

        }else{

            $kd = "0001";

        }

        $inisial="PGJ";

        date_default_timezone_set('Asia/Jakarta');

        return $inisial.date('ymd').$kd;

     }

	//fungsi untuk batal penggunaan
	function batalPenggunaanjarum($no_tr_pakaijarum,$table,$data){

			$this->db->where('no_tr_pakaijarum', $no_tr_pakaijarum);



			$query = $this->db->update($table, $data);

			return $query;

	}

	//get kd jarum by pakai
	function getkd_jarum($id){
		$this->db->select('kd_jarum , subjumlah');

		$this->db->from('Penggunaan_jarum');

		$this->db->where('id', $id);

		$query = $this->db->get();

		return $query->row();
	}

	
	//delete penggunaan jarum
	function deletePenggunaan_jarum($id,$table){

			$this->db->where('id', $id);

			//$this->db->where('kd_jarum', $jum);

			$query = $this->db->delete($table);

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getById($no_tr_pakaijarum){

			$this->db->select('*');

			$this->db->from('penggunaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penggunaan_jarum.kd_jarum');

		 	//$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

		 	$this->db->join('user_tb','user_tb.kd_user			=penggunaan_jarum.kd_user');

			$this->db->where('no_tr_pakaijarum', $no_tr_pakaijarum);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk pencarian by keyword
	public function search($keyword){

    $this->db->like('no_tr_pakaijarum', $keyword);

    $this->db->or_like('tgl', $keyword);

    $this->db->or_like('kd_jarum', $keyword);

    $this->db->or_like('nm_jarum', $keyword);

//    $this->db->or_like('kd_gudang', $keyword);

    $result = $this->db->get('penggunaan_jarum'); 
    return $result; 
  }

  //untuk CRUD penggunaan jarum
	function readPenggunaan_jarumByTanggal(){

			$this->db->select('*');

 			$this->db->from('penggunaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penggunaan_jarum.kd_jarum');

		 	//$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_jarum.kd_gudang');

		 	$this->db->join('user_tb','user_tb.kd_user			=penggunaan_jarum.kd_user');

//		 	$this->db->where('status',1);

		 	$this->db->where('tgl >=',$tgl_awal);

		 	$this->db->where('tgl <=',$tgl_akhir);

 			$query = $this->db->get();

 			return $query;

	}
}	

?>
