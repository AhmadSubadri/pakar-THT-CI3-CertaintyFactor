<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert alert-success">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data bobot Add</h5>
                    </div>
                </div>
                <div class="notification-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-block alert-warning">
                                    <strong>
                                        <i class="ti ti-alert-triangle"></i> KETERANGAN<br>
                                    </strong>Silahkan pilih gejala yang sesuai dengan penyakit yang ada, dan berikan Nilai Kepastian atau MB (Measure of Increased Belief) dan Nilai Ketidakpastian atau MD (Measure of Increased Disbelief) dengan cakupan sebagai berikut:<br>1.0 (Pasti Ya) <br>0.8 (Hampir Pasti) <br>0.6 (Kemungkinan Besar)<br> 0.4 (Mungkin) <br>0.2 (Hampir Mungkin) <br>0.0 (Tidak Tahu atau Tidak Yakin) <b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="<?= site_url('bobot/insert'); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Penyakit</label>
                                <select class="form-select" id="exampleInputEmail1" name="id_penyakit">
                                    <option value="">Pilih Penyakit...</option>
                                    <?php foreach ($penyakit as $data) : ?>
                                        <option value="<?= $data->id_penyakit ?>"><?= $data->nama_penyakit ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('id_penyakit') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Gejala</label>
                                <select class="form-select" id="exampleInputEmail1" name="id_gejala">
                                    <option value="">Pilih Gejala...</option>
                                    <?php foreach ($gejala as $data) : ?>
                                        <option value="<?= $data->id_gejala ?>"><?= $data->nama_gejala ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('id_gejala') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nilai Kepastian (MB)</label>
                                <select class="form-select" id="exampleInputEmail1" name="nilai_mb">
                                    <option value="1.0">1.0 - Pasti Ya</option>
                                    <option value="0.8">0.8 - Hampir Pasti</option>
                                    <option value="0.6">0.6 - Kemungkinan Besar</option>
                                    <option value="0.4">0.4 - Mungkin</option>
                                    <option value="0.2">0.2 - Hampir Mungkin</option>
                                    <option value="0">0 - Tidak Tahu atau Tidak Yakin</option>
                                </select>
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('nilai_mb') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nilai Ketidakpastian (MD)</label>
                                <select class="form-select" id="exampleInputEmail1" name="nilai_md">
                                    <option value="1.0">1.0 - Pasti Ya</option>
                                    <option value="0.8">0.8 - Hampir Pasti</option>
                                    <option value="0.6">0.6 - Kemungkinan Besar</option>
                                    <option value="0.4">0.4 - Mungkin</option>
                                    <option value="0.2">0.2 - Hampir Mungkin</option>
                                    <option value="0">0 - Tidak Tahu atau Tidak Yakin</option>
                                </select>
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('nilai_md') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Submit
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= site_url('bobot') ?>" class="btn btn-sm btn-danger m-1">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>