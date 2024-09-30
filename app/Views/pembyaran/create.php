<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Add New Pembayaran</h1>
        <form action="/pembayaran/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="pasien_id">Pasien ID</label>
                <input type="text" class="form-control" id="pasien_id" name="pasien_id" required>
            </div>
            <div class="form-group">
                <label for="total_biaya">Total Biaya</label>
                <input type="number" class="form-control" id="total_biaya" name="total_biaya" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Pembayaran</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>