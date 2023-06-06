<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert alert-success">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data Penyakit</h5>
                    </div>
                    <div>
                        <a href="<?= site_url('penyakit/insert'); ?>" class="btn btn-sm btn-primary m-1"><i class="ti ti-circle-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Penyakit</th>
                                <th>Keterangan Penyakit</th>
                                <th>Penginput</th>
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
                                        <td><?= $item->nama_penyakit; ?></td>
                                        <td><?= word_limiter($item->keterangan, 30); ?></td>
                                        <td><?php if ($item->id_penginput > 0 && $item->id_penginput <= 5) { ?>Admin<?php } else if ($item->id_penginput > 5 && $item->id_penginput <= 10) { ?>Pakar<?php } ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= site_url('penyakit/ubah/' . $item->id_penyakit) ?>" class="btn btn-sm btn-info" title="Edit"><i class="ti ti-edit"></i></a>
                                                <a href="<?= site_url('penyakit/delete/' . $item->id_penyakit) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?');" class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></a>
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