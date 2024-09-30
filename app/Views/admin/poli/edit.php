<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Edit Poli</h1> -->
        <a href="/admin/poli" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <form action="/admin/poli/update/<?= $poli['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $poli['nama_poli'] ?>" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Edit Poli</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>