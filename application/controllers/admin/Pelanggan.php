<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != true) {
			redirect('login');
		}

		$this->load->model('model_pelanggan');
	}

	public function index()
	{
		$data['title']		= 'Data Pelanggan';
		$data['subtitle']	= 'Data Pelanggan';
		$data['content']	= 'backend/pelanggan/index';
		$data['listData']	= $this->model_pelanggan->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('internet', 'Internet', 'required|is_unique[tb_pelanggan.no_internet]', ['is_unique' => 'Internet sudah ada!']);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|is_unique[tb_pelanggan.no_voice]', ['is_unique' => 'Voice sudah ada!']);
		$this->form_validation->set_rules('odp', 'ODP', 'required');
		$this->form_validation->set_rules('port', 'Port', 'required');
		$this->form_validation->set_rules('sn', 'SN', 'required');

		if ($this->form_validation->run() == false) {
			$response	= [
				'status' 	=> 1,
				'error'		=> [
					'nama_pelanggan'    => form_error('nama_pelanggan', ' ', ' '),
					'tipe'              => form_error('tipe', ' ', ' '),
					'email'             => form_error('email', ' ', ' '),
					'no_hp'             => form_error('no_hp', ' ', ' '),
					'alamat'            => form_error('alamat', ' ', ' '),
					'internet'          => form_error('internet', ' ', ' '),
					'telepon'           => form_error('telepon', ' ', ' '),
					'odp'               => form_error('odp', ' ', ' '),
					'port'              => form_error('port', ' ', ' '),
					'sn'                => form_error('sn', ' ', ' ')
				]
			];

			echo json_encode($response);
		} else {
			$data = [
				'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
				'tipe'          	=> $this->input->post('tipe'),
				'email'   	    	=> $this->input->post('email'),
				'no_hp'      		=> $this->input->post('no_hp'),
				'alamat'     		=> $this->input->post('alamat'),
				'no_internet'      	=> $this->input->post('internet'),
				'no_voice'       	=> $this->input->post('telepon'),
				'odp'   	    	=> $this->input->post('odp'),
				'port' 				=> $this->input->post('port'),
				'sn_ont'      	    => $this->input->post('sn')
			];

			$addData = $this->model_pelanggan->insert($data);

			if ($addData) {
				$response	= [
					'status' => 2
				];

				echo json_encode($response);
			} else {
				$response	= [
					'status' => 3
				];

				echo json_encode($response);
			}
		}
	}

	public function getData()
	{
		$id_pelanggan 	= $this->input->post('id_pelanggan');
		$data			= $this->model_pelanggan->get_where(['id_pelanggan' => $id_pelanggan])->row_array();

		echo json_encode($data);
	}

	public function edit()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('internet', 'Internet', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required');
		$this->form_validation->set_rules('odp', 'ODP', 'required');
		$this->form_validation->set_rules('port', 'Port', 'required');
		$this->form_validation->set_rules('sn', 'SN', 'required');

		if ($this->form_validation->run() == false) {
			$response	= [
				'status' 	=> 1,
				'error'		=> [
					'nama_pelanggan'    => form_error('nama_pelanggan', ' ', ' '),
					'tipe'              => form_error('tipe', ' ', ' '),
					'email'             => form_error('email', ' ', ' '),
					'no_hp'             => form_error('no_hp', ' ', ' '),
					'alamat'            => form_error('alamat', ' ', ' '),
					'internet'          => form_error('internet', ' ', ' '),
					'telepon'           => form_error('telepon', ' ', ' '),
					'odp'               => form_error('odp', ' ', ' '),
					'port'              => form_error('port', ' ', ' '),
					'sn'                => form_error('sn', ' ', ' ')
				]
			];

			echo json_encode($response);
		} else {
			$data = [
				'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
				'tipe'          	=> $this->input->post('tipe'),
				'email'   	    	=> $this->input->post('email'),
				'no_hp'      		=> $this->input->post('no_hp'),
				'alamat'     		=> $this->input->post('alamat'),
				'no_internet'      	=> $this->input->post('internet'),
				'no_voice'       	=> $this->input->post('telepon'),
				'odp'   	    	=> $this->input->post('odp'),
				'port' 				=> $this->input->post('port'),
				'sn_ont'      	    => $this->input->post('sn')
			];

			$ubahData = $this->model_pelanggan->update($this->input->post('id_pelanggan'), $data);

			if ($ubahData) {
				$response	= [
					'status' => 2
				];

				echo json_encode($response);
			} else {
				$response	= [
					'status' => 3
				];

				echo json_encode($response);
			}
		}
	}

	public function detail($id_pelanggan)
	{
		$data['title']		= 'Detail Data Pelanggan';
		$data['subtitle']	= 'Detail Data Pelanggan';
		$data['content']	= 'backend/pelanggan/detail';
		$data['data']		= $this->model_pelanggan->get_where(['id_pelanggan' => $id_pelanggan])->row_array();

		$this->load->view('backend/template', $data);
	}

	public function delete()
	{
		$id_pelanggan	= $this->input->post('id_pelanggan');;
		$query			= $this->model_pelanggan->delete($id_pelanggan);

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
