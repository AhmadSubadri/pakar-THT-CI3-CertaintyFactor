<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public $table = "tb_admin";

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            ]
        ];
    }

    public function get_data()
    {
        $this->db->select('*')->from('tb_admin');
        $query = $this->db->get();
        return $query;
    }

    public function admin_by_id($id)
    {
        $this->db->select('*')->from('tb_admin')->where('id_admin', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, ['id_admin' => $id]);
    }

    public function delete($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->delete('tb_admin');
    }
}
