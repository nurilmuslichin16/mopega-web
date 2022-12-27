<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

	public function index()
	{
		$data['title']		= 'Data Pelanggan';
		$data['subtitle']	= 'Data Pelanggan';
		$data['content']	= 'backend/pelanggan/index';

		$this->load->view('backend/template', $data);
	}

	public function detail()
	{
		$data['title']		= 'Detail Data Pelanggan';
		$data['subtitle']	= 'Detail Data Pelanggan';
		$data['content']	= 'backend/pelanggan/detail';

		$this->load->view('backend/template', $data);
	}
}
