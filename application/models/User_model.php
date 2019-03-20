<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_user($arr=null, $limit=null, $offset=null){
		$this->db->join('branches', 'branches.branch_id = users.branch_id', 'left');
		return $this->db->get_where('users', $arr, $limit, $offset);
	}

	function insert_user($data){
		return $this->db->insert('users', $data);
	}

	function update_user($data, $condition){
		return $this->db->update('users', $data, $condition);
	}

	

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */