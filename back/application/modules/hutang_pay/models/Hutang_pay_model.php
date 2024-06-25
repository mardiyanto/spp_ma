<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang_pay_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get hutang_pay from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('hutang_pay_id', $params['id']);
		}
		if(isset($params['hutang_hutang_id']))
		{
			$this->db->where('hutang_hutang_id', $params['hutang_hutang_id']);
		}

		if (isset($params['date'])) {
			$this->db->where('hutang_pay_date', $params['date']);
		}

		if (isset($params['hutang_pay_desc'])) {
			$this->db->like('hutang_pay_desc', $params['hutang_pay_desc']);
		}

		if(isset($params['hutang_pay_input_date']))
		{
			$this->db->where('hutang_pay_input_date', $params['hutang_pay_input_date']);
		}

		if(isset($params['hutang_pay_last_update']))
		{
			$this->db->where('hutang_pay_last_update', $params['hutang_pay_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('hutang_pay_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('hutang_pay_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('hutang_pay_id', 'desc');
		}

		$this->db->select('hutang_pay_id, hutang_hutang_id,, hutang_pay_date, hutang_pay_value, hutang_pay_desc, hutang_pay_input_date, hutang_pay_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = hutang_pay.user_user_id', 'left');

		$res = $this->db->get('hutang_pay');

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

		if(isset($data['hutang_pay_id'])) {
			$this->db->set('hutang_pay_id', $data['hutang_pay_id']);
		}
		if(isset($data['hutang_hutang_id'])) {
			$this->db->set('hutang_hutang_id', $data['hutang_hutang_id']);
		}
		if(isset($data['hutang_pay_date'])) {
			$this->db->set('hutang_pay_date', $data['hutang_pay_date']);
		}

		if(isset($data['hutang_pay_value'])) {
			$this->db->set('hutang_pay_value', $data['hutang_pay_value']);
		}

		if(isset($data['hutang_pay_desc'])) {
			$this->db->set('hutang_pay_desc', $data['hutang_pay_desc']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['hutang_pay_input_date'])) {
			$this->db->set('hutang_pay_input_date', $data['hutang_pay_input_date']);
		}

		if(isset($data['hutang_pay_last_update'])) {
			$this->db->set('hutang_pay_last_update', $data['hutang_pay_last_update']);
		}

		if (isset($data['hutang_pay_id'])) {
			$this->db->where('hutang_pay_id', $data['hutang_pay_id']);
			$this->db->update('hutang_pay');
			$id = $data['hutang_pay_id'];
		} else {
			$this->db->insert('hutang_pay');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete hutang_pay to database
	function delete($id) {
		$this->db->where('hutang_pay_id', $id);
		$this->db->delete('hutang_pay');
	}
	

}

/* End of file hutang_pay_model.php */
/* Location: ./application/modules/jurnal/models/hutang_pay_model.php */