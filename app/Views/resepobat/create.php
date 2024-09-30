<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Add New Resep</h1>
        <form action="/resepobat/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for="pasien_id">Pasien</label>
                <!-- <input type="text" class="form-control" id="pasien_id" name="pasien_id" required> -->
                <select name="pasien_id" class="form-select" id="pasien_id">
                    <option value="">--- Pilih Pasien ---</option>
                    <?php foreach($pasien as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_pasien'] ?> - <?= $row['NIK'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="dokter_id">Dokter</label>
                <!-- <input type="text" class="form-control" id="dokter_id" name="dokter_id" required> -->
                <select name="dokter_id" class="form-select" id="dokter_id">
                    <option value="">--- Pilih Dokter ---</option>
                <?php foreach($dokter as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama_dokter'] ?> - <?= $row['keahlian'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="dosis">Tanggal</label>
                <input type="date" class="form-control" name="tanggal">
            </div>
            <div class="form-group mb-2">
                <label for="dosis">Dosis</label>
                <input type="text" class="form-control" name="dosis">
            </div>
            <div class="form-group mb-2">
                <label for="resep">Resep</label>
                <textarea class="form-control" id="resep" name="resep" required></textarea>
            </div>
            <div class="form-group">
                <label for="instruksi">Instruksi</label>
                <input type="text" class="form-control" name="instruksi">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Resep</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>