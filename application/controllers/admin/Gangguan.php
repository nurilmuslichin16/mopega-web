<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gangguan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_gangguan');
		$this->load->model('model_teknisi');
	}

	public function index()
	{
		$data['title']			= 'Daftar Laporan';
		$data['subtitle']		= 'Daftar Laporan Gangguan';
		$data['content']		= 'backend/gangguan/index';
		$data['listData']		= $this->model_gangguan->get_all()->result_array();
		$data['listTeknisi']	= $this->model_teknisi->get_all()->result_array();

		$this->load->view('backend/template', $data);
	}

	public function getData()
	{
		$id_gangguan 	= $this->input->post('id_gangguan');
		$data			= $this->model_gangguan->get_where(['id_gangguan' => $id_gangguan])->row_array();

		echo json_encode($data);
	}

	public function detail($id_gangguan)
	{
		$data['title']		= 'Detail Laporan';
		$data['subtitle']	= 'Detail Laporan Gangguan';
		$data['content']	= 'backend/gangguan/detail';
		$data['data']		= $this->model_gangguan->get_where(['id_gangguan' => $id_gangguan])->row_array();

		$this->load->view('backend/template', $data);
	}

	public function delete()
	{
		$id_gangguan	= $this->input->post('id_gangguan');;
		$query			= $this->model_gangguan->delete($id_gangguan);

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

	public function cetak()
	{
		$data['title']		= 'Cetak Laporan';
		$data['subtitle']	= 'Cetak Laporan Gangguan';
		$data['content']	= 'backend/gangguan/cetak';

		$this->load->view('backend/template', $data);
	}

	public function download()
	{
		$tgl_awal 	= $this->input->post('tgl_lapor_mulai');
		$tgl_akhir 	= $this->input->post('tgl_lapor_akhir');
		$tipe 		= $this->input->post('tipe');
		$status 	= $this->input->post('status');

		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('STO Telkom Kedungwuni')
			->setLastModifiedBy('STO Telkom Kedungwuni')
			->setTitle("Data Laporan Gangguan")
			->setSubject("Team Leader")
			->setDescription("Data Laporan Gangguan")
			->setKeywords("Laporan Gangguan");

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA DOKTER");
		$excel->getActiveSheet()->mergeCells('A1:M1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "TIKET");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA PELANGGAN");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "INTERNET");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "VOICE");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "TIPE");
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "ODP");
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "PORT");
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "SERIAL NUMBER ONT");
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "KETERANGAN");
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "PENYABAB");
		$excel->setActiveSheetIndex(0)->setCellValue('K3', "PERBAIKAN");
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "TANGGAL LAPORAN");
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "TEKNISI");

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);

		$dokter = $this->model_gangguan->cetak($tgl_awal, $tgl_akhir, $tipe, $status)->result();
		$numrow = 4;
		foreach ($dokter as $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data->tiket);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nama_pelanggan);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->no_internet);
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->no_voice);
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->tipe);
			$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->odp);
			$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->port);
			$excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->sn_ont);
			$excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->ket);
			$excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->penyebab);
			$excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->perbaikan);
			$excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, date_indo($data->report_date));
			$excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->nama_teknisi);

			$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);

			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(33);

		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$excel->getActiveSheet(0)->setTitle("Daftar Laporan Gangguan");
		$excel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Cetak Laporan Gangguan ' . date('d-m-Y') . '.xlsx"');
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		ob_end_clean();
		$write->save('php://output');
	}

	public function cek($tgl_awal = null, $tgl_akhir = null, $tipe = null, $status = null)
	{
		$query = $this->model_gangguan->cetak($tgl_awal, $tgl_akhir, $tipe, $status)->result();

		echo json_encode($query);
	}

	public function track()
	{
		$data['title']		= 'Track Laporan';
		$data['subtitle']	= 'Track Laporan Gangguan';
		$data['content']	= 'backend/gangguan/track';
		$data['track']		= false;

		if ($this->input->post('submit')) {
			$data['track']	= true;
			$tiket			= $this->input->post('tiket');
			$data['result']	= $this->model_gangguan->log($tiket)->result_array();
		}

		$this->load->view('backend/template', $data);
	}
}
