<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pos_joinmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    // Get pos from database
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('pos_id', $params['id']);
        }

        if(isset($params['pos_name']))
        {
            $this->db->like('pos_name', $params['pos_name']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('pos_id', 'desc');
        }
        $this->db->select('*');
        $this->db->from('pos');
        $this->db->join('payment', 'pos.pos_id = payment.pos_pos_id', 'left');
        $this->db->join('bebas', 'payment.payment_id = bebas.payment_payment_id', 'left');
        $this->db->join('bebas_pay', 'bebas.bebas_id = bebas_pay.bebas_bebas_id', 'left');
        $this->db->join('bulan', 'payment.payment_id = bulan.payment_payment_id', 'left');
        $this->db->join('bulan_pay', 'bulan.bulan_id = bulan_pay.bulan_bulan_id', 'left');
        $res = $this->db->get();

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }
    
}
