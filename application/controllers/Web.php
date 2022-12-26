<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{
	public function index()
	{
		$data['content']	= 'frontend/home';

		$this->load->view('frontend/template', $data);
	}

	public function lapor()
	{
		$data['content']	= 'frontend/lapor';

		$this->load->view('frontend/template', $data);
	}

	public function track()
	{
		$data['content']	= 'frontend/track';

		$this->load->view('frontend/template', $data);
	}

	public function trackresult()
	{
		$data['content']	= 'frontend/trackresult';

		$this->load->view('frontend/template', $data);
	}

	public function ceknomor()
	{
		$data['content']	= 'frontend/ceknomor';

		$this->load->view('frontend/template', $data);
	}

	public function ceknomorresult()
	{
		$data['content']	= 'frontend/ceknomorresult';

		$this->load->view('frontend/template', $data);
	}
}
