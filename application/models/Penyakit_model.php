<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit_model extends CI_Model
{

    public $table = "tb_penyakit";

    public function rules()
    {
        return [
            [
                'field' => 'kode_penyakit',
                'label' => 'Kode Penyakti',
                'rules' => 'required|is_unique[tb_penyakit.kode_penyakit]'
            ],
            [
                'field' => 'nama_penyakit',
                'label' => 'penyakit',
                'rules' => 'required'
            ],
            [
                'field' => 'keterangan',
                'label' => 'keterangan',
                'rules' => 'required'
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

    public function get_penyakit_name($id_penyakit)
    {
        $this->db->select('nama_penyakit, keterangan');
        $this->db->where('id_penyakit', $id_penyakit);
        return $this->db->get('tb_penyakit');
    }
}
