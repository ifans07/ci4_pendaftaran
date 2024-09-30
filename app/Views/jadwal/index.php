<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <h1>My Appointments</h1>
        <a href="/pasien" class="btn btn-secondary mb-3">Halaman utama</a>
        <table class="table table-striped table-sm table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Reason</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($appointments as $appointment): ?>
                <tr>
                    <td><?= $appointment['tanggal'] ?></td>
                    <td><?= $appointment['jam'] ?></td>
                    <td><?= $appointment['nama_dokter'] ?></td>
                    <td><?= $appointment['nama_poli'] ?></td>
                    <td><?= $appointment['alasan'] ?></td>
                    <td>
                        <?php if($appointment['status'] == 'scheduled'): ?>
                            <a href="/jadwal/setStatus/<?= $appointment['id'] ?>/cancelled" class="btn btn-warning btn-sm">Batalkan</a>
                        <?php elseif($appointment['status'] == 'completed'): ?>
                            <span class="badge bg-success">Selesai</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Dibatalkan</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>