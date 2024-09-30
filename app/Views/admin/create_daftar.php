<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Create Outpatient Registration</h1> -->
        <a href="/admin/dashboard" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <div class="col shadow rounded-3 text-white text-center mx-auto" style="background-color: #1abc9c; width: 12rem;">
            <div class="p-3">
                <p class="fs-1 fw-bold" style="font-size: 72px;"><?= $antrian ?></p>
                <div class="lh-1">
                    <h5>No Antrian</h5>
                    <p>Poli</p>
                    <small class="form-text text-light"><?= date('Y-m-d') ?></small>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between rounded-3 shadow p-2 text-white mx-auto" style="background-color: #2c3e50; width: 12rem;">
            <label for="">Antrian Ke:</label>
            <span><?= $antrian ?></span>
        </div>
        <form action="/admin/store_outpatient" method="post" class="mt-3">
            <?= csrf_field() ?>
            <!-- <div class="d-flex align-items-center row border mb-3"> -->
                <!-- <label class="col-2" class="form-label">Antrian ke:</label> -->
                <input type="hidden" name="antrian" class="form-control-plaintext col" value="<?= $antrian ?>" readonly>
            <!-- </div> -->

            <div class="form-group mb-1">
                <label for="patient_id">Pasien</label>
                <select class="form-control" name="patient_id" id="patient_id">
                    <option value="">--- Pilih Pasien ---</option>
                    <?php foreach($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= $patient['nama_pasien'] ?> - <?= $patient['NIK'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="doctor_id">Dokter</label>
                <select class="form-control" name="doctor_id" id="doctor_id">
                    <option value="">--- Pilih Dokter ---</option>
                    <?php foreach($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>"><?= $doctor['nama_dokter'] ?> - <?= $doctor['keahlian'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="registration_date">Registration Date</label>
                <input type="date" class="form-control" name="registration_date" id="registration_date" value="<?= date('Y-m-d') ?>" readonly>
            </div>
            <div class="form-group mb-1">
                <label for="poli">Poli</label>
                <select class="form-control" name="poli" id="poli">
                    <option value="">--- Pilih Poli ---</option>
                    <?php foreach($poli as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_poli'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="visit_reason">Kenapa?</label>
                <textarea class="form-control" name="visit_reason" id="visit_reason"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Simpan Antrian</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>