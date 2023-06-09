<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data Penyakit Edit</h5>
                    </div>
                </div>
                <form action="<?= site_url('penyakit/ubah/' . $data->id_penyakit); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Penyakit</label>
                                <input type="text" placeholder="Nama Penyakit *" class="form-control" value="<?= $data->nama_penyakit; ?>" name="nama_penyakit" id="exampleInputEmail1" aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text text-danger">
                                    <?= form_error('penyakit') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Keterangan Penyakit</label>
                                <textarea class="form-control" name="keterangan"><?= $data->keterangan; ?></textarea>
                                <div id="emailHelp" class="form-text text-danger">
                                    <?php echo form_error('keterangan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Update
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= site_url('penyakit') ?>" class="btn btn-sm btn-danger m-1">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>