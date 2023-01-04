<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gangguan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_gangguan');
		$this->load->model('model_teknisi');
	}

	public function index()
	{
		$data['title']			= 'Daftar Laporan';
		$data['subtitle']		= 'Daftar Laporan Gangguan';
		$data['content']		= 'backend/gangguan/index';
		$data['listData']		= $this->model_gangguan->get_all()->result_array();
		$data['listTeknisi']	= $this->model_teknisi->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function getData()
	{
		$id_gangguan 	= $this->input->post('id_gangguan');
		$data			= $this->model_gangguan->get_where(['id_gangguan' => $id_gangguan])->row_array();

		echo json_encode($data);
	}

	public function detail($id_gangguan)
	{
		$data['title']		= 'Detail Laporan';
		$data['subtitle']	= 'Detail Laporan Gangguan';
		$data['content']	= 'backend/gangguan/detail';
		$data['data']		= $this->model_gangguan->get_where(['id_gangguan' => $id_gangguan])->row_array();

		$this->load->view('backend/template', $data);
	}

	public function delete()
	{
		$id_gangguan	= $this->input->post('id_gangguan');;
		$query			= $this->model_gangguan->delete($id_gangguan);

		if ($query) {
			$response		= [
				'status' 	=> true
			];
		} else {
			$response		= [
				'status' 	=> false
			];
		}

		echo json_encode($response);
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
		$data['track']		= false;

		if ($this->input->post('submit')) {
			$data['track']	= true;
			$tiket			= $this->input->post('tiket');
			$data['result']	= $this->model_gangguan->log($tiket)->result_array();
		}

		$this->load->view('backend/template', $data);
	}
}
