<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gangguan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_gangguan');
	}

	public function index()
	{
		$data['title']		= 'Daftar Laporan';
		$data['subtitle']	= 'Daftar Laporan Gangguan';
		$data['content']	= 'backend/gangguan/index';
		$data['listData']	= $this->model_gangguan->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function detail()
	{
		$data['title']		= 'Detail Laporan';
		$data['subtitle']	= 'Detail Laporan Gangguan';
		$data['content']	= 'backend/gangguan/detail';

		$this->load->view('backend/template', $data);
	}

	public function cetak()
	{
		$data['title']		= 'Cetak Laporan';
		$data['subtitle']	= 'Cetak Laporan Gangguan';
		$data['content']	= 'backend/gangguan/cetak';

		$this->load->view('backend/template', $data);
	}

	public function track()
	{
		$data['title']		= 'Track Laporan';
		$data['subtitle']	= 'Track Laporan Gangguan';
		$data['content']	= 'backend/gangguan/track';

		$this->load->view('backend/template', $data);
	}
}
