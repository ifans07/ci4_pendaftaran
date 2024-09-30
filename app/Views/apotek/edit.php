<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Edit Obat</h1>
        <form action="/apotek/update/<?= $apotek['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_obat">Nama Obat</label>
                <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= $apotek['nama_obat'] ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_obat">Jenis Obat</label>
                <input type="text" class="form-control" id="jenis_obat" name="jenis_obat" value="<?= $apotek['jenis_obat'] ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $apotek['harga'] ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= $apotek['stok'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Obat</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>