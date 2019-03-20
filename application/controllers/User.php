<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('User_model');
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
		$config['base_url'] = site_url('user');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->User_model->get_user()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['user'] = $this->User_model->get_user(null,$limit,$offset)->result();
		$data['branch'] = $this->Branch_model->get_branch()->result();

		$data['title'] = 'Pengguna';
		$data['main'] = 'user/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$params['user_name'] = $this->input->post('user_name');
		$params['user_password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$params['user_role'] = $this->input->post('user_role');
		$params['user_full_name'] = $this->input->post('user_full_name');
		$params['branch_id'] = $this->input->post('branch_id');

		$this->User_model->insert_user($params);
		redirect('user');
	}


    public function getubah()
    {
    	$id = $this->input->post('id');
        echo json_encode($this->User_model->get_user(['user_id'=>$id])->row_array());
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */