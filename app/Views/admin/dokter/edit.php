<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Edit Doctor</h1> -->
        <a href="/admin/dokter" class="btn btn-secondary mb-4"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <form action="/admin/dokter/update/<?= $doctor['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for="name">Nama Dokter</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $doctor['nama_dokter'] ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="specialization">Spesialis</label>
                <input type="text" class="form-control" id="specialization" name="specialization" value="<?= $doctor['keahlian'] ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="poli">Poli</label>
                <select name="poli" id="poli" class="form-select">
                    <option value="">--- Pilih Poli ---</option>
                    <?php foreach($poli as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= ($p['id'] == $doctor['id_poli'])? 'selected':'' ?>><?= $p['nama_poli'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $doctor['nohp'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $doctor['email'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Update Dokter</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>