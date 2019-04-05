<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function get_order($arr=null, $limit=null, $offset=null){
		$this->db->join('distributors', 'distributors.distributor_id = orders.distributor_id', 'left');
		$this->db->join('users', 'users.user_id = orders.user_id', 'left');
		return $this->db->get_where('orders', $arr, $limit, $offset);
	}

	public function get_order_detail($arr=null, $limit=null, $offset=null){
		$this->db->join('items', 'items.item_id = order_details.item_id', 'left');
		$this->db->join('orders', 'orders.order_id = order_details.order_id', 'left');
		return $this->db->get_where('order_details', $arr, $limit, $offset);
	}

	function insert_order($data){
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}

	function update_order($data, $condition){
		return $this->db->update('orders', $data, $condition);
	}

	function get_report_order($params = array()){
		if(isset($params['date_start']) AND isset($params['date_end'])){
			$this->db->where('order_created_at >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('order_created_at <=', $params['date_end'] . ' 23:59:59');
		}

		$this->db->join('orders', 'orders.order_id = order_details.order_id', 'left');
		$this->db->join('items', 'items.item_id = order_details.item_id', 'left');
		$this->db->join('users', 'users.user_id = orders.user_id', 'left');
		$res = $this->db->get('order_details');

		if(isset($params['id'])){
			return $res->row_array();
		} else {
			return $res->result_array();
		}
	}
	

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */