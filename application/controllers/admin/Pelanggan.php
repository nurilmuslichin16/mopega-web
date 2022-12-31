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

	function add()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('tipe', 'Nama Pasien', 'required');
		$this->form_validation->set_rules('email', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('no_hp', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('internet', 'Agama', 'required|is_unique[tb_pelanggan.no_internet]', ['is_unique' => 'Internet sudah ada!']);
		$this->form_validation->set_rules('telepon', 'Pendidikan Terakhir', 'required|is_unique[tb_pelanggan.no_voice]', ['is_unique' => 'Voice sudah ada!']);
		$this->form_validation->set_rules('odp', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('port', 'Status Perkawinan', 'required');
		$this->form_validation->set_rules('sn', 'Provinsi', 'required');

		if ($this->form_validation->run() == false) {
			$response['error'] = array(
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
			);

			$response	= [
				'status' => 1
			];

			echo json_encode($response);
		} else {
			$pecah = explode("-", $this->input->post('tanggal_lahir'));
			$tanggal = $pecah[2];
			$bulan = $pecah[1];
			$tahun = $pecah[0];
			$password = $tanggal . $bulan . $tahun;

			$tahunlahir = substr($pecah[0], 2);
			$no_rm = $tahunlahir . '-' . date('i-s');

			$data = [
				'nik'               => $this->input->post('nik'),
				'nama'              => $this->input->post('nama_pasien'),
				'jekel'   	        => $this->input->post('jekel'),
				'tempat_lahir'      => $this->input->post('tempat_lahir'),
				'tanggal_lahir'     => $this->input->post('tanggal_lahir'),
				'agama'      	    => $this->input->post('agama'),
				'pendidikan'        => $this->input->post('pendidikan'),
				'pekerjaan'   	    => $this->input->post('pekerjaan'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'prov'      	    => $this->input->post('prov'),
				'kota_kab'          => $this->input->post('kota_kab'),
				'kec'               => $this->input->post('kec'),
				'kel'               => $this->input->post('kel'),
				'alamat'            => $this->input->post('alamat'),
				'kewarganegaraan'   => $this->input->post('kewarganegaraan'),
				'hp'                => $this->input->post('hp'),
				'email'             => $this->input->post('email'),
				'aktif'             => 1,
				'password'          => password_hash($password, PASSWORD_DEFAULT)
			];

			$tambah = $this->m_datapasien->tambah($data);
			if ($tambah) {
				$datarm = [
					'no_rm'     => $no_rm,
					'id_pasien' => $tambah
				];

				$datatoken = [
					'id_pasien'     => $tambah,
					'nama_login'    => $this->input->post('nama_pasien'),
					'token'         => ''
				];

				$this->db->insert('tbl_rekammedis', $datarm);
				$this->db->insert('tbl_token_mobile', $datatoken);
				$validasi['status'] = 2;
				echo json_encode($validasi);
			} else {
				$validasi['status'] = 3;
				echo json_encode($validasi);
			}
		}
	}

	public function detail()
	{
		$data['title']		= 'Detail Data Pelanggan';
		$data['subtitle']	= 'Detail Data Pelanggan';
		$data['content']	= 'backend/pelanggan/detail';

		$this->load->view('backend/template', $data);
	}
}
