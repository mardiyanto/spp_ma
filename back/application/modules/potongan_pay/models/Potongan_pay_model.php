<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potongan_pay_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get potongan_pay from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('potongan_pay_id', $params['id']);
		}

		if(isset($params['guru_guru_id']))
		{
			$this->db->where('guru_guru_id', $params['guru_guru_id']);
		}
		if (isset($params['date'])) {
			$this->db->where('potongan_pay_date', $params['date']);
		}

		if (isset($params['potongan_pay_desc'])) {
			$this->db->like('potongan_pay_desc', $params['potongan_pay_desc']);
		}

		if(isset($params['potongan_pay_input_date']))
		{
			$this->db->where('potongan_pay_input_date', $params['potongan_pay_input_date']);
		}

		if(isset($params['potongan_pay_last_update']))
		{
			$this->db->where('potongan_pay_last_update', $params['potongan_pay_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('potongan_pay_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('potongan_pay_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('potongan_pay_id', 'desc');
		}

		$this->db->select('potongan_pay_id, guru_guru_id, potongan_pay_date, potongan_pay_value, potongan_pay_desc, potongan_pay_input_date, potongan_pay_last_update');
		$this->db->select('guru_guru_id, guru_nik, guru_nama');
		$this->db->join('guru', 'guru.guru_id = potongan_pay.guru_guru_id', 'left');
	

		$res = $this->db->get('potongan_pay');

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

		if(isset($data['potongan_pay_id'])) {
			$this->db->set('potongan_pay_id', $data['potongan_pay_id']);
		}
	
		if(isset($data['potongan_pay_date'])) {
			$this->db->set('potongan_pay_date', $data['potongan_pay_date']);
		}

		if(isset($data['potongan_pay_value'])) {
			$this->db->set('potongan_pay_value', $data['potongan_pay_value']);
		}

		if(isset($data['guru_guru_id'])) {
			$this->db->set('guru_guru_id', $data['guru_guru_id']);
		}
		if(isset($data['potongan_pay_desc'])) {
			$this->db->set('potongan_pay_desc', $data['potongan_pay_desc']);
		}
		if(isset($params['guru_guru_id']))
		{
			$this->db->where('guru_guru_id', $params['guru_guru_id']);
		}
		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['potongan_pay_input_date'])) {
			$this->db->set('potongan_pay_input_date', $data['potongan_pay_input_date']);
		}

		if(isset($data['potongan_pay_last_update'])) {
			$this->db->set('potongan_pay_last_update', $data['potongan_pay_last_update']);
		}

		if (isset($data['potongan_pay_id'])) {
			$this->db->where('potongan_pay_id', $data['potongan_pay_id']);
			$this->db->update('potongan_pay');
			$id = $data['potongan_pay_id'];
		} else {
			$this->db->insert('potongan_pay');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete potongan_pay to database
	function delete($id) {
		$this->db->where('potongan_pay_id', $id);
		$this->db->delete('potongan_pay');
	}
	

}

/* End of file Potongan_pay_model.php */
/* Location: ./application/modules/jurnal/models/Potongan_pay_model.php */