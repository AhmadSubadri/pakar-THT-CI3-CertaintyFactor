<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gejala_model extends CI_Model
{

    public $table = "tb_gejala";

    public function rules()
    {
        return [
            [
                'field' => 'nama_gejala',
                'label' => 'gejala',
                'rules' => 'required|is_unique[tb_gejala.nama_gejala]'
            ],
        ];
    }

    public function get_data()
    {
        $this->db->select('*')->from('tb_gejala');
        $query = $this->db->get();
        return $query;
    }

    public function gejala_by_id($id)
    {
        $this->db->select('*')->from('tb_gejala')->where('id_gejala', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }


    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, ['id_gejala' => $id]);
    }

    function delete($id)
    {
        $this->db->where('id_gejala', $id);
        return $this->db->delete('tb_gejala');
    }
}
