<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != true) {
			redirect('login');
		}

		$this->load->model('model_gangguan');
	}

	public function index()
	{
		$data['title']		= 'Dashboard';
		$data['subtitle']	= 'Dashboard';
		$data['content']	= 'backend/dashboard/index';
		$data['data']		= $this->model_gangguan->dashboard()->row_array();

		$this->load->view('backend/template', $data);
	}
}
