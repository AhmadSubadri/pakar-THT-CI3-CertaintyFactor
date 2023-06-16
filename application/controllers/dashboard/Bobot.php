<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bobot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'm_login');
        $this->load->model('Bobot_model', 'm_bobot');
        if (!$this->m_login->CurrentUser()) {
            $this->session->set_flashdata('msg', "Pastikan anda sudah login akun!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'data' => $this->m_bobot->get_data(),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/bobot/data_bobot', $data);
        $this->load->view('admin/partials/footer', $data);
    }

    public function insert()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_bobot->rules());
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'gejala'    => $this->m_bobot->loadgejala(),
                    'penyakit'  => $this->m_bobot->loadpenyakit(),
                ];
                $this->load->view('admin/partials/head', $data);
                $this->load->view('admin/bobot/add', $data);
                $this->load->view('admin/partials/footer', $data);
            } else {
                $data = array(
                    'id_gejala'     => $this->input->post('id_gejala', TRUE),
                    'id_penyakit'   => $this->input->post('id_penyakit', TRUE),
                    'cf_rule'      => $this->input->post('cf_rule', TRUE),
                );
                $this->m_bobot->save($data);
                $this->session->set_flashdata('msg', "Insert Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('bobot');
            }
        } else {
            $data = [
                'gejala'    => $this->m_bobot->loadgejala(),
                'penyakit'  => $this->m_bobot->loadpenyakit(),
            ];
            $this->load->view('admin/partials/head', $data);
            $this->load->view('admin/bobot/add', $data);
            $this->load->view('admin/partials/footer', $data);
        }
    }

    public function edit($id_bobot)
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_bobot->rules());
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'data' => $this->m_bobot->bobot_by_id($id_bobot),
                    'gejala'    => $this->m_bobot->loadgejala(),
                    'penyakit'  => $this->m_bobot->loadpenyakit(),
                ];
                $this->load->view('admin/partials/head', $data);
                $this->load->view('admin/bobot/edit', $data);
                $this->load->view('admin/partials/footer', $data);
            } else {
                $data = array(
                    'id_gejala'      => $this->input->post('id_gejala', TRUE),
                    'id_penyakit'    => $this->input->post('id_penyakit', TRUE),
                    'cf_rule'      => $this->input->post('cf_rule', TRUE),
                );
                $this->m_bobot->update($data, $id_bobot);
                $this->session->set_flashdata('msg', "Update Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('bobot');
            }
        } else {
            $data = [
                'data' => $this->m_bobot->bobot_by_id($id_bobot),
                'gejala'    => $this->m_bobot->loadgejala(),
                'penyakit'  => $this->m_bobot->loadpenyakit(),
            ];
            $this->load->view('admin/partials/head', $data);
            $this->load->view('admin/bobot/edit', $data);
            $this->load->view('admin/partials/footer', $data);
        }
    }

    public function delete($id)
    {
        $this->session->set_flashdata('msg', "Delete Success!.");
        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->m_bobot->delete($id);
        redirect('bobot');
    }
}
