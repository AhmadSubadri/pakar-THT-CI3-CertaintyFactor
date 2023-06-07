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

    public function get_data_by_id($gejala_ids)
    {
        $this->db->where_in('id_gejala', explode(',', $gejala_ids));
        $query = $this->db->get('tb_gejala');
        return $query;
    }

    public function get_gejala_name($id_gejala)
    {
        $this->db->select('nama_gejala');
        $this->db->where('id_gejala', $id_gejala);
        $query = $this->db->get('tb_gejala');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->nama_gejala;
        }

        return false;
    }
}
