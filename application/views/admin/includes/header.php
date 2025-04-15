<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Admin Panel' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin/dashboard') ?>">🛠 Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/product') ?>">📦 Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>">🚪 Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('home') ?>">🚪 Client home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
