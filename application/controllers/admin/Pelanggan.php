<?php
defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pelanggan extends CI_Controller
{

	private $filename = 'upload_data_pelanggan';

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
		$this->form_validation->set_rules('kota_kab', 'Kota / Kab', 'required');
		$this->form_validation->set_rules('kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kel', 'Kelurahan', 'required');
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
					'kota_kab'          => form_error('kota_kab', ' ', ' '),
					'kec'            	=> form_error('kec', ' ', ' '),
					'kel'            	=> form_error('kel', ' ', ' '),
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
				'kota_kab'     		=> $this->input->post('kota_kab'),
				'kec'     			=> $this->input->post('kec'),
				'kel'     			=> $this->input->post('kel'),
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

	public function import()
	{
		if (isset($_POST['upload'])) {
			$upload = $this->model_pelanggan->upload_file($this->filename);
			if ($upload['result'] == "success") {
				$reader			= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet	= $reader->load('uploads/' . $this->filename . '.xlsx');
				$sheet			= $spreadsheet->getActiveSheet()->toArray();

				$insert_pelanggan = 0;
				$update_pelanggan = 0;

				$a = 'NAMA PELANGGAN';
				$b = 'INTERNET';
				$c = 'VOICE';
				$d = 'ODP';
				$e = 'PORT';
				$f = 'SN ONT';
				$g = 'TIPE PELANGGAN';
				$h = 'EMAIL';
				$i = 'NO HP';
				$j = 'KOTA / KAB';
				$k = 'KECAMATAN';
				$l = 'KELURAHAN';
				$m = 'ALAMAT';

				if ($a != $sheet[0][0] ||    $b != $sheet[0][1] ||    $c != $sheet[0][2] ||    $d != $sheet[0][3] ||    $e != $sheet[0][4] ||    $f != $sheet[0][5] ||    $g != $sheet[0][6] ||    $h != $sheet[0][7] ||    $i != $sheet[0][8] ||    $j != $sheet[0][9] ||    $k != $sheet[0][10] ||    $l != $sheet[0][11] ||    $m != $sheet[0][12]) {
					$this->session->set_flashdata('error', '<b>Error!</b> Format Tidak Sesuai.');
				} else {
					$numrow = 1;
					foreach ($sheet as $row) {
						if ($numrow > 1) {
							if ($row[0] != "") {
								$nama_pelanggan		= $row[0];
								$internet			= $row[1];
								$voice				= $row[2];
								$odp				= $row[3];
								$port				= $row[4];
								$sn_ont 			= $row[5];
								$tipe_pelanggan 	= $row[6];
								$email 				= $row[7];
								$no_hp 				= $row[8];
								$kota_kab 			= $row[9];
								$kec 				= $row[10];
								$kel 				= $row[11];
								$alamat 			= $row[12];

								$cek_pelanggan = $this->db->query("SELECT id_pelanggan FROM tb_pelanggan WHERE no_internet = '" . $internet . "' OR no_voice = '" . $voice . "'")->num_rows();
								if ($cek_pelanggan <= 0) {
									$data_pelanggan = [
										'nama_pelanggan'	=> $nama_pelanggan,
										'no_internet'		=> $internet,
										'no_voice'			=> $voice,
										'odp'     			=> $odp,
										'port'      		=> $port,
										'sn_ont'    		=> $sn_ont,
										'tipe' 				=> $tipe_pelanggan,
										'email'  			=> $email,
										'no_hp'      		=> $no_hp,
										'kota_kab'      	=> $kota_kab,
										'kec'      			=> $kec,
										'kel'      			=> $kel,
										'alamat'			=> $alamat
									];

									$this->model_pelanggan->insert($data_pelanggan);
									$insert_pelanggan++;
								} else {
									$pelanggan = $this->db->query("SELECT id_pelanggan FROM tb_pelanggan WHERE no_internet = '" . $internet . "' OR no_voice = '" . $voice . "'")->row();
									$data_pelanggan = [
										'nama_pelanggan'	=> $nama_pelanggan,
										'no_internet'		=> $internet,
										'no_voice'			=> $voice,
										'odp'     			=> $odp,
										'port'      		=> $port,
										'sn_ont'    		=> $sn_ont,
										'tipe' 				=> $tipe_pelanggan,
										'email'  			=> $email,
										'no_hp'      		=> $no_hp,
										'kota_kab'      	=> $kota_kab,
										'kec'      			=> $kec,
										'kel'      			=> $kel,
										'alamat'			=> $alamat
									];

									$this->model_pelanggan->update($pelanggan->id_pelanggan, $data_pelanggan);
									$update_pelanggan++;
								}
							}
						}
						$numrow++;
					}

					$this->session->set_flashdata('info', '<b>Success!</b> ' . $insert_pelanggan . ' Pelanggan Baru & ' . $update_pelanggan . ' Update Pelanggan Lama');
				}
			} else {
				$this->session->set_flashdata('error', '<b>Error!</b> ' . $upload['error']);
			}
		}

		$data['title']		= 'Import Data Pelanggan';
		$data['subtitle']	= 'Import Data Pelanggan';
		$data['content']	= 'backend/pelanggan/import';

		$this->load->view('backend/template', $data);
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
		$this->form_validation->set_rules('kota_kab', 'Kota / Kab', 'required');
		$this->form_validation->set_rules('kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kel', 'Kelurahan', 'required');
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
					'kota_kab'          => form_error('kota_kab', ' ', ' '),
					'kec'            	=> form_error('kec', ' ', ' '),
					'kel'            	=> form_error('kel', ' ', ' '),
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
				'kota_kab'     		=> $this->input->post('kota_kab'),
				'kec'     			=> $this->input->post('kec'),
				'kel'     			=> $this->input->post('kel'),
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

	public function getTemplateUpload()
	{
		$this->load->helper('download');
		force_download('./uploads/template/Template_Import_Data_Pelanggan.xlsx', NULL);
	}
}
