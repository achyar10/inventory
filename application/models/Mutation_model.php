<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutation_model extends CI_Model {

	public function get_mutation($arr=null, $limit=null, $offset=null){
		$this->db->join('branches', 'branches.branch_id = mutations.branch_id', 'left');
		$this->db->join('users', 'users.user_id = mutations.user_id', 'left');
		return $this->db->get_where('mutations', $arr, $limit, $offset);
	}

	public function get_mutation_detail($arr=null, $limit=null, $offset=null){
		$this->db->join('items', 'items.item_id = mutation_details.item_id', 'left');
		$this->db->join('mutations', 'mutations.mutation_id = mutation_details.mutation_id', 'left');
		return $this->db->get_where('mutation_details', $arr, $limit, $offset);
	}

	function insert_mutation($data){
		$this->db->insert('mutations', $data);
		return $this->db->insert_id();
	}

	function update_mutation($data, $condition){
		return $this->db->update('mutations', $data, $condition);
	}

	

}

/* End of file Mutation_model.php */
/* Location: ./application/models/Mutation_model.php */