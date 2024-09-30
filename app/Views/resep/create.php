<?= $this->extend('templates/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container">
        <h1>Tambah Resep</h1>
<form action="/resep/store" method="post">
    <div class="form-group mb-2">
        <label for="pasien_id">Nama Pasien:</label>
        <select class="form-control" id="pasien_id" name="pasien_id">
            <option value="">--- Pilih Pasien ---</option>
            <?php foreach ($pasien as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama_pasien'] ?> - <?= $p['NIK'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label for="dokter_id">Nama Dokter:</label>
        <select class="form-control" id="dokter_id" name="dokter_id">
            <option value="">--- Pilih Dokter ---</option>
            <?php foreach ($dokter as $d): ?>
            <option value="<?= $d['id'] ?>"><?= $d['nama_dokter'] ?> - <?= $d['keahlian'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
    </div>
    <div class="form-group">
        <label for="obat_id">Obat:</label>
        <select class="form-control" id="obat_id" name="obat_id[]">
            <option value="">--- Pilih Obat ---</option>
            <?php foreach ($obat as $o): ?>
            <option value="<?= $o['id'] ?>"><?= $o['nama_obat'] ?> - <?= $o['jenis_obat'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="dosis">Dosis:</label>
        <input type="text" class="form-control" id="dosis" name="dosis[]">
        <label for="instruksi">Instruksi</label>
        <input type="text" class="form-control" id="instruksi" name="instruksi[]">
    </div>
    <div class="mt-3">
    </div>
        <button type="button" id="add-more" class="btn btn-secondary">Tambah Obat</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    </div>
</section>

<script>
document.getElementById('add-more').addEventListener('click', function () {
    var formGroup = document.createElement('div');
    formGroup.className = 'form-group';
    formGroup.innerHTML = `
        <label for="obat_id">Obat:</label>
        <select class="form-control" name="obat_id[]">
            <option>--- Pilih Obat ---</option>
            <?php foreach ($obat as $o): ?>
            <option value="<?= $o['id'] ?>"><?= $o['nama_obat'] ?> - <?= $o['jenis_obat'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="dosis">Dosis:</label>
        <input type="text" class="form-control" name="dosis[]">
        <label for="instruksi">Instruksi</label>
        <input type="text" class="form-control" name="instruksi[]">
        <div class="mb-3"></div>
    `;
    document.querySelector('form').insertBefore(formGroup, this);
});
</script>
<?= $this->endSection() ?>
