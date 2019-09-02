<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenerimaan_benang extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//untuk CRUD penerimaan benang
	function readPenerimaan_benang(){
			$this->db->select('*');
 			$this->db->from('penerimaan_benang_tb');

		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=penerimaan_benang_tb.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=penerimaan_benang_tb.kd_vendor');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_benang_tb.kd_gudang');
		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_benang_tb.kd_user');
		 	$this->db->where('status',1);
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
	function createPenerimaan_benang($data){
			$query = $this->db->insert('penerimaan_benang_tb',$data);
			return $query;
	}

	//fungsi untuk mendapatkan nomor penerimaan
	function get_no_tr_benang(){
		date_default_timezone_set('Asia/Jakarta');
		$date=date('Y-m-d');
        $q = $this->db->query("SELECT MAX(RIGHT(no_tr_benang,4)) AS kd_max FROM penerimaan_benang_tb WHERE DATE(tgl)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        $inisial="PRB";
        date_default_timezone_set('Asia/Jakarta');
        return $inisial.date('ymd').$kd;
     }

	//fungsi untuk batal penerimaan
	function batalPenerimaan_benang($no_tr_benang,$table,$data){
			$this->db->where('no_tr_benang', $no_tr_benang);
			$query = $this->db->update($table, $data);
			return $query;
	}
	
	//delete penerimaan benang
	function deletePenerimaan_benang($no_tr_benang,$table,$data){
			$this->db->where('no_tr_benang', $no_tr_benang);
			$query = $this->db->delete('penerimaan_benang_tb');
			return $query;
	}

	//fungsi untuk mendapatkan data by id
	function getById($no_tr_benang){
			$this->db->select('*');
			$this->db->from('stock_akhir_benang');
			$this->db->where('no_tr_benang', $no_tr_benang);
			$query = $this->db->get();
			return $query->row();
	}

	//fungsi untuk pencarian by keyword
	public function search($keyword){
    $this->db->like('no_tr_benang', $keyword);
    $this->db->or_like('tgl', $keyword);
    $this->db->or_like('kd_jenis', $keyword);
    $this->db->or_like('kd_vendor', $keyword);
    $this->db->or_like('kd_gudang', $keyword);

    $result = $this->db->get('penerimaan_benang_tb'); // Tampilkan data siswa berdasarkan keyword
    
    return $result; 
  }

  //untuk CRUD penerimaan benang
	function readPenerimaan_benangByTanggal(){
			$this->db->select('*');
 			$this->db->from('penerimaan_benang_tb');
		 	$this->db->join('benang_tb','benang_tb.kd_jenis		=penerimaan_benang_tb.kd_jenis');
		 	$this->db->join('vendor_tb','vendor_tb.kd_vendor	=penerimaan_benang_tb.kd_vendor');
		 	$this->db->join('gudang_tb','gudang_tb.kd_gudang	=penerimaan_benang_tb.kd_gudang');
		 	$this->db->join('user_tb','user_tb.kd_user			=penerimaan_benang_tb.kd_user');
		 	$this->db->where('status',1);
		 	$this->db->where('tgl >=',$tgl_awal);
		 	$this->db->where('tgl <=',$tgl_akhir);
 			$query = $this->db->get();
 			return $query;

	}
}	

?>
