<div class="container mt-5">
    <h3 class="text-center">Register</h3>
    <form method="post">
        <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <input type="text" name="mobile" class="form-control mb-2" placeholder="Mobile">
        <button class="btn btn-success btn-block">Register</button>
        <p class="text-center mt-2">Already registered? <a href="<?= base_url('auth/login') ?>">Login</a></p>
    </form>
</div>
