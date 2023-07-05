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

	public function addLapor()
	{
		$this->load->model('model_pelanggan');
		$this->load->model('model_gangguan');
		$this->load->model('model_log');

		$nomor 		= $this->input->post('nomor');
		$email		= $this->input->post('email');
		$phone		= $this->input->post('phone');
		$alamat		= $this->input->post('alamat');
		$keterangan	= $this->input->post('keterangan');

		$tiket		= '';

		$cekNomor 	= $this->model_pelanggan->cekNomor($nomor)->row_array();
		if (isset($cekNomor)) {
			$duplikatTiket	= true;
			while ($duplikatTiket) {
				$random	= rand(1000, 100000);
				$tiket 	= "IN$random";

				$cekDuplikat = $this->model_gangguan->duplikatTiket(['tiket' => $tiket])->num_rows();

				if ($cekDuplikat < 1) {
					$duplikatTiket = false;
				}
			}

			$report_date	= date("Y-m-d H:i:s");
			switch ($cekNomor['tipe']) {
				case 'BGES / VPN IP':
					$booking_date	= date("Y-m-d H:i:s", strtotime('+3 hours'));
					break;

				case 'WIFI ID':
					$booking_date	= date("Y-m-d H:i:s", strtotime('+4 hours'));
					break;

				default:
					$booking_date	= date("Y-m-d H:i:s", strtotime('+5 hours'));
					break;
			}

			$updatePelanggan = $this->model_pelanggan->update($cekNomor['id_pelanggan'], [
				'email'		=> $email,
				'no_hp'		=> $phone,
				'alamat'	=> $alamat
			]);

			$dataGangguan 	= [
				'id_pelanggan'    	=> $cekNomor['id_pelanggan'],
				'tiket'          	=> $tiket,
				'ket'   	    	=> $keterangan,
				'report_date'      	=> $report_date,
				'booking_date'      => $booking_date,
				'status'     		=> 0,
				'penyebab'			=> '-',
				'perbaikan'			=> '-'
			];

			$addData 		= $this->model_gangguan->insert($dataGangguan);
			$id_gangguan	= $this->db->insert_id();

			$dataLog		= [
				'id_gangguan'	=> $id_gangguan,
				'action'		=> 0,
				'keterangan'	=> $keterangan,
				'waktu'			=> $report_date
			];

			$insertLog		= $this->model_log->insert($dataLog);

			if ($updatePelanggan && $addData && $insertLog) {
				$response	= [
					'status' => 2,
					'tiket' => $tiket
				];
			} else {
				$response	= [
					'status' => 3
				];
			}
		} else {
			$response	= [
				'status' => 1
			];
		}

		echo json_encode($response);
	}

	public function track()
	{
		$data['content']	= 'frontend/track';

		$this->load->view('frontend/template', $data);
	}

	public function trackresult()
	{
		$this->load->model('model_gangguan');

		$tiket	= $this->input->post('tiket');

		$data['content']	= 'frontend/trackresult';
		$data['info']		= $this->model_gangguan->get_where(['tiket' => $tiket])->row_array();
		$data['data']		= $this->model_gangguan->log($tiket)->result_array();

		$this->load->view('frontend/template', $data);
	}

	public function ceknomor()
	{
		$data['content']	= 'frontend/ceknomor';

		$this->load->view('frontend/template', $data);
	}

	public function ceknomorresult()
	{
		$this->load->model('model_pelanggan');
		$this->load->model('model_gangguan');

		$nomor	= $this->input->post('nomor');

		$data['content']	= 'frontend/ceknomorresult';
		$data['info']		= $this->model_pelanggan->cekNomor($nomor)->row_array();
		$data['data']		= $this->model_gangguan->historyGangguan($nomor)->result_array();

		$this->load->view('frontend/template', $data);
	}
}
