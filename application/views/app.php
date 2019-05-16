<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CIShop - Simple Codeigniter E-Commerce">
    <meta name="author" content="IDStack">
    <title><?= isset($title) ? $title : 'CIShop' ?> - Codeigniter E-Commerce</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('/assets/libs/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?= base_url('/assets/libs/fontawesome/css/all.min.css') ?>">
    <!-- Custom styles for this template -->
    <link href="<?= base_url('/assets/css/app.css') ?>" rel="stylesheet">
</head>
<body>

    <?php $this->load->view('layouts/_navbar'); ?>

	<!-- Content -->
	<?php $this->load->view($page); ?>
	<!-- End content -->

    <!-- JQuery -->
    <script src="<?= base_url('/assets/libs/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
	<script src="<?= base_url('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- Custom Script for This Template -->
	<script src="<?= base_url('/assets/js/app.js') ?>"></script>
</body>
</html>
