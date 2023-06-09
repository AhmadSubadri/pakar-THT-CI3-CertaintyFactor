<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sispak | THT, Sistem pakar Diagnosis  </title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/asset/img/favicons/icon.png">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboard/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" style="background-color: #F1F4F6;">
        <?php $this->load->view('admin/partials/sidebar.php'); ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <?php $this->load->view('admin/partials/header.php'); ?>
            <!--  Header End -->
            <div class="container-fluid">