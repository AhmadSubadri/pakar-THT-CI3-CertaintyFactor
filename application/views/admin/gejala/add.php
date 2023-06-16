<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data gejala Add</h5>
                    </div>
                </div>
                <form action="<?= site_url('gejala/insert'); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Koded Gejala</label>
                                <input type="text" placeholder="Kode gejala *" class="form-control" name="kode_gejala" id="exampleInputEmail1" aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('kode_gejala') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Gejala</label>
                                <input type="text" placeholder="Nama gejala *" class="form-control" name="nama_gejala" id="exampleInputEmail1" aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('gejala') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Submit
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= site_url('gejala') ?>" class="btn btn-sm btn-danger m-1">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>