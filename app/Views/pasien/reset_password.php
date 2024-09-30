<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-4">
        <h1>Reset Password</h1>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mt-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/pasien/updatePassword">
            <div class="form-group mb-1">
                <label for="username">NIK</label>
                <input type="text" class="form-control" id="username" name="nik" required placeholder="Nomor Induk Keluarga">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Password</button>
        </form>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>