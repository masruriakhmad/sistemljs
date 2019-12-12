<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenerimaan_jarum extends CI_Model{
	function __construct(){

		parent::__construct();

		$this->load->database();

	} 

	//gett all untuk fungsi laporan
	function getAll(){

			$this->db->select('*');

 			$this->db->from('penerimaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penerimaan_jarum.kd_jarum');

		 	//$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

//		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_jarum.kd_gudang');

		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_jarum.kd_user');

		 	//$this->db->where('status',1);

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//untuk laporan filter by tanggal
	function getByKey($key){

			$this->db->select('*');

 			$this->db->from('penerimaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penerimaan_jarum.kd_jarum');

		 	//$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

//		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_jarum.kd_gudang');

		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_jarum.kd_user');

		 	//$this->db->where('status',1);

		 	$this->db->where($key);

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//untuk CRUD penerimaan jarum
	function readPenerimaan_jarum(){

			$this->db->select('no_tr_jarum, tgl, nm_jarum, penerimaan_jarum.jumlah as jumlah, ket, nm_user');

 			$this->db->from('penerimaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum						=penerimaan_jarum.kd_jarum');

		 	//$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

//		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_jarum.kd_gudang');

		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_jarum.kd_user');

		 	//$this->db->where('status',1);

		 	$this->db->order_by('tgl', 'DESC');

 			$query = $this->db->get();

 			return $query;

	}

	//fungsi untuk create penerimaan
	function getDate(){

			date_default_timezone_set('Asia/Jakarta');

			return date('Y-m-d H:i:s');

	}

	//fungsi untuk create penerimaan
	function createPenerimaan_jarum($data){

			$query = $this->db->insert('penerimaan_jarum',$data);

			return $query;

	}

	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_tr_jarum(){

		date_default_timezone_set('Asia/Jakarta');

		$date=date('Y-m-d');

        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_jarum,4)) AS kd_max FROM penerimaan_jarum WHERE DATE(tgl)=CURDATE()");

        $kd = "";

        if($q->num_rows()>0){

            foreach($q->result() as $k){

                $tmp = ((int)$k->kd_max)+1;

                $kd = sprintf("%04s", $tmp);

            }

        }else{

            $kd = "0001";

        }

        $inisial="PRJ";

        date_default_timezone_set('Asia/Jakarta');

        return $inisial.date('ymd').$kd;

     }

	//fungsi untuk batal penerimaan
	function batalPenerimaan_jarum($no_tr_jarum,$table,$data){

			$this->db->where('no_tr_jarum', $no_tr_jarum);

			$query = $this->db->update($table, $data);

			return $query;

	}

	//get no jarum
	function getkd_jarum($no_tr_jarum){
		$this->db->select('kd_jarum, jumlah');

		$this->db->from('penerimaan_jarum');

		$this->db->where('no_tr_jarum', $no_tr_jarum);

		$query = $this->db->get();

		return $query->row();
	}
	
	//delete penerimaan benang
	function deletePenerimaan_jarum($no_tr_jarum,$table){

			$this->db->where('no_tr_jarum', $no_tr_jarum);

			$query = $this->db->delete('penerimaan_jarum');

			return $query;

	}

	//fungsi untuk mendapatkan data by id
	function getById($no_tr_jarum){

			$this->db->select('no_tr_jarum, tgl, nm_jarum, nm_vendorjarum, nm_user, penerimaan_jarum.jumlah as jumlah, ket');

			$this->db->from('penerimaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penerimaan_jarum.kd_jarum');

		 	$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_jarum.kd_user');

			$this->db->where('no_tr_jarum', $no_tr_jarum);

			$query = $this->db->get();

			return $query->row();

	}

	//fungsi untuk pencarian by keyword
	public function search($keyword){

    $this->db->like('no_tr_jarum', $keyword);

    $this->db->or_like('tgl', $keyword);

    $this->db->or_like('kd_jarum', $keyword);

    $this->db->or_like('kd_vendorjarum', $keyword);

//    $this->db->or_like('kd_gudang', $keyword);

    $result = $this->db->get('penerimaan_jarum'); // Tampilkan data siswa berdasarkan keyword
    
    return $result; 
  }

  //untuk CRUD penerimaan benang
	function readPenerimaan_jarumByTanggal(){

			$this->db->select('*');

 			$this->db->from('penerimaan_jarum');

		 	$this->db->join('jarum','jarum.kd_jarum		=penerimaan_jarum.kd_jarum');

		 	$this->db->join('vendor_jarum','vendor_jarum.kd_vendorjarum	=penerimaan_jarum.kd_vendorjarum');

		 	//$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_jarum.kd_gudang');

		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_jarum.kd_user');

//		 	$this->db->where('status',1);

		 	$this->db->where('tgl >=',$tgl_awal);

		 	$this->db->where('tgl <=',$tgl_akhir);

 			$query = $this->db->get();

 			return $query;

	}
}	

?>
