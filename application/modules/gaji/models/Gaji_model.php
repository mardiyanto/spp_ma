<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get gaji from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('gaji_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('gaji_date', $params['date']);
		}

		if (isset($params['gaji_desc'])) {
			$this->db->like('gaji_desc', $params['gaji_desc']);
		}

		if(isset($params['gaji_input_date']))
		{
			$this->db->where('gaji_input_date', $params['gaji_input_date']);
		}

		if(isset($params['gaji_last_update']))
		{
			$this->db->where('gaji_last_update', $params['gaji_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('gaji_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('gaji_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('gaji_id', 'desc');
		}

		$this->db->select('gaji_id, gaji_date, gaji_value, gaji_bill, gaji_desc, gaji_jenis, gaji_input_date, gaji_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = gaji.user_user_id', 'left');

		$res = $this->db->get('gaji');

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

		if(isset($data['gaji_id'])) {
			$this->db->set('gaji_id', $data['gaji_id']);
		}

		if(isset($data['gaji_date'])) {
			$this->db->set('gaji_date', $data['gaji_date']);
		}

		if(isset($data['gaji_value'])) {
			$this->db->set('gaji_value', $data['gaji_value']);
		}

		if(isset($data['gaji_desc'])) {
			$this->db->set('gaji_desc', $data['gaji_desc']);
		}
		if(isset($data['gaji_jenis'])) {
			$this->db->set('gaji_jenis', $data['gaji_jenis']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['gaji_input_date'])) {
			$this->db->set('gaji_input_date', $data['gaji_input_date']);
		}

		if(isset($data['gaji_last_update'])) {
			$this->db->set('gaji_last_update', $data['gaji_last_update']);
		}

		if (isset($data['gaji_id'])) {
			$this->db->where('gaji_id', $data['gaji_id']);
			$this->db->update('gaji');
			$id = $data['gaji_id'];
		} else {
			$this->db->insert('gaji');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete gaji to database
	function delete($id) {
		$this->db->where('gaji_id', $id);
		$this->db->delete('gaji');
	}
	

}

/* End of file Gaji_model.php */
/* Location: ./application/modules/jurnal/models/Gaji_model.php */