<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <h1>Direct Outpatient Registration</h1>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="/daftar/store_direct_registration" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select class="form-control" name="patient_id" id="patient_id">
                    <?php foreach($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= $patient['nama_pasien'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select class="form-control" name="doctor_id" id="doctor_id">
                    <?php foreach($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>"><?= $doctor['nama_dokter'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="registration_date">Registration Date</label>
                <input type="date" class="form-control" name="registration_date" id="registration_date">
            </div>
            <div class="form-group">
                <label for="visit_reason">Visit Reason</label>
                <textarea class="form-control" name="visit_reason" id="visit_reason"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>