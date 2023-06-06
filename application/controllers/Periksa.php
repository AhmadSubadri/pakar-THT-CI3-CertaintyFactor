<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penyakit_model');
        $this->load->model('Gejala_model');
        $this->load->model('Bobot_model');
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
        $this->load->library('getdata');
    }

    public function index()
    {
        if (!$this->input->post('gejala[]')) {                        // 2
            $data = array(                                          // 3
                'content'          => 'konsultasi',
                'level'            =>  $this->session->userdata('level'),
                'listGejala'       =>  $this->getdata->_resultDB('tb_gejala'),
                'check'            =>  $this->getdata->_resultDB('tb_gejala', 'num_rows'),
            );
            $this->load->view('partials/head', $data);
            $this->load->view('periksa', $data);
            $this->load->view('partials/footer', $data);
        } else {                                                       // 4
            $id_gejala = array();
            $nilai = array();
            $gejala = $this->input->post('gejala[]');
            $jumlah = 0;
            for ($i = 0; $i < count($gejala); $i++) {
                $x = explode("_", $gejala[$i]);
                if ($i < 5) {
                    $jumlah = $jumlah + floatval($x[1]);
                }
                array_push($nilai, $x[1]);
                array_push($id_gejala, $x[0]);
            }
            if ($jumlah == 0) {                                     // 5
                $data = array(                                       // 6
                    'content'          => 'konsultasi',
                    'listGejala'       =>  $this->getdata->_resultDB('tb_gejala'),
                    'check'            =>  $this->getdata->_resultDB('tb_gejala', 'num_rows'),
                );
                $this->session->set_flashdata('notif', 'MOHON MAAF! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal.');
                $this->load->view('partials/head', $data);
                $this->load->view('periksa', $data);
                $this->load->view('partials/footer', $data);
            } else {                                                    // 7
                //for ($i=0; $i < count($id_gejala); $i++) { 
                $MdGejala = array();
                foreach ($this->input->post('gejala') as $g) { // ambil input dari view kons
                    $q = explode("_", $g); // ambil value + dipisah
                    if ($q[1] > 0) {
                        $MdGejala[$q[0]] = $q[1];
                    }
                }
                $gejala = implode(', ', array_keys($MdGejala)); // dapat id gejala
                $data["listGejala"] = $this->Gejala_model->get_data_by_id($gejala); // dapat data gejala berdasarkan id
                $listPenyakit = $this->Bobot_model->get_by_gejala($gejala);
                //hitung                
                //    $data["listGejala"] = $this->Gejala_model->get_data_by_id($id_gejala[$i]);
                //    $listPenyakit = $this->Bobot_model->get_by_gejala($id_gejala[$i]);
                foreach ($listPenyakit->result() as $value) {
                    //        $listGejala = $this->Bobot_model->get_gejala_by_penyakit($value->id_penyakit, $id_gejala[$i]); // ambil mb md
                    $listGejala = $this->Bobot_model->get_gejala_by_penyakit($value->id_penyakit, $gejala);
                    $cf = 0;
                    $cfOld = 0;
                    $cfCombine = 0;
                    $j = 0;
                    foreach ($listGejala->result() as $value2) {
                        $cf = $cf + (($value2->nilai_mb - $value2->nilai_md) * (1 - $cf));
                        $j++;
                    }
                    date_default_timezone_set("Asia/Jakarta");
                    $inptanggal = date('Y-m-d H:i:s');
                    $penyakit[] = array(
                        'nilai_cf'          => $cf * 100,
                        'nama'         => $this->input->post('nama_anak', TRUE),
                        'usia'         => $this->input->post('usia_anak', TRUE),
                        'alamat'       => $this->input->post('alamat_anak', TRUE),
                        'jenis_kelamin'       => $this->input->post('jenis_kelamin', TRUE),
                        'telp'       => $this->input->post('telp', TRUE),
                        'time'              => $inptanggal,
                        'nama_penyakit'     => $value->nama_penyakit,
                        'keterangan'        => $value->keterangan,
                    );
                }
                $konsultasi = $this->Pasien_model->get_no_urut();
                $data_hasil = array();
                $cfTerbesar = $penyakit[0]['nilai_cf'];
                foreach ($penyakit as $p) {
                    if ($p['nilai_cf'] >= $cfTerbesar) {
                        $data_hasil = $p;
                        $cfTerbesar = $p['nilai_cf'];
                    }
                }
                if ($cfTerbesar == "0") {                                 //8
                    $data = array(                                      // 9
                        'content'          => 'konsultasi',
                        'listGejala'       =>  $this->getdata->_resultDB('tb_gejala'),
                        'check'            =>  $this->getdata->_resultDB('tb_gejala', 'num_rows'),
                    );
                    $this->session->set_flashdata('notif', 'MOHON MAAF! PERHITUNGAN GAGAL! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal.');
                    $this->load->view('partials/head', $data);
                    $this->load->view('periksa', $data);
                    $this->load->view('partials/footer', $data);
                } else {                                                   // 10
                    if ($konsultasi == null) {
                        $id_konsultasi = 1;
                    } else {
                        $id_konsultasi = (int)$konsultasi->id_konsultasi + 1;
                    }
                    $data_hasil['id_konsultasi'] = $id_konsultasi;
                    if ($this->Pasien_model->save($data_hasil) > 0) {
                        for ($i = 0; $i < count($id_gejala); $i++) {
                            $datas = [
                                'id_konsultasi' => $id_konsultasi,
                                'id_gejala' => $id_gejala[$i],
                                'nilai' => $nilai[$i]
                            ];
                            $this->Pasien_model->savedetail($datas);
                        }
                        $data['dataHasil'] = $data_hasil;
                        $data['content'] = 'hasil konsultasi';
                        $data["listPenyakit"] = $penyakit;
                        $this->load->view('partials/head', $data);
                        $this->load->view('periksa', $data);
                        $this->load->view('partials/footer', $data);
                    }
                }
            }
        }
    }
}
