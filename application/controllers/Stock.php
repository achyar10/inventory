<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Stock_model');
		$this->load->model('Item_model');
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
		$config['base_url'] = site_url('stock');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Stock_model->get_stock()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['stock'] = $this->Stock_model->get_stock(null,$limit,$offset)->result();
		$data['item'] = $this->Item_model->get_item()->result_array();

		$data['title'] = 'Stok';
		$data['main'] = 'stock/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){

		$this->db->trans_start();

		$lastno = $this->Stock_model->get_stock(null,1)->row_array();

		if (date('Y', strtotime($lastno['stock_created_at'])) < date('Y') OR (count($lastno)) == 0) {
			$nomor = sprintf('%04d', '0001');
			$no_trx = $nomor .'/ST-'. date('Ym');
		} else {
			$no = substr($lastno['stock_no_trx'], 0, 4);
			$nomor = sprintf('%04d', $no + 0001);
			$no_trx = $nomor .'/ST-'. date('Ym');
		}

		$params['stock_no_trx'] = $no_trx;
		$params['user_id'] = $this->session->userdata('user_id');
		$id_stock = $this->Stock_model->insert_stock($params);

		// stock detail
		$stock_detail = array();
		$qty = $this->input->post('qty');
		$item = $this->input->post('item_id');
		for ($i = 0; $i < count($qty); $i++) {
			if($qty[$i] > 0){
				array_push($stock_detail, [
					'stock_id' => $id_stock,
					'item_id' => $item[$i],
					'qty' => $qty[$i],
				]);
			}
		}
		if(!empty($stock_detail)){

		$this->db->insert_batch('stock_details', $stock_detail);
		$this->Stock_model->update_stock_batch($item, $qty, '+');

		$this->db->trans_complete();

			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('failed','Data not saved.');
				redirect('stock');
			} else {
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Data saved.');
				redirect('stock');
			} 
		}else{
			$this->session->set_flashdata('failed','Quantity tidak boleh 0 semua');
			redirect('stock');
		}
	}

	public function getItem(){
		$item_id = $this->input->post('item_id');

		$res = $this->Item_model->get_item(array('items.item_id'=>$item_id))->row_array();
		if(count($res)==0){
			$result = json_encode(array(
				'item_id' => ''
			));
			exit($result);
		}

		$result = json_encode(array(
				'item_id' => $res['item_id'],
				'item_stock' => $res['item_stock']
			));
		exit($result);
	}

	function detail($id=null){

		$data['stock'] = $this->Stock_model->get_stock(['stock_id'=>$id])->row();
		$data['detail'] = $this->Stock_model->get_stock_detail(['stock_details.stock_id'=>$id])->result();
		$data['title'] = 'Stok Detail';
		$data['main'] = 'stock/detail';
		$this->load->view('templates/layout', $data);
	}

}

/* End of file Stock.php */
/* Location: ./application/controllers/Stock.php */