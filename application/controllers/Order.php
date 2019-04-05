<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged')) redirect('auth/login');
		$this->load->model('Order_model');
		$this->load->model('Item_model');
		$this->load->model('Stock_model');
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
		$config['base_url'] = site_url('order');
		$config['per_page'] = $limit;
		$config['total_rows'] = $this->Order_model->get_order()->num_rows();
		$this->pagination->initialize($config);

		$data['jlhpage']= $page;
		$data['order'] = $this->Order_model->get_order(null,$limit,$offset)->result();
		$data['item'] = $this->Item_model->get_item()->result_array();
		$data['dist'] = $this->Distributor_model->get_distributor()->result();

		$data['title'] = 'Pemesanan Barang';
		$data['main'] = 'order/index';
		$this->load->view('templates/layout', $data);
	}

	function add(){
		$this->db->trans_start();

		$lastno = $this->Order_model->get_order(null,1)->row_array();

		if (date('Y', strtotime($lastno['order_created_at'])) < date('Y') OR (count($lastno)) == 0) {
			$nomor = sprintf('%04d', '0001');
			$no_trx = $nomor .'/PO-'. date('Ym');
		} else {
			$no = substr($lastno['order_no_trx'], 0, 4);
			$nomor = sprintf('%04d', $no + 0001);
			$no_trx = $nomor .'/PO-'. date('Ym');
		}

		$params['order_no_trx'] = $no_trx;
		$params['distributor_id'] = $this->input->post('distributor_id');
		$params['user_id'] = $this->session->userdata('user_id');
		$id_order = $this->Order_model->insert_order($params);

		// mutasi detail
		$order_detail = array();
		$item_branch = array();
		$qty = $this->input->post('qty');
		$item = $this->input->post('item_id');
		for ($i = 0; $i < count($qty); $i++) {
			if($qty[$i] > 0){
				array_push($order_detail, [
					'order_id' => $id_order,
					'item_id' => $item[$i],
					'qty' => $qty[$i],
				]);
			}
		}
		if(!empty($order_detail)){

			$this->db->insert_batch('order_details', $order_detail);
			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('failed','Data not saved.');
				redirect('order');
			} else {
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Data saved.');
				redirect('order');
			} 
		}else{
			$this->session->set_flashdata('failed','Quantity tidak boleh 0 semua');
			redirect('order');
		}
	}

	function detail($id=null){

		$data['order'] = $this->Order_model->get_order(['order_id'=>$id])->row();
		$data['detail'] = $this->Order_model->get_order_detail(['order_details.order_id'=>$id])->result();
		$data['title'] = 'Pemesanan Detail';
		$data['main'] = 'order/detail';
		$this->load->view('templates/layout', $data);
	}

	function printPO($id=null){
		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$data['order'] = $this->Order_model->get_order(['orders.order_id'=>$id])->row();
		$data['detail'] = $this->Order_model->get_order_detail(['order_details.order_id'=>$id])->result();
		$fileName = $data['order']->order_no_trx;
		$data['title'] = $fileName;
		$html = $this->load->view('order/order_po', $data, TRUE);
		$mpdf->WriteHTML(utf8_encode($html));
		$mpdf->Output($fileName. ".pdf", 'I');

	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */