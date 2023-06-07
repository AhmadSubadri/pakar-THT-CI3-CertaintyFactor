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
        if (!$this->input->post('gejala[]')) {
            $data = [
                'listGejala' => $this->getdata->_resultDB('tb_gejala'),
                'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
            ];
            $this->session->set_flashdata('msg', "Pastikan Gejala Sudah di isi minimal 5 gejala!.");
            $this->session->set_flashdata('msg_class', 'alert-warning');
            $this->load->view('partials/head', $data);
            $this->load->view('periksa', $data);
            $this->load->view('partials/footer', $data);
        } else {
            $gejala = $this->input->post('gejala[]');
            $nilai = [];
            $id_gejala = [];

            foreach ($gejala as $g) {
                $x = explode("_", $g);
                array_push($id_gejala, $x[0]);
                array_push($nilai, $x[1]);
            }

            $jumlah_gejala = count($gejala);
            $jumlah_gejala_minimal = 5;

            if ($jumlah_gejala < $jumlah_gejala_minimal) {
                $data = [
                    'listGejala' => $this->getdata->_resultDB('tb_gejala'),
                    'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
                ];
                $this->session->set_flashdata('msg', "MOHON MAAF! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal!.");
                $this->session->set_flashdata('msg_class', 'alert-warning');
                $this->load->view('partials/head', $data);
                $this->load->view('periksa', $data);
                $this->load->view('partials/footer', $data);
            } else {
                $MdGejala = [];

                foreach ($gejala as $g) {
                    $x = explode("_", $g);
                    if ($x[1] > 0) {
                        $MdGejala[$x[0]] = $x[1];
                    }
                }

                $gejala_ids = implode(',', array_keys($MdGejala));

                $listGejala = $this->Gejala_model->get_data_by_id($gejala_ids);
                $listPenyakit = $this->Bobot_model->get_by_gejala($gejala_ids);
                $penyakit = [];

                foreach ($listPenyakit->result() as $value) {
                    $listGejala = $this->Bobot_model->get_gejala_by_penyakit($value->id_penyakit, $gejala_ids);
                    $cf = 1; // Menginisialisasi nilai CF dengan 1
                    $j = 0;

                    foreach ($listGejala->result() as $value2) {
                        $gejalaName = $this->Gejala_model->get_gejala_name($value2->id_gejala);
                        $gejalaCF = $MdGejala[$gejalaName] ?? "0"; // Menggunakan kunci yang sesuai

                        $mb = $value2->nilai_mb;
                        $md = $value2->nilai_md;

                        // Menghitung nilai CF untuk gejala tertentu
                        $cf_gejala = ($mb * $gejalaCF + $md * (1 - $gejalaCF)) / (1 - min($mb, $md));
                        $cf = $cf_gejala;

                        $j++;
                    }

                    $cf_percentage = round($cf * 100, 2);

                    date_default_timezone_set("Asia/Jakarta");
                    $inptanggal = date('Y-m-d H:i:s');

                    $penyakit[] = [
                        'nilai_cf' => $cf_percentage,
                        'nama' => $this->input->post('nama', TRUE),
                        'usia' => $this->input->post('usia', TRUE),
                        'alamat' => $this->input->post('alamat', TRUE),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                        'telp' => $this->input->post('telp', TRUE),
                        'time' => $inptanggal,
                        'nama_penyakit' => $value->nama_penyakit,
                        'keterangan' => $value->keterangan,
                    ];
                }

                $cfTerbesar = 0;
                $data_hasil = null;

                foreach ($penyakit as $p) {
                    if ($p['nilai_cf'] > $cfTerbesar) {
                        $data_hasil = $p;
                        $cfTerbesar = $p['nilai_cf'];
                    }
                }

                if ($cfTerbesar == 0) {
                    $data = [
                        'listGejala' => $this->getdata->_resultDB('tb_gejala'),
                        'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
                    ];
                    $this->session->set_flashdata('msg', "MOHON MAAF! PERHITUNGAN GAGAL! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal!.");
                    $this->session->set_flashdata('msg_class', 'alert-success');
                    $this->load->view('partials/head', $data);
                    $this->load->view('periksa', $data);
                    $this->load->view('partials/footer', $data);
                } else {
                    $periksa = $this->Pasien_model->get_no_urut();

                    if ($periksa == null) {
                        $id_konsultasi = 1;
                    } else {
                        $id_konsultasi = (int) $periksa->id_konsultasi + 1;
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

                        $sistGejala[] = [
                            'gejalaName' => $gejalaName,
                            'gejalaCF' => $gejalaCF,
                            'cf_gejala' => $cf_gejala
                        ];

                        $data = [
                            // 'listGejala' => $listGejala,
                            'dataHasil' => $data_hasil,
                            'listPenyakit' => $penyakit,
                            'sistGejala' => $this->Gejala_model->get_data_by_id($gejala_ids)
                        ];

                        $this->load->view('partials/head', $data);
                        $this->load->view('hasil_periksa', $data);
                        $this->load->view('partials/footer', $data);
                    }
                }
            }
        }
    }


    // public function index()
    // {
    //     if (!$this->input->post('gejala[]')) {
    //         $data = [
    //             'listGejala' => $this->getdata->_resultDB('tb_gejala'),
    //             'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
    //         ];
    //         $this->session->set_flashdata('msg', "Pastikan Gejala Sudah di isi minimal 5 gejala!.");
    //         $this->session->set_flashdata('msg_class', 'alert-warning');
    //         $this->load->view('partials/head', $data);
    //         $this->load->view('periksa', $data);
    //         $this->load->view('partials/footer', $data);
    //     } else {
    //         $gejala = $this->input->post('gejala[]');
    //         $nilai = array();
    //         $id_gejala = array();

    //         foreach ($gejala as $g) {
    //             $x = explode("_", $g);
    //             array_push($id_gejala, $x[0]);
    //             array_push($nilai, $x[1]);
    //         }

    //         $jumlah_gejala = count($gejala);
    //         $jumlah_gejala_minimal = 5;

    //         if ($jumlah_gejala < $jumlah_gejala_minimal) {
    //             $data = array(
    //                 'listGejala' => $this->getdata->_resultDB('tb_gejala'),
    //                 'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
    //             );
    //             $this->session->set_flashdata('msg', "MOHON MAAF! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal!.");
    //             $this->session->set_flashdata('msg_class', 'alert-warning');
    //             $this->load->view('partials/head', $data);
    //             $this->load->view('periksa', $data);
    //             $this->load->view('partials/footer', $data);
    //         } else {
    //             $MdGejala = array();

    //             foreach ($gejala as $g) {
    //                 $x = explode("_", $g);
    //                 if ($x[1] > 0) {
    //                     $MdGejala[$x[0]] = $x[1];
    //                 }
    //             }

    //             $gejala_ids = implode(',', array_keys($MdGejala));

    //             $data["listGejala"] = $this->Gejala_model->get_data_by_id($gejala_ids);
    //             $listPenyakit = $this->Bobot_model->get_by_gejala($gejala_ids);
    //             $penyakit = array();

    //             foreach ($listPenyakit->result() as $value) {
    //                 $listGejala = $this->Bobot_model->get_gejala_by_penyakit($value->id_penyakit, $gejala_ids);
    //                 $cf = 1; // Menginisialisasi nilai CF dengan 1
    //                 $j = 0;

    //                 foreach ($listGejala->result() as $value2) {
    //                     $mb = $value2->nilai_mb;
    //                     $md = $value2->nilai_md;

    //                     // Menghitung nilai CF untuk gejala tertentu
    //                     $cf_gejala = ($mb * $cf) + (($md * (1 - $mb)) * (1 - $cf));
    //                     $cf = $cf_gejala;

    //                     $j++;
    //                 }

    //                 $cf_percentage = round($cf * 100, 2);

    //                 date_default_timezone_set("Asia/Jakarta");
    //                 $inptanggal = date('Y-m-d H:i:s');

    //                 $penyakit[] = array(
    //                     'nilai_cf' => $cf_percentage,
    //                     'nama' => $this->input->post('nama', TRUE),
    //                     'usia' => $this->input->post('usia', TRUE),
    //                     'alamat' => $this->input->post('alamat', TRUE),
    //                     'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
    //                     'telp' => $this->input->post('telp', TRUE),
    //                     'time' => $inptanggal,
    //                     'nama_penyakit' => $value->nama_penyakit,
    //                     'keterangan' => $value->keterangan,
    //                 );
    //             }

    //             $cfTerbesar = 0;
    //             $data_hasil = array();

    //             foreach ($penyakit as $p) {
    //                 if ($p['nilai_cf'] >= $cfTerbesar) {
    //                     $data_hasil = $p;
    //                     $cfTerbesar = $p['nilai_cf'];
    //                 }
    //             }

    //             if ($cfTerbesar == 0) {
    //                 $data = array(
    //                     'listGejala' => $this->getdata->_resultDB('tb_gejala'),
    //                     'check' => $this->getdata->_resultDB('tb_gejala', 'num_rows'),
    //                 );
    //                 $this->session->set_flashdata('msg', "MOHON MAAF! PERHITUNGAN GAGAL! Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal!.");
    //                 $this->session->set_flashdata('msg_class', 'alert-success');
    //                 $this->load->view('partials/head', $data);
    //                 $this->load->view('periksa', $data);
    //                 $this->load->view('partials/footer', $data);
    //             } else {
    //                 $periksa = $this->Pasien_model->get_no_urut();

    //                 if ($periksa == null) {
    //                     $id_konsultasi = 1;
    //                 } else {
    //                     $id_konsultasi = (int)$periksa->id_konsultasi + 1;
    //                 }

    //                 $data_hasil['id_konsultasi'] = $id_konsultasi;

    //                 if ($this->Pasien_model->save($data_hasil) > 0) {
    //                     for ($i = 0; $i < count($id_gejala); $i++) {
    //                         $datas = array(
    //                             'id_konsultasi' => $id_konsultasi,
    //                             'id_gejala' => $id_gejala[$i],
    //                             'nilai' => $nilai[$i]
    //                         );
    //                         $this->Pasien_model->savedetail($datas);
    //                     }

    //                     $data = array(
    //                         // 'listGejala' => $listGejala,
    //                         'dataHasil' => $data_hasil,
    //                         'listPenyakit' => $penyakit,
    //                         'sistGejala' => $listGejala->result_array()
    //                     );

    //                     $this->load->view('partials/head', $data);
    //                     $this->load->view('hasil_periksa', $data);
    //                     $this->load->view('partials/footer', $data);
    //                 }
    //             }
    //         }
    //     }
    // }

}
