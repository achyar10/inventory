<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {


	public function get_branch($arr=null, $limit=null, $offset=null){
		// $this->db->order_by('')
		return $this->db->get_where('branches', $arr, $limit, $offset);
	}

	function insert_branch($data){
		return $this->db->insert('branches'. $data);
	}

	function update_branch($data, $condition){
		return $this->db->update('branches', $data, $condition);
	}
	

}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */