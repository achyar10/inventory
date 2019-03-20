<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['main'] = 'dashboard/index';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */