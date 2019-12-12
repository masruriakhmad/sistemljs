<?php
class Grafik extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_grafik');

		
	}

	function WO(){
		date_default_timezone_set('Asia/Jakarta');

  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_wobybulan($key);

		$x['tabel'] = 'Work Order';

		$this->load->view('Kesma/v_grafik',$x);
	}
	function kirimkain(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);
		
		$x['data']=$this->M_grafik->get_data_kirimkainbybulan($key);

		$x['tabel'] = 'Pengiriman Kain';

		$this->load->view('Kesma/v_grafik',$x);
	}
	function kirimgrey(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_kirimgreybybulan($key);

		$x['tabel'] = 'Pengiriman Grey';

		$this->load->view('Kesma/v_grafik',$x);
	}
	function terimagrey(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_terimagreybybulan($key);

		$x['tabel'] = 'Penerimaan Grey';

		$this->load->view('Kesma/v_grafik',$x);
	}
	function terimakain(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_terimakainbybulan($key);

		$x['tabel'] = 'Penerimaan Kain';

		$this->load->view('Kesma/v_grafik',$x);
	}

	function produksi(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_terimakainbybulan($key);

		$x['tabel'] = 'Produksi Grey';

		$this->load->view('Kesma/v_grafik',$x);
	}

	function jeniskain(){
		date_default_timezone_set('Asia/Jakarta');
		
  		$tgl  = date('Y-m-d H:i:s');

  		$tgla = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($tgl)));

  		$key = array(
    		'tgl <=' => $tgl,
    		'tgl >=' => $tgla);

		$x['data']=$this->M_grafik->get_data_jeniskainbybulan($key);

		$x['tabel'] = 'Pengiriman Kain <span class="fa-angle-right fa"></span> Jenis Kain';
		
		$this->load->view('Kesma/v_grafik',$x);
	}
}