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
		$this->load->model('Stock_model');
		$this->load->model('Distributor_model');
	}

	public function index()
	{
		redirect('dashboard');	
	}

	// transaksi

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

	// Mutasi
	function mutation(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$config['base_url'] = site_url('report/mutation');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$data['title'] = 'Laporan Mutasi';
		$data['main'] = 'report/mutation';
		$this->load->view('templates/layout', $data);
	}

	function distributor(){

		$config['base_url'] = site_url('report/mutation');
		$data['distributor'] = $this->Distributor_model->get_distributor()->result();
		$data['title'] = 'Laporan Distributor';
		$data['main'] = 'report/distributor';
		$this->load->view('templates/layout', $data);
	}

	function mutation_export(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$mts = $this->Mutation_model->get_report_mutation($params);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();          
		$cell     = 6;        
		$no       = 1;
		$sheet->setCellValue('A1', 'Laporan Mutasi Barang');
		$sheet->setCellValue('A2', 'CV. Safira Telekomindo');
		$sheet->setCellValue('A3', 'Tanggal Laporan: '.date('d F Y', strtotime($q['ds'])).' s/d '.date('d F Y', strtotime($q['de'])));
		$sheet->setCellValue('A4', 'Tanggal Unduh: '.date('Y-m-d h:i:s'));
		$sheet->setCellValue('C4', 'Pengunduh: '.$this->session->userdata('full_name'));
		
		$sheet->setCellValue('A5', 'NO');
		$sheet->setCellValue('B5', 'UNTUK CABANG');
		$sheet->setCellValue('C5', 'TANGGAL');
		$sheet->setCellValue('D5', 'NAMA BARANG');
		$sheet->setCellValue('E5', 'HARGA');
		$sheet->setCellValue('F5', 'QUANTITY');
		$sheet->setCellValue('G5', 'SUB TOTAL');
		$sheet->setCellValue('H5', 'KETERANGAN');
		foreach ($mts as $row) {
			$sheet->setCellValue('A'.$cell, $no);
			$sheet->setCellValue('B'.$cell, $row['branch_name']);
			$sheet->setCellValue('C'.$cell, $row['mutation_created_at']);
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

	// Stock
	function stock(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$config['base_url'] = site_url('report/stock');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$data['title'] = 'Laporan Barang Masuk';
		$data['main'] = 'report/stock';
		$this->load->view('templates/layout', $data);
	}

	function stock_export(){

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;
		$params = array();

		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$order = $this->Stock_model->get_report_stock($params);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();          
		$cell     = 6;        
		$no       = 1;
		$sheet->setCellValue('A1', 'Laporan Barang Masuk');
		$sheet->setCellValue('A2', 'CV. Safira Telekomindo');
		$sheet->setCellValue('A3', 'Tanggal Laporan: '.date('d F Y', strtotime($q['ds'])).' s/d '.date('d F Y', strtotime($q['de'])));
		$sheet->setCellValue('A4', 'Tanggal Unduh: '.date('Y-m-d h:i:s'));
		$sheet->setCellValue('C4', 'Pengunduh: '.$this->session->userdata('full_name'));
		
		$sheet->setCellValue('A5', 'NO');
		$sheet->setCellValue('B5', 'NO TRANSAKSI');
		$sheet->setCellValue('C5', 'TANGGAL');
		$sheet->setCellValue('D5', 'SKU');
		$sheet->setCellValue('E5', 'NAMA BARANG');
		$sheet->setCellValue('F5', 'JUMLAH MASUK');
		$sheet->setCellValue('G5', 'KETERANGAN');
		foreach ($order as $row) {
			$sheet->setCellValue('A'.$cell, $no);
			$sheet->setCellValue('B'.$cell, $row['stock_no_trx']);
			$sheet->setCellValue('C'.$cell, $row['stock_created_at']);
			$sheet->setCellValue('D'.$cell, $row['item_sku']);
			$sheet->setCellValue('E'.$cell, $row['item_name']);
			$sheet->setCellValue('F'.$cell, $row['qty']);
			$sheet->setCellValue('G'.$cell, '');
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
		->getStyle('A5:G5')
		->applyFromArray($font);
		$spreadsheet->getActiveSheet()
		->getStyle('A5:G5')
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

	function printDist($id=null){
		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$data['distributor'] = $this->Distributor_model->get_distributor()->result();
		$fileName = 'Laporan Distributor';
		$data['title'] = $fileName;
		$html = $this->load->view('report/distributor_pdf', $data, TRUE);
		$mpdf->WriteHTML(utf8_encode($html));
		$mpdf->Output($fileName. ".pdf", 'I');

	}



}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */