<?php $this->load->view('admin/partials/alert.php'); ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9 alert">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Data Gejala</h5>
                    </div>
                    <div>
                        <a href="<?= site_url('gejala/insert'); ?>" class="btn btn-sm btn-warning m-1"><i class="ti ti-circle-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Gejala</th>
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
                                        <td><?= $item->nama_gejala ?></td>
                                        <td><?php if ($item->level_penginput == "admin") { ?>Admin<?php } else if ($item->level_penginput == "pakar") { ?>Pakar<?php } ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= site_url('gejala/ubah/' . $item->id_gejala) ?>" class="btn btn-sm btn-info" title="Edit"><i class="ti ti-edit"></i></a>
                                                <a href="<?= site_url('gejala/delete/' . $item->id_gejala) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?');" class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></a>
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