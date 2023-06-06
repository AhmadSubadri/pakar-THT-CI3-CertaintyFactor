<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sispak | THT, Sistem pakar Diagnosis</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/asset/img/favicons/icon.ico">
    <link rel="manifest" href="<?= base_url() ?>assets/asset/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/asset/img/favicons/mstile-150x150.png">
    <link href="<?= base_url() ?>assets/asset/css/theme.css" rel="stylesheet" />
</head>


<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="<?= site_url(''); ?>"><img src="<?= base_url() ?>assets/asset/img/gallery/logo_1.png" width="100%" height="50px" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                        <li class="nav-item px-2"><a class="nav-link <?php if ($this->uri->uri_string() == "") {
                                                                            echo "active";
                                                                        } ?>" aria-current="page" href="<?= site_url(''); ?>">Home</a></li>
                        <li class="nav-item px-2"><a class="nav-link <?php if ($this->uri->uri_string() == "periksa") {
                                                                            echo "active";
                                                                        } ?>" href="<?= site_url('periksa'); ?>">Periksa</a></li>
                        <li class="nav-item px-2"><a class="nav-link <?php if ($this->uri->uri_string() == "kontak") {
                                                                            echo "active";
                                                                        } ?>" href="<?= site_url('kontak'); ?>">Kontak</a></li>
                    </ul><a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4" href="<?= site_url('login'); ?>">Sign In</a>
                </div>
            </div>
        </nav>