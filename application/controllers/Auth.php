<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		redirect('admin/dashboard');
	}

	public function logout()
	{
		redirect('login');
	}
}
