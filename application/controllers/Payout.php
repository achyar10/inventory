<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Branch_model');
		$this->load->model('Item_model');
		$this->load->model('Item_branch_model');
	}

	public function index()
	{
		
		if($this->session->userdata('user_role') != SUPERADMIN){
			$params['item_branch.branch_id'] = $this->session->userdata('branch_id');
		} else {
			$params = null;
		}
		
		$data['item_branch'] = $this->Item_branch_model->get_item_branch($params)->result();
		$data['item'] = $this->Item_model->get_item()->result_array();
		
		$data['title'] = 'Menu Transaksi';
		$data['main'] = 'payout/index';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Payout.php */
/* Location: ./application/controllers/Payout.php */