<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'm_login');
        $this->load->model('Pasien_model', 'm_pasien');
        if (!$this->m_login->CurrentUser()) {
            $this->session->set_flashdata('msg', "Pastikan anda sudah login akun!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'data' => $this->m_pasien->get_data(),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/pasien/data_pasien', $data);
        $this->load->view('admin/partials/footer', $data);
    }

    public function detail($id)
    {
        $data = [
            'data' => $this->db->get_where('tb_konsultasi', array('uniq_id' => $id))->row_array(),
            'detail' => $this->m_pasien->get_detail($id),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/pasien/detail_pasien', $data);
        $this->load->view('admin/partials/footer', $data);
    }

    public function delete($id)
    {
        $this->session->set_flashdata('msg', "Delete Success!.");
        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->db->delete('tb_konsultasi', ['uniq_id' => $id]);
        $this->db->delete('tb_detail_konsultasi', ['id_konsultasi' => $id]);
        redirect('pasien');
    }
}
