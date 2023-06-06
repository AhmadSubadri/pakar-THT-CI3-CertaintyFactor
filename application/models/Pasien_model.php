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

    public function get_detail($id)
    {
        $this->db->select('*');
        $this->db->from('tb_konsultasi', 'tb_gejala', 'tb_detail_konsultasi');
        $this->db->join('tb_detail_konsultasi', 'tb_konsultasi.id_konsultasi = tb_detail_konsultasi.id_konsultasi');
        $this->db->join('tb_gejala', 'tb_detail_konsultasi.id_gejala = tb_gejala.id_gejala');
        $this->db->where('tb_konsultasi.id_konsultasi', $id);
        $query = $this->db->get();
        return $query;
    }
}
