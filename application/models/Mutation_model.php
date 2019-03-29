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

	function get_report_mutation($params = array()){
		if (isset($params['branch_id'])) {
			$this->db->where('mutations.branch_id', $params['branch_id']);
		}
		if(isset($params['date_start']) AND isset($params['date_end'])){
			$this->db->where('mutation_created_at >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('mutation_created_at <=', $params['date_end'] . ' 23:59:59');
		}

		$this->db->join('mutations', 'mutations.mutation_id = mutation_details.mutation_id', 'left');
		$this->db->join('branches', 'branches.branch_id = mutations.branch_id', 'left');
		$this->db->join('items', 'items.item_id = mutation_details.item_id', 'left');
		$this->db->join('users', 'users.user_id = mutations.user_id', 'left');
		$res = $this->db->get('mutation_details');

		if(isset($params['id'])){
			return $res->row_array();
		} else {
			return $res->result_array();
		}
	}

	

}

/* End of file Mutation_model.php */
/* Location: ./application/models/Mutation_model.php */