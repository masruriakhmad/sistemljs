<?php
class M_grafik extends CI_Model{

	function get_data_wobybulan($key){
        $this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun, SUM(jml_rol) as jumlah');
         $this->db->FROM ('wo_tb'); 
         $this->db->where($key);
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }
    function get_data_kirimkainbybulan($key){
    	$this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun,count(*) as tr, SUM(jumlah) as jumlah');
         $this->db->FROM ('kirimkainjadi_tb');
         $this->db->where($key); 
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }
    function get_data_kirimgreybybulan($key){
    	$this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun, SUM(jumlah) as jumlah');
         $this->db->FROM ('kirimgrey_tb');
         $this->db->where($key); 
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }
    function get_data_terimagreybybulan($key){
    	$this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun, COUNT(*) as jumlah');
         $this->db->FROM ('terimagrey_tb');
         $this->db->where($key); 
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    } 

    function get_data_terimakainbybulan($key){
    	$this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun, SUM(jumlah) as jumlah');
         $this->db->FROM ('terimakainjadi_tb'); 
         $this->db->where($key);
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }

    function get_data_produksibybulan($key){
    	$this->db->SELECT('month(tgl) as ambil,year(tgl) as tahun, COUNT(*) as jumlah');
         $this->db->FROM ('produksi_tb');
         $this->db->where($key); 
         $this->db->GROUP_by ('month(tgl)','year(tgl)');
         $this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }

    function get_data_jeniskainbybulan($key){
    	$this->db->SELECT('nm_kain as ambil, count(*) as jumlah');
         $this->db->FROM ('stock_kain');
         $this->db->join('grey_tb', 'grey_tb.kd_kain = stock_kain.kd_kain');
         $this->db->join('kirimkainjadi_tb', 'kirimkainjadi_tb.no_jual = stock_kain.no_jual'); 
         $this->db->where('stock_kain.status', 'J');
         $this->db->where($key);
         $this->db->GROUP_by ('stock_kain.kd_kain');
         //$this->db->order_by ('tgl', 'ASC');
         $query = $this->db->get();
         
         if($query->num_rows() > 0){
             foreach($query->result() as $data){
                $hasil[] = $data;
             }
            return $hasil;
         }
    }

}