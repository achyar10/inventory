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

	function update_stock_batch($item_branch_id=array(),$qty=array(),$operator='+'){
		if(count($item_branch_id) > 0){
			$sql = "UPDATE `item_branch` SET `item_branch_stock` = CASE ";

			for($i=0; $i<=count($item_branch_id)-1; $i++){
				$sql .= " WHEN `item_branch_id` = {$item_branch_id[$i]} THEN item_branch_stock {$operator} {$qty[$i]} ";
			}

			$sql .= " ELSE `item_branch_stock` END
			WHERE `item_branch_id` IN(".implode(',', $item_branch_id).")
			";

			return $this->db->query($sql);
		}else{
			return false;
		}
	}
	

}

/* End of file Item_branch_model.php */
/* Location: ./application/models/Item_branch_model.php */