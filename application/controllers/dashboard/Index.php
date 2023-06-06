<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'm_login');
        $this->load->model('Dashboard_model', 'm_dashboard');
        if (!$this->m_login->CurrentUser()) {
            $this->session->set_flashdata('msg', "Pastikan anda sudah login akun!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'penyakit' => $this->m_dashboard->penyakit(),
            'gejala' => $this->m_dashboard->gejala(),
            'bobot' => $this->m_dashboard->bobot(),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/partials/footer', $data);
    }
}
