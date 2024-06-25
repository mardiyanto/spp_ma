<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Model
{

    function simpan($table, $data)
    {
        return  $this->db->insert($table, $data);
    }

    function update($table, $where, $data)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function hapus($table, $where)
    {
        $this->db->where($where);
        $x = $this->db->delete($table);
        return $x;
    }
}

/* End of file: Crud.php */
