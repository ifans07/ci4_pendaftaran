<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Edit Pembayaran</h1>
        <form action="/pembayaran/update/<?= $pembayaran['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="pasien_id">Pasien ID</label>
                <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="<?= $pembayaran['pasien_id'] ?>" required>
            </div>
            <div class="form-group">
                <label for="total_biaya">Total Biaya</label>
                <input type="number" class="form-control" id="total_biaya" name="total_biaya" value="<?= $pembayaran['total_biaya'] ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Belum Lunas" <?= $pembayaran['status'] == 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                    <option value="Lunas" <?= $pembayaran['status'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Pembayaran</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>