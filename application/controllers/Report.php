<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */