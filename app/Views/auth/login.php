<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #e2e8f0">
    <div class="container" style="width: 20rem;">
        <h1 class="text-center mb-3 fw-bolder" style="color: #2c3e50">Login<span style="color: #1abc9c">.</span></h1>
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif;?>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <form action="/auth/loginAuth" method="post" class="shadow-sm rounded-3 p-3 bg-light">
            <?= csrf_field() ?>
            <div class="form-group mb-1">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
        </form>
        <div class="mt-3">
            <p>Belum punya akun? <a href="/auth/register">Register</a></p>
        </div>
    </div>
</body>
</html>
