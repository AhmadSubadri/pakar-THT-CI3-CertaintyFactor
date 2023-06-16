<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public $table = "tb_konsultasi";
    public $table2 = "tb_detail_konsultasi";

    public function get_data()
    {
        $this->db->select('*')->from('tb_konsultasi');
        $query = $this->db->get();
        return $query;
    }

    public function get_biodata_byuniq($uniq)
    {
        $this->db->select('*')->from('tb_konsultasi')->where('uniq_id', $uniq);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_detail($id)
    {
        $this->db->select('*');
        $this->db->from('tb_konsultasi', 'tb_gejala', 'tb_detail_konsultasi');
        $this->db->join('tb_detail_konsultasi', 'tb_konsultasi.uniq_id = tb_detail_konsultasi.id_konsultasi');
        $this->db->join('tb_gejala', 'tb_detail_konsultasi.id_gejala = tb_gejala.id_gejala');
        $this->db->where('tb_konsultasi.uniq_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function get_no_urut()
    {
        $this->db->select('id_konsultasi');
        $this->db->from('tb_konsultasi');
        $this->db->order_by('id_konsultasi', 'DESC');
        return $this->db->get()->first_row();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function savedetail($data)
    {
        return $this->db->insert($this->table2, $data);
    }
}
