<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$data['title']		= 'Dashboard';
		$data['subtitle']	= 'Dashboard';
		$data['content']	= 'backend/dashboard/index';

		$this->load->view('backend/template', $data);
	}
}
