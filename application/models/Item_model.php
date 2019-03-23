<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

	public function get_item($arr=null, $limit=null, $offset=null){
		// $this->db->order_by('')
		$this->db->join('branches', 'branches.branch_id = items.branch_id', 'left');
		$this->db->join('distributors', 'distributors.distributor_id = items.distributor_id', 'left');
		return $this->db->get_where('items', $arr, $limit, $offset);
	}

	function insert_item($data){
		$this->db->insert('items', $data);
		return $this->db->insert_id();
	}

	function update_item($data, $condition){
		return $this->db->update('items', $data, $condition);
	}

	

}

/* End of file Item_model.php */
/* Location: ./application/models/Item_model.php */