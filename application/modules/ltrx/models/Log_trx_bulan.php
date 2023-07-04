<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_trx_bulan extends CI_Model {

	function __construct() {
        parent::__construct();
    }

        // Insert some data to table
    function add($data = array()) {

        if (isset($data['log_trx_id'])) {
            $this->db->set('log_trx_id', $data['log_trx_id']);
        }

        if (isset($data['bulan_bulan_id'])) {
            $this->db->set('bulan_bulan_id', $data['bulan_bulan_id']);
        }

        if (isset($data['bebas_pay_bebas_pay_id'])) {
            $this->db->set('bebas_pay_bebas_pay_id', $data['bebas_pay_bebas_pay_id']);
        }

        if (isset($data['student_student_id'])) {
            $this->db->set('student_student_id', $data['student_student_id']);
        }

        if (isset($data['log_trx_input_date'])) {
            $this->db->set('log_trx_input_date', $data['log_trx_input_date']);
        }

        if (isset($data['log_trx_last_update'])) {
            $this->db->set('log_trx_last_update', $data['log_trx_last_update']);
        }


        if (isset($data['log_trx_id'])) {
            $this->db->where('log_trx_id', $data['log_trx_id']);
            $this->db->update('log_trx');
            $id = $data['log_trx_id'];
        } else {
            $this->db->insert('log_trx');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

      // Delete log_trx to database
    function delete($id) {
        $this->db->where('log_trx_id', $id);
        $this->db->delete('log_trx');
    }

      // Delete log_trx to database
    function delete_log($params = array()) {
        
        if (isset($params['bulan_id'])) {
            $this->db->where('bulan_bulan_id', $params['bulan_id']);
        }

        if (isset($params['bebas_pay_id'])) {
            $this->db->where('bebas_pay_bebas_pay_id', $params['bebas_pay_id']);
        }

        if (isset($params['student_id'])) {
            $this->db->where('log_trx.student_student_id', $params['student_id']);
        }

        $this->db->delete('log_trx');
    }

}

/* End of file Log_trx_model.php */
/* Location: ./application/modules/ltrx/models/Log_trx_model.php */