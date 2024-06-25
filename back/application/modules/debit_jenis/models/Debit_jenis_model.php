<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debit_jenis_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get debit_jenis from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('debit_jenis_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('debit_jenis_date', $params['date']);
		}

		if (isset($params['debit_jenis_desc'])) {
			$this->db->like('debit_jenis_desc', $params['debit_jenis_desc']);
		}

		if(isset($params['debit_jenis_last_update']))
		{
			$this->db->where('debit_jenis_last_update', $params['debit_jenis_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('debit_jenis_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('debit_jenis_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('debit_jenis_id', 'desc');
		}

		$this->db->select('debit_jenis_id, debit_jenis_date, debit_jenis_desc, debit_jenis_last_update');
		$res = $this->db->get('debit_jenis');

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

		if(isset($data['debit_jenis_id'])) {
			$this->db->set('debit_jenis_id', $data['debit_jenis_id']);
		}

		if(isset($data['debit_jenis_date'])) {
			$this->db->set('debit_jenis_date', $data['debit_jenis_date']);
		}
	
		if(isset($data['debit_jenis_desc'])) {
			$this->db->set('debit_jenis_desc', $data['debit_jenis_desc']);
		}

		if(isset($data['debit_jenis_last_update'])) {
			$this->db->set('debit_jenis_last_update', $data['debit_jenis_last_update']);
		}

		if (isset($data['debit_jenis_id'])) {
			$this->db->where('debit_jenis_id', $data['debit_jenis_id']);
			$this->db->update('debit_jenis');
			$id = $data['debit_jenis_id'];
		} else {
			$this->db->insert('debit_jenis');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete debit_jenis to database
	function delete($id) {
		$this->db->where('debit_jenis_id', $id);
		$this->db->delete('debit_jenis');
	}
	

}

/* End of file debit_jenis_jenis_model.php */
/* Location: ./application/modules/jurnal/models/debit_jenis_jenis_model.php */