<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Distributor_model');
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
		$config['base_url'] = site_url('distributor');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Distributor_model->get_distributor()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['distributor'] = $this->Distributor_model->get_distributor(null,$limit,$offset)->result();

		$data['title'] = 'Distributor';
		$data['main'] = 'distributor/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$params['distributor_name'] = $this->input->post('distributor_name');
		$this->Distributor_model->insert_distributor($params);
		$this->session->set_flashdata('success', 'Tambah distributor berhasil');
		redirect('distributor');
	}

	function edit(){
		$id = $this->input->post('id');
		$params['distributor_name'] = $this->input->post('distributor_name');
		$this->Distributor_model->update_distributor($params, ['distributor_id'=>$id]);
		$this->session->set_flashdata('success', 'Edit distributor berhasil');
		redirect('distributor');
	}


    public function getubah()
    {
    	$id = $this->input->post('id');
        echo json_encode($this->Distributor_model->get_distributor(['distributor_id'=>$id])->row_array());
    }

}

/* End of file Distributor.php */
/* Location: ./application/controllers/Distributor.php */