<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #e2e8f0">
    <div class="container" style="width: 20rem;">
        <h1 class="text-center mb-3 fw-bold" style="color: #2c3e50">Admin Registration<span style="color: #1abc9c">.</span></h1>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="/admin/store_registration" method="post" class="shadow-sm rounded-3 bg-light p-3">
            <?= csrf_field() ?>
            <div class="form-group mb-1">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= old('username') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group mb-1">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Register</button>
        </form>
        <div class="mt-3">
            <!-- <a href="/admin/login" class="btn btn-secondary">Back to Login</a> -->
            <p>Sudah punya akun? <a href="/admin/login">Login</a></p>
        </div>
    </div>
</body>
</html>
