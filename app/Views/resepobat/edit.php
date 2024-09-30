<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Edit Resep</h1>
        <form action="/resep_obat/update/<?= $resep_obat['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="pasien_id">Pasien ID</label>
                <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="<?= $resep_obat['pasien_id'] ?>" required>
            </div>
            <div class="form-group">
                <label for="dokter_id">Dokter ID</label>
                <input type="text" class="form-control" id="dokter_id" name="dokter_id" value="<?= $resep_obat['dokter_id'] ?>" required>
            </div>
            <div class="form-group">
                <label for="resep">Resep</label>
                <textarea class="form-control" id="resep" name="resep" required><?= $resep_obat['resep'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Belum Diambil" <?= $resep_obat['status'] == 'Belum Diambil' ? 'selected' : '' ?>>Belum Diambil</option>
                    <option value="Sudah Diambil" <?= $resep_obat['status'] == 'Sudah Diambil' ? 'selected' : '' ?>>Sudah Diambil</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Resep</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>