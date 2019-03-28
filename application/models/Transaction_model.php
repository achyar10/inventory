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


	

}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */