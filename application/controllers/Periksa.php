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
                $dataPenyakit = $this->Bobot_model->loadpenyakit();
                $hasilDiagnosa = [];

                foreach ($dataPenyakit as $penyakit) {
                    $id_penyakit = $penyakit->id_penyakit;
                    $cfOld = 0; // Certainty Factor hipotesis lama
                    $cfCombine = 0; // Certainty Factor Combine
                    $cfGejala = 1; // Certainty Factor gejala (dalam contoh ini, diasumsikan nilai CFgejala = 1)

                    foreach ($gejala as $gejalaValue) {
                        // Pisahkan ID gejala dan nilai CF[E]
                        $parts = explode('_', $gejalaValue);
                        $gejalaId = $parts[0];
                        $cfE = $parts[1];

                        // Dapatkan nilai CF[Rule] dari basis pengetahuan berdasarkan ID gejala dan ID penyakit
                        $cfRule = $this->Bobot_model->getPenyakitCf($gejalaId, $id_penyakit);

                        // Lakukan perhitungan CF[H, E] = CF[E] * CF[Rule]
                        foreach ($cfRule as $cfRules) {
                            $gejalaCF = $cfRules->cf_rule ?? 0;
                            $cfHE = ($cfE * $gejalaCF);

                            // Hitung CF Combine menggunakan rumus CF Combine = CFold + CFgejala * (1 - CFold)
                            $cfCombine = $cfOld + $cfHE * (1 - $cfOld);

                            // Simpan CF Combine sebagai hipotesis lama untuk iterasi berikutnya
                            $cfOld = $cfCombine;
                        }
                    }

                    // Hitung CF Persentase
                    $cfPersentase = $cfCombine * 100;

                    // Simpan hasil diagnosa penyakit dalam array
                    $hasilDiagnosa[] = [
                        'id_penyakit' => $id_penyakit,
                        'keterangan' => $penyakit->keterangan,
                        'nama_penyakit' => $penyakit->nama_penyakit,
                        'cfCombine' => $cfCombine,
                        'cfPersentase' => $cfPersentase,
                    ];
                }

                // Urutkan hasil diagnosa berdasarkan CF Persentase secara descending
                usort($hasilDiagnosa, function ($a, $b) {
                    return $b['cfPersentase'] - $a['cfPersentase'];
                });

                // Ambil data penyakit dengan persentase tertinggi
                $diagnosaTertinggi = $hasilDiagnosa[0];

                // Simpan hasil diagnosa tertinggi ke dalam tabel konsultasi
                date_default_timezone_set("Asia/Jakarta");
                $inptanggal = date('Y-m-d H:i:s');
                $uiniq_id = uniqid("konsul");
                $dataPeriksa = [
                    'nilai_cf' => $diagnosaTertinggi['cfPersentase'],
                    'nama' => $this->input->post('nama', TRUE),
                    'usia' => $this->input->post('usia', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'telp' => $this->input->post('telp', TRUE),
                    'time' => $inptanggal,
                    'nama_penyakit' => $diagnosaTertinggi['nama_penyakit'],
                    'keterangan' => $diagnosaTertinggi['keterangan'],
                    'uniq_id' => $uiniq_id,

                    // 'id_penyakit' => $diagnosaTertinggi['id_penyakit'],
                    // 'nama_penyakit' => $diagnosaTertinggi['nama_penyakit'],
                    // 'cf_combine' => $diagnosaTertinggi['cfCombine'],
                    // 'cf_persentase' => $diagnosaTertinggi['cfPersentase'],
                ];
                $this->db->insert('tb_konsultasi', $dataPeriksa);

                for ($i = 0; $i < count($id_gejala); $i++) {
                    $datas = [
                        'id_konsultasi' => $uiniq_id,
                        'id_gejala' => $id_gejala[$i],
                        'nilai' => $nilai[$i]
                    ];
                    $this->Pasien_model->savedetail($datas);
                }
                $MdGejala = [];
                foreach ($gejala as $g) {
                    $x = explode("_", $g);
                    if ($x[1] > 0) {
                        $MdGejala[$x[0]] = $x[1];
                    }
                }
                $gejala_ids = implode(',', array_keys($MdGejala));

                $data = [
                    'biodata' => $this->Pasien_model->get_biodata_byuniq($uiniq_id),
                    'hasil' => $hasilDiagnosa,
                    'output' => $diagnosaTertinggi,
                    'tGejala' => $this->Gejala_model->get_data_by_id($gejala_ids)
                ];

                $this->load->view('partials/head', $data);
                $this->load->view('hasil_periksa', $data);
                $this->load->view('partials/footer', $data);
            }
        }
    }
}
