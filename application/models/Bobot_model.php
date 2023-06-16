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
                'field' => 'cf_rule',
                'label' => 'Nilai Cf Rule',
                'rules' => 'required'
            ],
        ];
    }

    public function getPenyakitCf($gejalaId, $id_penyakit)
    {
        $this->db->select('cf_rule');
        $this->db->from('tb_gabungan');
        $this->db->where('id_gejala', $gejalaId);
        $this->db->where('id_penyakit', $id_penyakit);
        $query = $this->db->get();
        return $query->result();
    }
    // public function getPenyakitCf($gejalaIds)
    // {
    //     // Ambil nilai CF[Rule] dari tabel Aturan berdasarkan gejala yang diamati
    //     $this->db->select('id_penyakit, cf_rule');
    //     $this->db->from('tb_gabungan');
    //     $this->db->where_in('id_gejala', explode(',', $gejalaIds));
    //     $query = $this->db->get();

    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return 0; // Nilai default jika tidak ada basis pengetahuan yang sesuai
    //     }
    // }

    public function get_data()
    {
        $this->db->select('*')->from('tb_gabungan')
            ->join('tb_gejala', 'tb_gabungan.id_gejala = tb_gejala.id_gejala')
            ->join('tb_penyakit', 'tb_gabungan.id_penyakit = tb_penyakit.id_penyakit');
        $query = $this->db->get();
        return $query;
    }

    public function bobot_by_id($id)
    {
        $this->db->select('*')->from('tb_gabungan')->where('id_gabungan', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_nilai_cf($id_penyakit, $id_gejala)
    {
        $this->db->select('cf_rule');
        $this->db->from('tb_gabungan');
        $this->db->where('id_penyakit', $id_penyakit);
        $this->db->where('id_gejala', $id_gejala);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $cf_rule = $row->cf_rule;

            return [
                'cf_rule' => $cf_rule,
            ];
        }

        return null;
    }

    public function get_by_gejala($gejala)
    {
        $sql = "SELECT p.id_penyakit,
                   p.nama_penyakit,
                   p.keterangan
            FROM tb_gabungan AS gp
            INNER JOIN tb_penyakit AS p
                ON gp.id_penyakit = p.id_penyakit
            WHERE gp.id_gejala IN (" . $gejala . ")
            GROUP BY p.id_penyakit
            ORDER BY p.id_penyakit";

        return $this->db->query($sql);
    }

    public function get_cf_rule($gejalaId, $penyakitId)
    {
        $this->db->select('cf_rule');
        $this->db->from('tb_gabungan');
        $this->db->where('id_gejala', $gejalaId);
        $this->db->where('id_penyakit', $penyakitId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->cf_rule;
        } else {
            return 0;
        }
    }

    public function get_gejala_by_penyakit($id, $gejala = null)
    {
        $sql = "SELECT gb.id_gejala, gb.cf_rule, gjl.nama_gejala
        FROM tb_gabungan AS gb
        INNER JOIN tb_gejala AS gjl ON gjl.id_gejala = gb.id_gejala
        WHERE id_penyakit = " . $id;

        if ($gejala != null) {
            $sql .= " AND gb.id_gejala IN (" . $gejala . ")";
        }
        $sql .= " ORDER BY gb.id_gejala ASC"; // Mengurutkan dari besar ke kecil

        return $this->db->query($sql);
    }

    public function get_aturan_by_gejala($gejala_ids)
    {
        $this->db->select('id_gabungan, id_penyakit, id_gejala, cf_rule');
        $this->db->from('tb_gabungan');
        $this->db->where_in('id_gejala', $gejala_ids);
        $query = $this->db->get();
        return $query;
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
