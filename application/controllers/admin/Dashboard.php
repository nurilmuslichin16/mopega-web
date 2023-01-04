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
	}

	public function index()
	{
		$data['title']		= 'Dashboard';
		$data['subtitle']	= 'Dashboard';
		$data['content']	= 'backend/dashboard/index';

		$this->load->view('backend/template', $data);
	}
}
