<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Add New Record</h1>
        <form action="/catatanmedis/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-2">
                <label for="pasien_id">Pasien ID</label>
                <!-- <input type="text" class="form-control" id="pasien_id" name="pasien_id" required> -->
                <select name="pasien_id" id="pasien_id" class="form-select" required>
                    <option value="">--- Pilih Pasien ---</option>
                    <?php foreach($pasien as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_pasien'] ?> - <?= $row['NIK'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="dokter_id">Dokter ID</label>
                <!-- <input type="text" class="form-control" id="dokter_id" name="dokter_id" required> -->
                <select name="dokter_id" id="dokter_id" class="form-select" required>
                    <option value="">--- Pilih Dokter ---</option>
                    <?php foreach($dokter as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_dokter'] ?> - <?= $row['keahlian'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="tanggal">Tanggal Kunjungan</label>
                <input type="date" class="form-control" name="tanggal_kunjungan">
            </div>
            <div class="form-group mb-2">
                <label for="tanggal">Pengobatan</label>
                <input type="text" class="form-control" name="pengobatan">
            </div>
            <div class="form-group mb-2">
                <label for="keluhan">Keluhan</label>
                <textarea class="form-control" id="keluhan" name="keluhan" required></textarea>
            </div>
            <div class="form-group mb-2">
                <label for="diagnosis">Diagnosis</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" required></textarea>
            </div>
            <div class="form-group mb-2">
                <label for="rencana_perawatan">Rencana Perawatan</label>
                <textarea class="form-control" id="rencana_perawatan" name="rencana_perawatan" required></textarea>
            </div>
            <div class="form-group">
                <label for="rencana_perawatan">Catatan (optional)</label>
                <textarea class="form-control" id="rencana_perawatan" name="catatan" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Record</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>