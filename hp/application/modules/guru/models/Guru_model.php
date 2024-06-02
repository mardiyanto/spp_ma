<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get guru from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('guru_id', $params['id']);
		}

		if (isset($params['guru_nik'])) {
			$this->db->where('guru_nik', $params['guru_nik']);
		}

		if (isset($params['guru_nuptk'])) {
			$this->db->like('guru_nuptk', $params['guru_nuptk']);
		}

		if(isset($params['guru_nama']))
		{
			$this->db->where('guru_nama', $params['guru_nama']);
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
			$this->db->order_by('guru_id', 'desc');
		}

		$this->db->select('guru_id, guru_nik, guru_nuptk, guru_nama');
		$res = $this->db->get('guru');

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

		if(isset($data['guru_id'])) {
			$this->db->set('guru_id', $data['guru_id']);
		}

		if(isset($data['guru_nik'])) {
			$this->db->set('guru_nik', $data['guru_nik']);
		}

		if(isset($data['guru_nuptk'])) {
			$this->db->set('guru_nuptk', $data['guru_nuptk']);
		}

		if(isset($data['guru_nama'])) {
			$this->db->set('guru_nama', $data['guru_nama']);
		}

		if (isset($data['guru_id'])) {
			$this->db->where('guru_id', $data['guru_id']);
			$this->db->update('guru');
			$id = $data['guru_id'];
		} else {
			$this->db->insert('guru');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete guru to database
	function delete($id) {
		$this->db->where('guru_id', $id);
		$this->db->delete('guru');
	}
	

}

/* End of file Guru_model.php */
/* Location: ./application/modules/jurnal/models/Guru_model.php */