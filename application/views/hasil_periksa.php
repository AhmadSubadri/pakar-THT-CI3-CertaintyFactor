<!-- Bagian view untuk menampilkan hasil konsultasi -->
<section class="intro-single" style="background-image: -webkit-linear-gradient(0deg, #ffffff 0%, #ffffff 100%) !important; padding:60px 120px;" id="printTable">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Hasil Konsultasi</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Hasil Konsultasi</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <ul class="list-inline text-center color-a">
                    <li class="list-inline-item mr-2">
                        <span class="color-text-a"><b>Data Diri :</b></span>
                    </li>
                </ul>
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th><b>Nama</b></th>
                            <th><?= $biodata->nama ?></th>
                        </tr>
                        <tr>
                            <th><b>Usia (dalam tahun)</b></th>
                            <th><?= $biodata->usia; ?></th>
                        </tr>
                        <tr>
                            <th><b>Alamat</b></th>
                            <th><?= $biodata->alamat; ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <ul class="list-inline text-center color-a">
                    <li class="list-inline-item mr-2">
                        <span class="color-text-a"><b>Gejala yang Anda pilih :</b></span>
                    </li>
                </ul>
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode gejala</th>
                            <th>Nama Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tGejala->result_array() as $gejala) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php echo $gejala['kode_gejala']; ?></td>
                                <td><?php echo $gejala['nama_gejala']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <ul class="list-inline text-center color-a">
                    <li class="list-inline-item mr-2">
                        <span class="color-text-a"><b>Hasil Konsultasi :</b></span>
                    </li>
                </ul>
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th><b>No</b></th>
                            <th><b>Nama Penyakit</b></th>
                            <th><b>Tingkat Kepercayaan</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($hasil as $value) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value['nama_penyakit'] ?></td>
                                <td><?= round($value['cfPersentase'], 2) ?> %</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <ul class="list-inline text-center color-a">
                    <li class="list-inline-item mr-2">
                        <span class="color-text-a"><b>Kesimpulan :</b></span>
                    </li>
                </ul>
                <div class="color-text-a">
                    <p>
                        Berdasarkan gejalanya, pasien diprediksi mengidap penyakit <b><?= $output['nama_penyakit']; ?></b> dengan tingkat kepercayaan <b><?= round($output['cfPersentase'], 2); ?> %</b>.<br>
                        <b><?= $output['keterangan']; ?></b>
                    </p>
                    <p style="font-style: bold; color: red; font-size: 13px;">*Hasil konsultasi ini masih membutuhkan pemeriksaan lebih lanjut.</p>
                </div>
                <div class="box-footer clearfix">
                    <button class="btn btn-sm btn-flat pull-right" style="background: #67CDFF; color: white; margin-right:10px;" onclick="printData()">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function printData() {
        var
            divToPrint = document.getElementById('printTable');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    $('button').on('click', function() {
        printData();
    })
</script>