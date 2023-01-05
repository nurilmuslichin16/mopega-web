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
				'status'     		=> 0
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
					'status' => 2
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
