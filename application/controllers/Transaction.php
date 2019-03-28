<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Branch_model');
		$this->load->model('Item_model');
		$this->load->model('Item_branch_model');
		$this->load->model('Transaction_model');
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
		$data['main'] = 'transaction/index';
		$this->load->view('templates/layout', $data);
	}

	function process(){

		$this->db->trans_start();

		$lastno = $this->Transaction_model->get_transaction(null,1)->row_array();

		if (date('Y', strtotime($lastno['transaction_created_at'])) < date('Y') OR (count($lastno)) == 0) {
			$nomor = sprintf('%04d', '0001');
			$no_trx = $nomor .'/TRX-'. date('Ym');
		} else {
			$no = substr($lastno['transaction_no_trx'], 0, 4);
			$nomor = sprintf('%04d', $no + 0001);
			$no_trx = $nomor .'/TRX-'. date('Ym');
		}

		$qty = $this->input->post('qty');
		$item_branch_id = $this->input->post('item_branch_id');
		$item_price = $this->input->post('item_price');

		$grand_total = 0;
		for($i=0; $i<count($item_price); $i++){
			$grand_total = $grand_total + ($qty[$i] * $item_price[$i]);
		}

		$params['transaction_no_trx'] = $no_trx;
		$params['transaction_total_price'] = $grand_total;
		$params['user_id'] = $this->session->userdata('user_id');
		$params['branch_id'] = $this->session->userdata('branch_id');

		$id_trx = $this->Transaction_model->insert_transaction($params);

		
		$detail = array();
		for ($i = 0; $i < count($qty); $i++) {
			if($qty[$i] > 0){
				array_push($detail, [
					'transaction_id' => $id_trx,
					'item_branch_id' => $item_branch_id[$i],
					'qty' => $qty[$i],
					'item_price' => $item_price[$i]
				]);
			}
		}

		if(!empty($detail)){
			$this->db->insert_batch('transaction_details', $detail);
			$this->Item_branch_model->update_stock_batch($item_branch_id, $qty, '-');

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('failed','Data not saved.');
				redirect('transaction');
			} else {
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Transaksi Berhasil');
				redirect('transaction/detail/'.$id_trx);
			} 

		} else {
			$this->session->set_flashdata('failed','Quantity tidak boleh 0 semua');
			redirect('transaction');
		}
	}

	function getItem(){
		$id = $this->input->post('id');
		echo json_encode($this->Item_branch_model->get_item_branch(['item_branch.item_branch_id'=>$id])->row_array());
	}

	function list(){

		$this->load->library('pagination');
		$page = $this->input->get('per_page');

		$limit=5; 

		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;


		if($this->session->userdata('user_role') != SUPERADMIN){
			$params['transactions.branch_id'] = $this->session->userdata('branch_id');
		} else {
			$params = null;
		}
		
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'per_page';
		$config['base_url'] = site_url('transaction/list');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Transaction_model->get_transaction($params)->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['trx'] = $this->Transaction_model->get_transaction($params,$limit,$offset)->result();

		$data['title'] = 'List Transaksi';
		$data['main'] = 'transaction/list';
		$this->load->view('templates/layout', $data);
	}

	function detail($id=null){
		$data['trx'] = $this->Transaction_model->get_transaction(['transactions.transaction_id'=>$id])->row();
		$data['detail'] = $this->Transaction_model->get_transaction_detail(['transaction_details.transaction_id'=>$id])->result();
		$data['title'] = 'Transaksi Detail';
		$data['main'] = 'transaction/detail';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */