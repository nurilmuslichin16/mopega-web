<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{

	public function index()
	{
		$data['title']		= 'Data Teknisi';
		$data['subtitle']	= 'Data Teknisi';
		$data['content']	= 'backend/teknisi/index';

		$this->load->view('backend/template', $data);
	}
}
