<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Branch_model');
	}

	public function index()
	{

		$this->load->library('pagination');
		$page = $this->input->get('per_page');

		$limit=5; 

		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'per_page';
		$config['base_url'] = site_url('branch');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Branch_model->get_branch()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['branch'] = $this->Branch_model->get_branch(null,$limit,$offset)->result();

		$data['title'] = 'Cabang';
		$data['main'] = 'branch/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$params['branch_name'] = $this->input->post('branch_name');
		$params['branch_phone'] = $this->input->post('branch_phone');
		$params['branch_address'] = $this->input->post('branch_address');

		$this->Branch_model->insert_branch($params);
		$this->session->set_flashdata('success', 'Tambah cabang berhasil');
		redirect('branch');
	}

	function edit(){
		$id = $this->input->post('id');
		$params['branch_name'] = $this->input->post('branch_name');
		$params['branch_phone'] = $this->input->post('branch_phone');
		$params['branch_address'] = $this->input->post('branch_address');

		$this->Branch_model->update_branch($params, ['branch_id'=>$id]);
		$this->session->set_flashdata('success', 'Edit cabang berhasil');
		redirect('branch');
	}


    public function getubah()
    {
    	$id = $this->input->post('id');
        echo json_encode($this->Branch_model->get_branch(['branch_id'=>$id])->row_array());
    }

}

/* End of file Branch.php */
/* Location: ./application/controllers/Branch.php */