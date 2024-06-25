<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Bulan_pay_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if (isset($params['id'])) {
            $this->db->where('bulan_pay.bulan_pay_id', $params['id']);
        }

        if (isset($params['student_id'])) {
            $this->db->where('bulan.student_student_id', $params['student_id']);
        }

        if (isset($params['student_nis'])) {
            $this->db->where('student.student_nis', $params['student_nis']);
        }

        if (isset($params['date'])) {
            $this->db->where('bulan_pay_input_date', $params['date']);
        }

        if (isset($params['payment_id'])) {
            $this->db->where('bulan.payment_payment_id', $params['payment_id']);
        }

        if (isset($params['bulan_id'])) {
            $this->db->where('bulan_pay.bulan_bulan_id', $params['bulan_id']);
        }

        if (isset($params['class_id'])) {
            $this->db->where('student.class_class_id', $params['class_id']);
        }

        if (isset($params['bulan_pay_input_date'])) {
            $this->db->where('bulan_pay_input_date', $params['bulan_pay_input_date']);
        }

        if (isset($params['bulan_pay_last_update'])) {
            $this->db->where('bulan_pay_last_update', $params['bulan_pay_last_update']);
        }

        if (isset($params['date_start']) and isset($params['date_end'])) {
            $this->db->where('bulan_pay_input_date >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('bulan_pay_input_date <=', $params['date_end'] . ' 23:59:59');
        }

        if (isset($params['date'])) {
            $this->db->where('bulan_pay_input_date', $params['date']);
        }

        if (isset($params['group'])) {

            $this->db->group_by('bulan_pay.bulan_bulan_id');
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('bulan_pay_last_update', 'asc');
        }

        $this->db->select('bulan_pay.bulan_pay_id, bulan_pay_bill, bulan_pay_number, keterangan, bulan_pay_input_date, bulan_pay_last_update');
        $this->db->select('bulan_pay.bulan_bulan_id, bulan_pay_bill, keterangan');
        $this->db->select('bulan_bulan_id, bulan_bill, bulan_bill_total');
        $this->db->select('student_student_id, student_nis, student.class_class_id, class_name, student_full_name, student_name_of_mother, student_parent_phone');
        $this->db->select('payment_payment_id, payment_type, period_start, period_end, payment.pos_pos_id, pos_name');
        $this->db->select('month_month_id, month_name');
        $this->db->join('bulan', 'bulan.bulan_id = bulan_pay.bulan_bulan_id', 'left');
        $this->db->join('month', 'month.month_id = bulan.month_month_id', 'left');
        $this->db->join('student', 'student.student_id = bulan.student_student_id', 'left');
        $this->db->join('payment', 'payment.payment_id = bulan.payment_payment_id', 'left');
        $this->db->join('period', 'period.period_id = payment.period_period_id', 'left');
        $this->db->join('pos', 'pos.pos_id = payment.pos_pos_id', 'left');
        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
       

        $res = $this->db->get('bulan_pay');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    // Add and update to database
    function add($data = array())
    {

        if (isset($data['bulan_pay_id'])) {
            $this->db->set('bulan_pay_id', $data['bulan_pay_id']);
        }

        if (isset($data['bulan_id'])) {
            $this->db->set('bulan_bulan_id', $data['bulan_id']);
        }

        if (isset($data['bulan_pay_bill'])) {
            $this->db->set('bulan_pay_bill', $data['bulan_pay_bill']);
        }

        if (isset($data['bulan_pay_number'])) {
            $this->db->set('bulan_pay_number', $data['bulan_pay_number']);
        }

        if (isset($data['keterangan'])) {
            $this->db->set('keterangan', $data['keterangan']);
        }

        if (isset($data['user_user_id'])) {
            $this->db->set('user_user_id', $data['user_user_id']);
        }

        if (isset($data['bulan_pay_input_date'])) {
            $this->db->set('bulan_pay_input_date', $data['bulan_pay_input_date']);
        }

        if (isset($data['bulan_pay_last_update'])) {
            $this->db->set('bulan_pay_last_update', $data['bulan_pay_last_update']);
        }

        if (isset($data['bulan_pay_id'])) {
            $this->db->where('bulan_pay_id', $data['bulan_pay_id']);
            $this->db->update('bulan_pay');
            $id = $data['bulan_pay_id'];
        } else {
            $this->db->insert('bulan_pay');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }


    // Delete to database
    function delete($id)
    {
        $this->db->where('bulan_pay_id', $id);
        $this->db->delete('bulan_pay');
    }
}
