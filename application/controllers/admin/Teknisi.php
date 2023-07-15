<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != true) {
			redirect('login');
		}

		$this->load->model('model_teknisi');
	}

	public function index()
	{
		$data['title']		= 'Data Teknisi';
		$data['subtitle']	= 'Data Teknisi';
		$data['content']	= 'backend/teknisi/index';
		$data['listData']	= $this->model_teknisi->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function getData()
	{
		$id_telegram 	= $this->input->post('id_telegram');
		$data			= $this->model_teknisi->get_where(['id_telegram' => $id_telegram])->row_array();

		echo json_encode($data);
	}

	public function edit()
	{
		$data = [
			'status' => $this->input->post('status')
		];

		$ubahData = $this->model_teknisi->update($this->input->post('id_telegram'), $data);

		if ($ubahData) {
			$id_telegram 	= $this->input->post('id_telegram');
			$data 			= $this->model_teknisi->get_where(['id_telegram' => $id_telegram])->row_array();

			$message_text 	= "Salam $data[nama_teknisi], kamu telah diapprove sebagai teknisi.. Selamat Bekerja :)";
			sendChat($id_telegram, $message_text);

			$response	= [
				'status' => 1
			];
		} else {
			$response	= [
				'status' => 2
			];
		}

		echo json_encode($response);
	}

	public function delete()
	{
		$id_telegram	= $this->input->post('id_telegram');;
		$query			= $this->model_teknisi->delete($id_telegram);

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
}
