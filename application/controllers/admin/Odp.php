<?php
defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Odp extends CI_Controller
{

	private $filename = 'upload_data_odp';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != true) {
			redirect('login');
		}

		$this->load->model('model_odp');
	}

	public function index()
	{
		$data['title']		= 'Data ODP';
		$data['subtitle']	= 'Data ODP';
		$data['content']	= 'backend/odp/index';
		$data['listData']	= $this->model_odp->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_odp', 'Nama ODP', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required');

		if ($this->form_validation->run() == false) {
			$response	= [
				'status' 	=> 1,
				'error'		=> [
					'nama_odp'    => form_error('nama_odp', ' ', ' '),
					'latitude'    => form_error('latitude', ' ', ' '),
					'longitude'   => form_error('longitude', ' ', ' ')
				]
			];

			echo json_encode($response);
		} else {
			$data = [
				'nama_odp' 	=> $this->input->post('nama_odp'),
				'koordinat' => $this->input->post('latitude') . ',' . $this->input->post('longitude')
			];

			$addData = $this->model_odp->insert($data);

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
			$upload = $this->model_odp->upload_file($this->filename);
			if ($upload['result'] == "success") {
				$reader			= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet	= $reader->load('uploads/' . $this->filename . '.xlsx');
				$sheet			= $spreadsheet->getActiveSheet()->toArray();

				$insert_odp = 0;
				$update_odp = 0;

				$a = 'ODP';
				$b = 'KOORDINAT';

				if ($a != $sheet[0][0] || $b != $sheet[0][1]) {
					$this->session->set_flashdata('error', '<b>Error!</b> Format Tidak Sesuai.');
				} else {
					$numrow = 1;
					foreach ($sheet as $row) {
						if ($numrow > 1) {
							if ($row[0] != "") {
								$nama_odp	= $row[0];
								$koordinat	= $row[1];

								$cek_odp = $this->db->query("SELECT id_odp FROM tb_odp WHERE nama_odp = '" . $nama_odp . "'")->num_rows();
								if ($cek_odp <= 0) {
									$data_odp = [
										'nama_odp'	=> $nama_odp,
										'koordinat'	=> $koordinat
									];

									$this->model_odp->insert($data_odp);
									$insert_odp++;
								} else {
									$odp = $this->db->query("SELECT id_odp FROM tb_odp WHERE nama_odp = '" . $nama_odp . "'")->row();
									$data_odp = [
										'nama_odp'	=> $nama_odp,
										'koordinat'	=> $koordinat
									];

									$this->model_odp->update($odp->id_odp, $data_odp);
									$update_odp++;
								}
							}
						}
						$numrow++;
					}

					$this->session->set_flashdata('info', '<b>Success!</b> ' . $insert_odp . ' ODP Baru & ' . $update_odp . ' Update ODP Lama');
				}
			} else {
				$this->session->set_flashdata('error', '<b>Error!</b> ' . $upload['error']);
			}
		}

		$data['title']		= 'Import Data ODP';
		$data['subtitle']	= 'Import Data ODP';
		$data['content']	= 'backend/odp/import';

		$this->load->view('backend/template', $data);
	}

	public function getData()
	{
		$id_odp 	= $this->input->post('id_odp');
		$data		= $this->model_odp->get_where(['id_odp' => $id_odp])->row_array();

		echo json_encode($data);
	}

	public function edit()
	{
		$this->form_validation->set_rules('nama_odp', 'Nama ODP', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required');

		if ($this->form_validation->run() == false) {
			$response	= [
				'status' 	=> 1,
				'error'		=> [
					'nama_odp'    => form_error('nama_odp', ' ', ' '),
					'latitude'    => form_error('latitude', ' ', ' '),
					'longitude'   => form_error('longitude', ' ', ' ')
				]
			];

			echo json_encode($response);
		} else {
			$data = [
				'nama_odp' 	=> $this->input->post('nama_odp'),
				'koordinat' => $this->input->post('latitude') . ',' . $this->input->post('longitude')
			];

			$ubahData = $this->model_odp->update($this->input->post('id_odp'), $data);

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

	public function detail($id_odp)
	{
		$data['title']		= 'Detail Data ODP';
		$data['subtitle']	= 'Detail Data ODP';
		$data['content']	= 'backend/odp/detail';
		$data['data']		= $this->model_odp->get_where(['id_odp' => $id_odp])->row_array();

		$this->load->view('backend/template', $data);
	}

	public function delete()
	{
		$id_odp	= $this->input->post('id_odp');;
		$query	= $this->model_odp->delete($id_odp);

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
		force_download('./uploads/template/Template_Import_Data_ODP.xlsx', NULL);
	}
}
