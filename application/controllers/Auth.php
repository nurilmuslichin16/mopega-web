<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
	}

	public function index()
	{
		$this->_checkRememberMe();

		if ($this->session->userdata('logged_in')) {
			redirect('admin/dashboard');
		} else {
			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('email', 'Email', 'required');

				$this->form_validation->set_rules('password', 'Password', 'required');

				$this->form_validation->set_message('required', '%s tidak boleh kosong');

				if ($this->form_validation->run() == TRUE) {
					if ($this->_login()) {
						redirect('admin/dashboard');
					} else {
						$this->load->view('login');
					}
				} else {
					$this->load->view('login');
				}
			} else {
				$this->load->view('login');
			}
		}
	}

	function _checkRememberMe()
	{
		if (get_cookie('id') && get_cookie('email')) {
			$user_id	= get_cookie('id');
			$email		= get_cookie('email');

			$cek_user 	= $this->db->get_where('tb_user', ['id_user' => $user_id, 'status' => 1], 1, NULL)->row();
			if (hash('sha256', $cek_user->email) === $email) {
				$login_data = [
					'id_user'        => $cek_user->id_user,
					'nama_lengkap'   => $cek_user->nama_lengkap,
					'email'          => $cek_user->email,
					'level'    		 => $cek_user->level,
					'logged_in'      => true
				];

				$this->session->set_userdata($login_data);
			} else {
				$this->session->sess_destroy();
			}
		} else {
			$this->session->sess_destroy();
		}
	}

	public function _login()
	{
		$email 		= $this->input->post('email');
		$password	= $this->input->post('password');
		$rememberMe	= $this->input->post('rememberMe') !== NULL ? TRUE : FALSE;

		$query		= $this->model_user->get_where(['email' => $email])->row_array();

		if ($query) {
			$hash = $query['password'];

			if (password_verify($password, $hash)) {
				$this->model_user->update($query['id_user'], ['last_login' => date('Y-m-d H:i:s')]);

				// data user dalam bentuk array
				$userData = array(
					'id_user'        => $query['id_user'],
					'nama_lengkap'   => $query['nama_lengkap'],
					'email'          => $query['email'],
					'level'    		 => $query['level'],
					'logged_in'      => true
				);

				// set session untuk user
				$this->session->set_userdata($userData);

				if ($rememberMe) {
					$this->input->set_cookie('id', $query['id_user'], (60 * 60 * 24));
					$this->input->set_cookie('email', hash('sha256', $email), (60 * 60 * 24));
				} else {
					$this->input->set_cookie('id', $query['id_user'], 0);
					$this->input->set_cookie('email', hash('sha256', $email), 0);
				}

				$message = [
					'status' => true,
					'message' => 'Berhasil login.'
				];

				$this->session->set_flashdata('alert', $message);

				return TRUE;
			} else {
				$message = [
					'status' => false,
					'message' => 'Password tidak valid, silahkan cek kembali.'
				];

				$this->session->set_flashdata('alert', $message);

				return FALSE;
			}
		} else {
			$message = [
				'status' => false,
				'message' => 'Email belum terdaftar, silahkan cek kembali.'
			];

			$this->session->set_flashdata('alert', $message);

			return FALSE;
		}
	}

	public function logout()
	{
		// Hapus semua data pada session
		$this->session->sess_destroy();
		$this->input->set_cookie('id', '');
		$this->input->set_cookie('email', '');

		redirect('login');
	}
}
