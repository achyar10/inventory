<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor_model extends CI_Model {

	public function get_distributor($arr=null, $limit=null, $offset=null){
		// $this->db->order_by('')
		return $this->db->get_where('distributors', $arr, $limit, $offset);
	}

	function insert_distributor($data){
		return $this->db->insert('distributors', $data);
	}

	function update_distributor($data, $condition){
		return $this->db->update('distributors', $data, $condition);
	}

}

/* End of file Distributor_model.php */
/* Location: ./application/models/Distributor_model.php */