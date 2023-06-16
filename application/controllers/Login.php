<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function chek_login()
    {
        $username    = $this->input->post("username");
        $pass        = md5($this->input->post("password"));
        $admin        = $this->Model_login->admin($username);
        // $pakar         = $this->Model_login->pakar($username);

        if ($admin->num_rows() == 1) {
            foreach ($admin->result() as $row) {
                $pss = $row->password;
            }
            if ($pss == $pass) {
                foreach ($admin->result() as $key) {
                    $data_session = array(
                        'id_admin'            => $key->id_admin,
                        'nama'                => $key->nama,
                        'username'            => $key->username,
                        'level'                => $key->level,
                        'login'                => "berhasil-login"
                    );
                    $this->session->set_userdata($data_session);
                }
                $this->session->set_flashdata('msg', "Yeei Selamat, login kamu berhasil!.");
                $this->session->set_flashdata('msg_class', 'alert-success');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('msg', "Yaah Maaf, username dan password anda salah!.");
                $this->session->set_flashdata('msg_class', 'alert-danger');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('msg', "Yaah Maaf, username dan password anda salah!.");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
