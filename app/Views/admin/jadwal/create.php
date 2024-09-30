<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <h1>Schedule Appointment</h1>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="/admin/jadwal/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-1">
                <label for="doctor_id">Pasien</label>
                <select class="form-control" name="pasien" id="doctor_id">
                    <!-- Isi dengan daftar dokter dari database -->
                    <option value="">--- Pilih Pasien ---</option>
                    <?php foreach($pasien as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_pasien'] ?> - <?= $row['NIK'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="doctor_id">Doctor</label>
                <select class="form-control" name="doctor_id" id="doctor_id">
                    <!-- Isi dengan daftar dokter dari database -->
                    <option value="">--- Pilih Dokter ---</option>
                    <?php foreach($dokters as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_dokter'] ?> - <?= $row['keahlian'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-1 row">
                <div class="col">
                    <label for="appointment_date">Appointment Date</label>
                    <input type="date" class="form-control" name="appointment_date" id="appointment_date">
                </div>
                <div class="col">
                    <label for="appointment_time">Appointment Time</label>
                    <input type="time" class="form-control" name="appointment_time" id="appointment_time" value="<?= date('H:i') ?>">
                </div>                
            </div>
            <div class="form-group mb-1">
                <label for="doctor_id">Poli</label>
                <select class="form-control" name="poli" id="doctor_id">
                    <!-- Isi dengan daftar dokter dari database -->
                    <option value="">--- Pilih Poli ---</option>
                    <?php foreach($poli as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_poli'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="reason_for_visit">Reason for Visit</label>
                <textarea class="form-control" name="reason_for_visit" id="reason_for_visit"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Schedule</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>