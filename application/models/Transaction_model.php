<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function get_transaction($arr=null, $limit=null, $offset=null){
		$this->db->order_by('transaction_id', 'desc');
		$this->db->join('users', 'users.user_id = transactions.user_id', 'left');
		return $this->db->get_where('transactions', $arr, $limit, $offset);
	}

	public function get_transaction_detail($arr=null, $limit=null, $offset=null){
		$this->db->join('transactions', 'transactions.transaction_id = transaction_details.transaction_id', 'left');
		$this->db->join('item_branch', 'item_branch.item_branch_id = transaction_details.item_branch_id', 'left');
		$this->db->join('items', 'items.item_id = item_branch.item_id', 'left');
		return $this->db->get_where('transaction_details', $arr, $limit, $offset);
	}

	function insert_transaction($data){
		$this->db->insert('transactions', $data);
		return $this->db->insert_id();
	}

	function get_report_trans($params = array()){
		if (isset($params['branch_id'])) {
			$this->db->where('transactions.branch_id', $params['branch_id']);
		}
		if(isset($params['date_start']) AND isset($params['date_end'])){
			$this->db->where('transaction_created_at >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('transaction_created_at <=', $params['date_end'] . ' 23:59:59');
		}

		$this->db->join('transactions', 'transactions.transaction_id = transaction_details.transaction_id', 'left');
		$this->db->join('branches', 'branches.branch_id = transactions.branch_id', 'left');
		$this->db->join('item_branch', 'item_branch.item_branch_id = transaction_details.item_branch_id', 'left');
		$this->db->join('items', 'items.item_id = item_branch.item_id', 'left');
		$this->db->join('users', 'users.user_id = transactions.user_id', 'left');
		$res = $this->db->get('transaction_details');

		if(isset($params['id'])){
			return $res->row_array();
		} else {
			return $res->result_array();
		}
	}


	

}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */