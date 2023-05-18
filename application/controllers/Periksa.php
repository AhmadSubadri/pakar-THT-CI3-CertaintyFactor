<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
{

    public function index()
    {
        $this->load->view('partials/head');
        $this->load->view('periksa');
        $this->load->view('partials/footer');
    }
}
