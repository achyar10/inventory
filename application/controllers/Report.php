<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Transaction_model');
		$this->load->model('Branch_model');
		$this->load->model('Item_model');
		$this->load->model('Item_branch_model');
		$this->load->model('Mutation_model');
	}

	public function index()
	{
		redirect('dashboard');	
	}

	function transaction(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$config['base_url'] = site_url('report/transaction');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$data['title'] = 'Laporan Transaksi';
		$data['main'] = 'report/transaction';
		$this->load->view('templates/layout', $data);
	}

	function transaction_export(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$trx = $this->Transaction_model->get_report_trans($params);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();          
		$cell     = 6;        
		$no       = 1;
		$sheet->setCellValue('A1', 'Laporan Transaksi Penjualan');
		$sheet->setCellValue('A2', 'CV. Safira Telekomindo');
		$sheet->setCellValue('A3', 'Tanggal Laporan: '.date('d F Y', strtotime($q['ds'])).' s/d '.date('d F Y', strtotime($q['de'])));
		$sheet->setCellValue('A4', 'Tanggal Unduh: '.date('Y-m-d h:i:s'));
		$sheet->setCellValue('C4', 'Pengunduh: '.$this->session->userdata('full_name'));
		
		$sheet->setCellValue('A5', 'NO');
		$sheet->setCellValue('B5', 'CABANG');
		$sheet->setCellValue('C5', 'TANGGAL');
		$sheet->setCellValue('D5', 'NAMA BARANG');
		$sheet->setCellValue('E5', 'HARGA');
		$sheet->setCellValue('F5', 'QUANTITY');
		$sheet->setCellValue('G5', 'SUB TOTAL');
		$sheet->setCellValue('H5', 'KETERANGAN');
		foreach ($trx as $row) {
			$sheet->setCellValue('A'.$cell, $no);
			$sheet->setCellValue('B'.$cell, $row['branch_name']);
			$sheet->setCellValue('C'.$cell, $row['transaction_created_at']);
			$sheet->setCellValue('D'.$cell, $row['item_name']);
			$sheet->setCellValue('E'.$cell, $row['item_price']);
			$sheet->setCellValue('F'.$cell, $row['qty']);
			$sheet->setCellValue('G'.$cell, $row['item_price']*$row['qty']);
			$sheet->setCellValue('H'.$cell, '');
			$cell++;
			$no++; 
		}
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		foreach(range('D', 'Z') as $alphabet)
		{
			$spreadsheet->getActiveSheet()->getColumnDimension($alphabet)->setWidth(20);
		}
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$font = array('font' => array( 'bold' => true, 'color' => array(
			'rgb'  => 'FFFFFF')));
		$spreadsheet->getActiveSheet()
		->getStyle('A5:H5')
		->applyFromArray($font);
		$spreadsheet->getActiveSheet()
		->getStyle('A5:H5')
		->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor()
		->setARGB('000');
		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold( true );
		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan_'.date('Ymdhis');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */