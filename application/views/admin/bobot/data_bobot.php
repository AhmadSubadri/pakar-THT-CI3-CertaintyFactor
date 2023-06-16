<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data bobot</h5>
                    </div>
                    <div>
                        <a href="<?= site_url('bobot/insert'); ?>" class="btn btn-sm btn-warning m-1"><i class="ti ti-circle-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Penyakit</th>
                                <th>Gejala</th>
                                <th>CF Rule</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)) : ?>
                            <?php else : ?>
                                <?php $i = 1;
                                foreach ($data->result() as $item) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item->nama_penyakit ?></td>
                                        <td><?= $item->nama_gejala ?></td>
                                        <td><?= $item->cf_rule ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= site_url('bobot/ubah/' . $item->id_gabungan) ?>" class="btn btn-sm btn-info" title="Edit"><i class="ti ti-edit"></i></a>
                                                <a href="<?= site_url('bobot/delete/' . $item->id_gabungan) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?');" class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>