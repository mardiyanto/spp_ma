<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_pay_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get gaji_pay from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('gaji_pay_id', $params['id']);
		}
		if(isset($params['gaji_gaji_id']))
		{
			$this->db->where('gaji_gaji_id', $params['gaji_gaji_id']);
		}
		if(isset($params['guru_guru_id']))
		{
			$this->db->where('guru_guru_id', $params['guru_guru_id']);
		}
		if (isset($params['date'])) {
			$this->db->where('gaji_pay_date', $params['date']);
		}

		if (isset($params['gaji_pay_desc'])) {
			$this->db->like('gaji_pay_desc', $params['gaji_pay_desc']);
		}

		if(isset($params['gaji_pay_input_date']))
		{
			$this->db->where('gaji_pay_input_date', $params['gaji_pay_input_date']);
		}

		if(isset($params['gaji_pay_last_update']))
		{
			$this->db->where('gaji_pay_last_update', $params['gaji_pay_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('gaji_pay_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('gaji_pay_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('gaji_pay_id', 'desc');
		}

		$this->db->select('gaji_pay_id, gaji_gaji_id, guru_guru_id, gaji_pay_date, gaji_pay_value, gaji_pay_desc, gaji_pay_input_date, gaji_pay_last_update');
		$this->db->select('gaji_gaji_id, gaji_desc, gaji_value,gaji_jenis');
		$this->db->select('guru_guru_id, guru_nik, guru_nama');
		$this->db->join('gaji', 'gaji.gaji_id = gaji_pay.gaji_gaji_id', 'left');
		$this->db->join('guru', 'guru.guru_id = gaji_pay.guru_guru_id', 'left');
	

		$res = $this->db->get('gaji_pay');

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

		if(isset($data['gaji_pay_id'])) {
			$this->db->set('gaji_pay_id', $data['gaji_pay_id']);
		}
		if(isset($data['gaji_gaji_id'])) {
			$this->db->set('gaji_gaji_id', $data['gaji_gaji_id']);
		}
	
		if(isset($data['gaji_pay_date'])) {
			$this->db->set('gaji_pay_date', $data['gaji_pay_date']);
		}

		if(isset($data['gaji_pay_value'])) {
			$this->db->set('gaji_pay_value', $data['gaji_pay_value']);
		}

		if(isset($data['guru_guru_id'])) {
			$this->db->set('guru_guru_id', $data['guru_guru_id']);
		}
		if(isset($data['gaji_pay_desc'])) {
			$this->db->set('gaji_pay_desc', $data['gaji_pay_desc']);
		}
		if(isset($params['guru_guru_id']))
		{
			$this->db->where('guru_guru_id', $params['guru_guru_id']);
		}
		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['gaji_pay_input_date'])) {
			$this->db->set('gaji_pay_input_date', $data['gaji_pay_input_date']);
		}

		if(isset($data['gaji_pay_last_update'])) {
			$this->db->set('gaji_pay_last_update', $data['gaji_pay_last_update']);
		}

		if (isset($data['gaji_pay_id'])) {
			$this->db->where('gaji_pay_id', $data['gaji_pay_id']);
			$this->db->update('gaji_pay');
			$id = $data['gaji_pay_id'];
		} else {
			$this->db->insert('gaji_pay');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete gaji_pay to database
	function delete($id) {
		$this->db->where('gaji_pay_id', $id);
		$this->db->delete('gaji_pay');
	}
	

}

/* End of file Gaji_pay_model.php */
/* Location: ./application/modules/jurnal/models/Gaji_pay_model.php */