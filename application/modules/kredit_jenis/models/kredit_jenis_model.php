<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kredit_jenis_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get kredit_jenis from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('kredit_jenis_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('kredit_jenis_date', $params['date']);
		}

		if (isset($params['kredit_jenis_desc'])) {
			$this->db->like('kredit_jenis_desc', $params['kredit_jenis_desc']);
		}

		if(isset($params['kredit_jenis_last_update']))
		{
			$this->db->where('kredit_jenis_last_update', $params['kredit_jenis_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('kredit_jenis_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('kredit_jenis_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('kredit_jenis_id', 'desc');
		}

		$this->db->select('kredit_jenis_id, kredit_jenis_date, kredit_jenis_desc, kredit_jenis_last_update');
		$res = $this->db->get('kredit_jenis');

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

		if(isset($data['kredit_jenis_id'])) {
			$this->db->set('kredit_jenis_id', $data['kredit_jenis_id']);
		}

		if(isset($data['kredit_jenis_date'])) {
			$this->db->set('kredit_jenis_date', $data['kredit_jenis_date']);
		}
	
		if(isset($data['kredit_jenis_desc'])) {
			$this->db->set('kredit_jenis_desc', $data['kredit_jenis_desc']);
		}

		if(isset($data['kredit_jenis_last_update'])) {
			$this->db->set('kredit_jenis_last_update', $data['kredit_jenis_last_update']);
		}

		if (isset($data['kredit_jenis_id'])) {
			$this->db->where('kredit_jenis_id', $data['kredit_jenis_id']);
			$this->db->update('kredit_jenis');
			$id = $data['kredit_jenis_id'];
		} else {
			$this->db->insert('kredit_jenis');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete kredit_jenis to database
	function delete($id) {
		$this->db->where('kredit_jenis_id', $id);
		$this->db->delete('kredit_jenis');
	}
	

}

/* End of file kredit_jenis_jenis_model.php */
/* Location: ./application/modules/jurnal/models/kredit_jenis_jenis_model.php */