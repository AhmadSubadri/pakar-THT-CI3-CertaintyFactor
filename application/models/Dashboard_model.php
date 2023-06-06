<?php
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function gejala()
    {
        $this->db->select('*')->from('tb_gejala');
        $query = $this->db->get();
        return $query;
    }

    public function penyakit()
    {
        $this->db->select('*')->from('tb_penyakit');
        $query = $this->db->get();
        return $query;
    }

    public function bobot()
    {
        $this->db->select('*')->from('tb_gabungan');
        $query = $this->db->get();
        return $query;
    }
}
