<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Mutation_model');
		$this->load->model('Branch_model');
		$this->load->model('Item_model');
		$this->load->model('Item_branch_model');
		$this->load->model('Stock_model');
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

		if($this->session->userdata('user_role') != SUPERADMIN){
			$params['mutations.branch_id'] = $this->session->userdata('branch_id');
		} else {
			$params = null;
		}
		
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'per_page';
		$config['base_url'] = site_url('mutation');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Mutation_model->get_mutation($params)->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['mutation'] = $this->Mutation_model->get_mutation($params,$limit,$offset)->result();
		$data['item'] = $this->Item_model->get_item()->result_array();
		$data['branch'] = $this->Branch_model->get_branch()->result();

		$data['title'] = 'Mutasi Barang';
		$data['main'] = 'mutation/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$this->db->trans_start();

		$lastno = $this->Mutation_model->get_mutation(null,1)->row_array();

		if (date('Y', strtotime($lastno['mutation_created_at'])) < date('Y') OR (count($lastno)) == 0) {
			$nomor = sprintf('%04d', '0001');
			$no_trx = $nomor .'/MTS-'. date('Ym');
		} else {
			$no = substr($lastno['mutation_no_trx'], 0, 4);
			$nomor = sprintf('%04d', $no + 0001);
			$no_trx = $nomor .'/MTS-'. date('Ym');
		}

		$params['mutation_no_trx'] = $no_trx;
		$params['branch_id'] = $this->input->post('branch_id');
		$params['user_id'] = $this->session->userdata('user_id');
		$id_mutation = $this->Mutation_model->insert_mutation($params);

		// mutasi detail
		$mutation_detail = array();
		$item_branch = array();
		$qty = $this->input->post('qty');
		$item = $this->input->post('item_id');
		for ($i = 0; $i < count($qty); $i++) {
			if($qty[$i] > 0){
				array_push($mutation_detail, [
					'mutation_id' => $id_mutation,
					'item_id' => $item[$i],
					'qty' => $qty[$i],
				]);
			}
		}
		if(!empty($mutation_detail)){

			$this->db->insert_batch('mutation_details', $mutation_detail);
			$this->Stock_model->update_stock_batch($item, $qty, '-');

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('failed','Data not saved.');
				redirect('mutation');
			} else {
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Data saved.');
				redirect('mutation');
			} 
		}else{
			$this->session->set_flashdata('failed','Quantity tidak boleh 0 semua');
			redirect('mutation');
		}
	}

	function detail($id=null){

		$data['mutation'] = $this->Mutation_model->get_mutation(['mutation_id'=>$id])->row();
		$data['detail'] = $this->Mutation_model->get_mutation_detail(['mutation_details.mutation_id'=>$id])->result();
		$data['title'] = 'Mutasi Detail';
		$data['main'] = 'mutation/detail';
		$this->load->view('templates/layout', $data);
	}

	function approve(){

		$id = $this->input->post('mutation_id');

		$detail = $this->Mutation_model->get_mutation_detail(['mutation_details.mutation_id'=>$id])->result_array();

		if($_POST){
			$this->Mutation_model->update_mutation([
				'mutation_status'=>1,
				'mutation_user_approve' => $this->session->userdata('user_id')
			], 
			['mutation_id'=>$id]);

			// insert ke item branch
			$item_branch = array();
			for ($i = 0; $i < count($detail); $i++) {
				array_push($item_branch, [
					'branch_id' => $detail[$i]['branch_id'],
					'item_id' => $detail[$i]['item_id'],
					'item_branch_stock' => $detail[$i]['qty']
				]);
			}

			$this->Item_branch_model->insert_item_branch($item_branch);


			$this->session->set_flashdata('success','Data saved');
			redirect('mutation');
		}
	}

}

/* End of file Mutation.php */
/* Location: ./application/controllers/Mutation.php */