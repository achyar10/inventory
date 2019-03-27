<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_branch extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Mutation_model');
		$this->load->model('Branch_model');
		$this->load->model('Item_model');
		$this->load->model('Item_branch_model');
	}

	public function index() {
		if($this->session->userdata('user_role') != SUPERADMIN){
			$params['item_branch.branch_id'] = $this->session->userdata('branch_id');
		} else {
			$params = null;
		}
		
		$data['item_branch'] = $this->Item_branch_model->get_item_branch($params)->result();
		$data['item'] = $this->Item_model->get_item()->result_array();

		$data['title'] = 'Barang';
		$data['main'] = 'item_branch/index';
		$this->load->view('templates/layout', $data);
	}

	function detail($id=null){
		$data['item_branch'] = $this->Item_branch_model->get_item_branch(['item_branch_id'=>$id])->row();
		$data['title'] = 'Barang Detail';
		$data['main'] = 'item_branch/detail';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Item_branch.php */
/* Location: ./application/controllers/Item_branch.php */