<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bobot_model extends CI_Model
{

    public $table = "tb_gabungan";

    public function rules()
    {
        return [
            [
                'field' => 'id_penyakit',
                'label' => 'Penyakit',
                'rules' => 'required'
            ],
            [
                'field' => 'id_gejala',
                'label' => 'Gejala',
                'rules' => 'required'
            ],
            [
                'field' => 'nilai_mb',
                'label' => 'Nilai MB',
                'rules' => 'required'
            ],
            [
                'field' => 'nilai_md',
                'label' => 'Nilai MD',
                'rules' => 'required'
            ]
        ];
    }

    public function get_data()
    {
        $this->db->select('*')->from('tb_gabungan')
            ->join('tb_gejala', 'tb_gabungan.id_gejala = tb_gejala.id_gejala')
            ->join('tb_penyakit', 'tb_gabungan.id_penyakit = tb_penyakit.id_penyakit')
            ->join('tb_admin', 'tb_gabungan.id_penginput = tb_admin.id_admin');
        $query = $this->db->get();
        return $query;
    }

    public function bobot_by_id($id)
    {
        $this->db->select('*')->from('tb_gabungan')->where('id_gabungan', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function loadgejala()
    {
        return $this->db->get('tb_gejala')->result();
    }

    public function loadpenyakit()
    {
        return $this->db->get('tb_penyakit')->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, ['id_gabungan' => $id]);
    }

    function delete($id)
    {
        $this->db->where('id_gabungan', $id);
        return $this->db->delete('tb_gabungan');
    }
}
