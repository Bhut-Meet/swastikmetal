<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? $title : 'My Store'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="d-none d-md-block bg-light py-3 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <h4 class="m-0 fw-bold">🛍 MyStore</h4>
        <div>
            <?php if (!$this->session->userdata('user_id')): ?>
                <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-outline-dark">🔑 Login</a>
            <?php else: ?>
                <?php if ($this->session->userdata('user_role') === 'admin'): ?>
                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-outline-primary">🛠 Admin Panel</a>
                <?php else: ?>
                    <a href="<?php echo base_url('account'); ?>" class="btn btn-outline-dark">👤 My Account</a>
                <?php endif; ?>
                <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-outline-danger ms-2">🚪 Logout</a>
            <?php endif; ?>
            <a href="<?php echo base_url('cart'); ?>" class="btn btn-dark ms-2">🛒 Cart</a>
        </div>
    </div>
</header>

<nav class="d-md-none fixed-bottom bg-white border-top shadow-lg">
    <div class="d-flex justify-content-around text-center py-2 small fw-semibold">
        <a href="<?php echo base_url(); ?>" class="text-dark">🏠<br>Home</a>
        <a href="#" class="text-dark">🔍<br>Search</a>
        <a href="<?php echo base_url('cart'); ?>" class="text-dark">🛒<br>Cart</a>
        
        <?php if (!$this->session->userdata('user_id')): ?>
            <a href="<?php echo base_url('auth/login'); ?>" class="text-dark">🔑<br>Login</a>
        <?php else: ?>
            <?php if ($this->session->userdata('user_role') === 'admin'): ?>
                <a href="<?php echo base_url('admin/dashboard'); ?>" class="text-dark">🛠<br>Admin</a>
            <?php else: ?>
                <a href="<?php echo base_url('account'); ?>" class="text-dark">👤<br>Account</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</nav>
