<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'm_login');
        $this->load->model('Gejala_model', 'm_gejala');
        if (!$this->m_login->CurrentUser()) {
            $this->session->set_flashdata('msg', "Pastikan anda sudah login akun!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'data' => $this->m_gejala->get_data(),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/gejala/data_gejala', $data);
        $this->load->view('admin/partials/footer', $data);
    }

    public function insert()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_gejala->rules());
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/partials/head');
                $this->load->view('admin/gejala/add');
                $this->load->view('admin/partials/footer');
            } else {
                $data = array(
                    'nama_gejala'     => $this->input->post('nama_gejala', TRUE),
                    'kode_gejala'      => $this->input->post('kode_gejala', TRUE),
                );
                $this->m_gejala->save($data);
                $this->session->set_flashdata('msg', "Insert Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('gejala');
            }
        } else {
            $this->load->view('admin/partials/head');
            $this->load->view('admin/gejala/add');
            $this->load->view('admin/partials/footer');
        }
    }

    public function edit($id_gejala)
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_gejala->rules());
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'data' => $this->m_gejala->gejala_by_id($id_gejala),
                ];
                $this->load->view('admin/partials/head', $data);
                $this->load->view('admin/gejala/edit', $data);
                $this->load->view('admin/partials/footer', $data);
            } else {
                $data = array(
                    'nama_gejala'     => $this->input->post('nama_gejala', TRUE),
                    'kode_gejala'      => $this->input->post('kode_gejala', TRUE),

                );
                $this->m_gejala->update($data, $id_gejala);
                $this->session->set_flashdata('msg', "Update Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('gejala');
            }
        } else {
            $data = [
                'data' => $this->m_gejala->gejala_by_id($id_gejala),
            ];
            $this->load->view('admin/partials/head', $data);
            $this->load->view('admin/gejala/edit', $data);
            $this->load->view('admin/partials/footer', $data);
        }
    }

    public function delete($id)
    {
        $this->session->set_flashdata('msg', "Delete Success!.");
        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->m_gejala->delete($id);
        redirect('gejala');
    }
}
