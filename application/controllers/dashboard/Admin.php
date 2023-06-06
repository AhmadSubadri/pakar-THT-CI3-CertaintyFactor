<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'm_login');
        $this->load->model('Admin_model', 'm_admin');
        if (!$this->m_login->CurrentUser()) {
            $this->session->set_flashdata('msg', "Pastikan anda sudah login akun!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'data' => $this->m_admin->get_data(),
        ];
        $this->load->view('admin/partials/head', $data);
        $this->load->view('admin/user/data_admin', $data);
        $this->load->view('admin/partials/footer', $data);
    }

    public function insert()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_admin->rules());
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/partials/head');
                $this->load->view('admin/user/add');
                $this->load->view('admin/partials/footer');
            } else {
                $data = array(
                    'nama'   => $this->input->post('nama', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => md5($this->input->post('password')),
                    'level'    => "admin",
                );
                $this->m_admin->save($data);
                $this->session->set_flashdata('msg', "Insert Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('admin');
            }
        } else {
            $this->load->view('admin/partials/head');
            $this->load->view('admin/user/add');
            $this->load->view('admin/partials/footer');
        }
    }

    public function edit($id_admin)
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules($this->m_admin->rules());
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'data' => $this->m_admin->admin_by_id($id_admin),
                ];
                $this->load->view('admin/partials/head', $data);
                $this->load->view('admin/user/edit', $data);
                $this->load->view('admin/partials/footer', $data);
            } else {
                $cek = $this->m_admin->admin_by_id($id_admin);
                if ($this->input->post('password') == NULL) {
                    $pass = $cek->password;
                } else {
                    $pass = md5($this->input->post('password'));
                }
                $data = array(
                    'nama'   => $this->input->post('nama', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => $pass,
                    'level'    => "admin",
                );
                $this->m_admin->update($data, $id_admin);
                $this->session->set_flashdata('msg', "Update Success!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('admin');
            }
        } else {
            $data = [
                'data' => $this->m_admin->admin_by_id($id_admin),
            ];
            $this->load->view('admin/partials/head', $data);
            $this->load->view('admin/user/edit', $data);
            $this->load->view('admin/partials/footer', $data);
        }
    }

    public function delete($id)
    {
        $this->session->set_flashdata('msg', "Delete Success!.");
        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->m_admin->delete($id);
        redirect('admin');
    }
}
