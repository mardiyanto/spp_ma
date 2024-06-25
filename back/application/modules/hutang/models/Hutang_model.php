<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get hutang from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('hutang_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('hutang_date', $params['date']);
		}

		if (isset($params['hutang_desc'])) {
			$this->db->like('hutang_desc', $params['hutang_desc']);
		}

		if(isset($params['hutang_input_date']))
		{
			$this->db->where('hutang_input_date', $params['hutang_input_date']);
		}

		if(isset($params['hutang_last_update']))
		{
			$this->db->where('hutang_last_update', $params['hutang_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('hutang_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('hutang_date <=', $params['date_end'] . ' 23:59:59');
		}

		if(isset($params['limit']))
		{
			if(!isset($params['offset']))
			{
				$params['offset'] = NULL;
			}

			$this->db->limit($params['limit'], $params['offset']);
		}
		if(isset($params['order_by']))
		{
			$this->db->order_by($params['order_by'], 'desc');
		}
		else
		{
			$this->db->order_by('hutang_id', 'desc');
		}

		$this->db->select('hutang_id, hutang_date, hutang_value, hutang_bill, hutang_desc, hutang_input_date, hutang_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = hutang.user_user_id', 'left');

		$res = $this->db->get('hutang');

		if(isset($params['id']))
		{
			return $res->row_array();
		}
		else
		{
			return $res->result_array();
		}
	}

    // Add and update to database
	function add($data = array()) {

		if(isset($data['hutang_id'])) {
			$this->db->set('hutang_id', $data['hutang_id']);
		}

		if(isset($data['hutang_date'])) {
			$this->db->set('hutang_date', $data['hutang_date']);
		}

		if(isset($data['hutang_value'])) {
			$this->db->set('hutang_value', $data['hutang_value']);
		}

		if(isset($data['hutang_desc'])) {
			$this->db->set('hutang_desc', $data['hutang_desc']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['hutang_input_date'])) {
			$this->db->set('hutang_input_date', $data['hutang_input_date']);
		}

		if(isset($data['hutang_last_update'])) {
			$this->db->set('hutang_last_update', $data['hutang_last_update']);
		}

		if (isset($data['hutang_id'])) {
			$this->db->where('hutang_id', $data['hutang_id']);
			$this->db->update('hutang');
			$id = $data['hutang_id'];
		} else {
			$this->db->insert('hutang');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete hutang to database
	function delete($id) {
		$this->db->where('hutang_id', $id);
		$this->db->delete('hutang');
	}
	

}

/* End of file hutang_model.php */
/* Location: ./application/modules/jurnal/models/hutang_model.php */