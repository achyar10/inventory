<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_branch_model extends CI_Model {

	function get_item($arr=null, $limit=null, $offset=null){
		return get_where('item_branch', $arr, $limit, $offset);
	}

	function insert_item_branch($data){
		return $this->db->insert_batch('item_branch', $data);
	}
	

}

/* End of file Item_branch_model.php */
/* Location: ./application/models/Item_branch_model.php */