<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert alert-success">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data Pasien</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Waktu Konsultasi</th>
                                <th>Hasil Konsultasi</th>
                                <th>Detail Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)) : ?>
                            <?php else : ?>
                                <?php $i = 1;
                                foreach ($data->result() as $item) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item->nama ?></td>
                                        <td><?= $item->usia ?></td>
                                        <td><?= $item->alamat ?></td>
                                        <td><?= $item->time ?></td>
                                        <td><?= $item->nama_penyakit ?> / <?= $item->nilai_cf ?> %</td>
                                        <td>
                                            <center>
                                                <a href="<?= site_url('pasien/detail/' . $item->id_konsultasi) ?>" class="btn btn-sm btn-info" title="Detail"><i class="ti ti-eye"></i></a>
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