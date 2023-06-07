<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit_model extends CI_Model
{

    public $table = "tb_penyakit";

    public function rules()
    {
        return [
            [
                'field' => 'nama_penyakit',
                'label' => 'penyakit',
                'rules' => 'required|is_unique[tb_penyakit.nama_penyakit]'
            ],
            [
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'required|is_unique[tb_penyakit.keterangan]'
            ],
        ];
    }

    public function get_data()
    {
        $this->db->select('*')->from('tb_penyakit');
        $query = $this->db->get();
        return $query;
    }

    public function penyakit_by_id($id)
    {
        $this->db->select('*')->from('tb_penyakit')->where('id_penyakit', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }


    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, ['id_penyakit' => $id]);
    }

    function delete($id)
    {
        $this->db->where('id_penyakit', $id);
        return $this->db->delete('tb_penyakit');
    }

    public function get_by_id($penyakit_id)
    {
        // Lakukan query ke database untuk mendapatkan data penyakit berdasarkan ID
        $this->db->where('id_penyakit', $penyakit_id);
        $query = $this->db->get('tb_penyakit');

        // Mengembalikan hasil query dalam bentuk objek atau array
        return $query->row();
    }
}
