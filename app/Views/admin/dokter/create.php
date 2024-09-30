<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
     <div class="container">
        <!-- <h1>Add New Doctor</h1> -->
        <a href="/admin/dokter" class="btn btn-secondary mb-4"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <form action="/admin/dokter/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for="name">Nama dokter</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-2">
                <label for="specialization">Spesialis</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>
            <div class="form-group mb-2">
                <label for="poli">Poli</label>
                <select name="poli" id="poli" class="form-select">
                    <option value="">--- Pilih Poli ---</option>
                    <?php foreach($poli as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama_poli'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Simpan Data</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>