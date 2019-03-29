<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Transaction_model');
		$this->load->model('Branch_model');
		$this->load->model('Item_branch_model');
	}

	public function index()
	{

		if($this->session->userdata('user_role') != SUPERADMIN){
			$params['transactions.branch_id'] = $this->session->userdata('branch_id');
		} else {
			$params = null;
		}

		$params["DATE_FORMAT(transaction_created_at,'%Y-%m')"] = date('Y-m');

		$trx = $this->Transaction_model->get_transaction($params)->result();
		$detail = $this->Transaction_model->get_transaction_detail($params)->result();
		$data['total_branch'] = count($this->Branch_model->get_branch()->result());
		$data['total_item_branch'] = count($this->Item_branch_model->get_item_branch()->result());

		$data['total_trx'] = 0;
		foreach ($trx as $key) {
			$data['total_trx'] += $key->transaction_total_price;
		}

		$data['total_item'] = 0;
		foreach ($detail as $key) {
			$data['total_item'] += $key->qty;
		}


		$data['title'] = 'Dashboard';
		$data['main'] = 'dashboard/index';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */