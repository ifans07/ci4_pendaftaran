<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-3">
        <h1>Appointment List</h1>
        <a href="/admin/jadwal/create" class="btn btn-primary mb-3">Add New Appointment</a>
        <a href="/admin/create_pasien" class="btn btn-primary mb-3">Add New Pasien</a>
        <table class="table table-striped table-sm table-hover rounded" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Temu</th>
                    <th>Waktu Temu</th>
                    <th>Poli</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['id'] ?></td>
                        <td><?= $appointment['nama_pasien'] ?></td>
                        <td><?= $appointment['nama_dokter'] ?></td>
                        <td><?= $appointment['tanggal'] ?></td>
                        <td><?= $appointment['jam'] ?></td>
                        <td><?= $appointment['nama_poli'] ?></td>
                        <td><?= $appointment['alasan'] ?></td>
                        <td><?= ucfirst($appointment['status']) ?></td>
                        <td>
                            <?php if ($appointment['status'] == 'scheduled'): ?>
                                <a href="/admin/jadwal/setStatus/<?= $appointment['id'] ?>/completed" class="btn btn-success btn-sm">Complete</a>
                                <a href="/admin/jadwal/setStatus/<?= $appointment['id'] ?>/cancelled" class="btn btn-danger btn-sm">Cancel</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h1>Riwayat</h1>
        <table class="table table-striped table-sm table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Temu</th>
                    <th>Waktu Temu</th>
                    <th>Poli</th>
                    <th>Alasan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments_status as $appointment): ?>
                    <tr>
                        <td><?= $appointment['id'] ?></td>
                        <td><?= $appointment['nama_pasien'] ?></td>
                        <td><?= $appointment['nama_dokter'] ?></td>
                        <td><?= $appointment['tanggal'] ?></td>
                        <td><?= $appointment['jam'] ?></td>
                        <td><?= $appointment['nama_poli'] ?></td>
                        <td><?= $appointment['alasan'] ?></td>
                        <td>
                            <?php if($appointment['status'] == 'completed'): ?>
                                <span class="badge bg-success"><?= ucfirst($appointment['status']) ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?= ucfirst($appointment['status']) ?></span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>