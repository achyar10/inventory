<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Item_model');
		$this->load->model('Branch_model');
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
		$config['base_url'] = site_url('item');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Item_model->get_item()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['item'] = $this->Item_model->get_item(null,$limit,$offset)->result();
		$data['branch'] = $this->Branch_model->get_branch()->result();
		$data['distributor'] = $this->Distributor_model->get_distributor()->result();

		$data['title'] = 'Barang';
		$data['main'] = 'item/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$params['item_name'] = $this->input->post('item_name');
		$params['item_sku'] = $this->input->post('item_sku');
		$params['item_merk'] = $this->input->post('item_merk');
		$params['item_price'] = $this->input->post('item_price');
		$params['branch_id'] = $this->input->post('branch_id');
		$params['distributor_id'] = $this->input->post('distributor_id');
		$params['item_stock'] = 0;

		$full = time().rand(1111,9999);
		if (!empty($_FILES['item_image']['name'])) {
			$params['item_image'] = $this->upload_image($name = 'item_image', $fileName= $full);
		} 

		$this->Item_model->insert_item($params);
		redirect('item');
	}

	function edit(){
		$id = $this->input->post('id');
		$params['item_name'] = $this->input->post('item_name');
		$params['item_sku'] = $this->input->post('item_sku');
		$params['item_merk'] = $this->input->post('item_merk');
		$params['item_price'] = $this->input->post('item_price');
		$params['branch_id'] = $this->input->post('branch_id');
		$params['distributor_id'] = $this->input->post('distributor_id');

		$full = time().rand(1111,9999);
		if (!empty($_FILES['item_image']['name'])) {
			$params['item_image'] = $this->upload_image($name = 'item_image', $fileName= $full);
		} 

		$this->Item_model->update_item($params, ['item_id'=>$id]);
		redirect('item');
	}


	public function getubah()
	{
		$id = $this->input->post('id');
		echo json_encode($this->Item_model->get_item(['item_id'=>$id])->row_array());
	}

	function upload_image($name=NULL, $fileName=NULL, $dir=null) {
		$this->load->library('upload');

		$config['upload_path'] = FCPATH . 'uploads/items/';

		/* create directory if not exist */
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = '1024';
		$config['file_name'] = $fileName;
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($name)) {
			$this->session->set_flashdata('failed', $this->upload->display_errors('', ''));
			redirect(uri_string());
		}

		$upload_data = $this->upload->data();

		return $upload_data['file_name'];
	}

}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */