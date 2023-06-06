<?php
class Model_login extends CI_Model
{
    const SESSION_KEY = 'username';
    function __construct()
    {
        parent::__construct();
    }

    public function getSecurity()
    {
        $level    = $this->session->userdata('level');
        if (empty($level)) {
            $this->session->set_flashdata("info", "<i class=\"ace-icon fa fa-exclamation-circle red\"></i>Masukkan Nama Pengguna dan Kata Sandi Anda!");
            redirect('login');
            $this->session->sess_destroy();
        }
    }

    public function admin($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_admin');
    }

    public function pakar($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_pakar');
    }

    public function CurrentUser()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $user_id = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where('tb_admin', ['username' => $user_id]);
        return $query->row();
    }
}
