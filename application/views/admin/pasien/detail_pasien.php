<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <a href="<?= site_url('pasien'); ?>" class="btn btn-sm btn-warning">Kembali</a>
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert alert-success">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Detail Data Pasien</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anak</th>
                                <th>Usia Anak</th>
                                <th>Alamat Anak</th>
                                <th>Waktu Konsultasi</th>
                                <th>Hasil Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?php echo $data['nama_anak']; ?></td>
                                <td><?php echo $data['usia_anak']; ?></td>
                                <td><?php echo $data['alamat_anak']; ?></td>
                                <td><?php echo $data['time']; ?></td>
                                <td><?php echo $data['nama_penyakit']; ?> / <?php echo $data['nilai_cf']; ?> %</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert alert-success">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Gejala yang dipilih :</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Gejala</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($detail)) : ?>
                            <?php else : ?>
                                <?php $i = 1;
                                foreach ($detail->result() as $item) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item->nama_gejala ?></td>
                                        <td><?php if ($item->nilai == "0") { ?>Tidak<?php } elseif ($item->nilai == "1.0") { ?>Pasti<?php } ?>
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