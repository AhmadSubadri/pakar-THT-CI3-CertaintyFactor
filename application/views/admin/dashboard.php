<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3><?= count($penyakit->result()); ?></h3>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-9 fw-semibold text-center">Data Penyakit</h5>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3><?= count($gejala->result()); ?></h3>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-9 fw-semibold text-center">Data Gejala</h5>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3><?= count($bobot->result()); ?></h3>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-9 fw-semibold text-center">Data Bobot</h5>
        </div>
    </div>
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body text-center">
                <h2>Selamat datang di sistem pakar Diagnosa<br>Penyakit THT dengan Metode Certainty Factor</h2>
            </div>
        </div>
    </div>
</div>