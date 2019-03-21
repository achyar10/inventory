<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	public function get_stock($arr=null, $limit=null, $offset=null){
		return $this->db->get_where('stocks', $arr, $limit, $offset);
	}

	function insert_stock($data){
		$this->db->insert('stocks', $data);
		return $this->db->insert_id();
	}

	function update_stock_batch($item_id=array(),$qty=array(),$operator='+'){
		if(count($item_id) > 0){
			$sql = "UPDATE `items` SET `item_stock` = CASE ";

			for($i=0; $i<=count($item_id)-1; $i++){
				$sql .= " WHEN `item_id` = {$item_id[$i]} THEN item_stock {$operator} {$qty[$i]} ";
			}

			$sql .= " ELSE `item_stock` END
			WHERE `item_id` IN(".implode(',', $item_id).")
			";

			return $this->db->query($sql);
		}else{
			return false;
		}
	}

	

	

}

/* End of file Stock_model.php */
/* Location: ./application/models/Stock_model.php */