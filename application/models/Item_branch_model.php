<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_branch_model extends CI_Model {

	function get_item_branch($arr=null, $limit=null, $offset=null){
		$this->db->join('branches', 'branches.branch_id = item_branch.branch_id', 'left');
		$this->db->join('items', 'items.item_id = item_branch.item_id', 'left');
		$this->db->join('distributors', 'distributors.distributor_id = items.distributor_id', 'left');
		return $this->db->get_where('item_branch', $arr, $limit, $offset);
	}

	

	function insert_item_branch($data){
		return $this->db->insert_batch('item_branch', $data);
	}
	

}

/* End of file Item_branch_model.php */
/* Location: ./application/models/Item_branch_model.php */