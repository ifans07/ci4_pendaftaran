<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <h1>Riwayat pendaftaran</h1>
        <a href="/pasien" class="btn btn-secondary mb-3"><i class="fa-solid fa-house"></i> Halaman utama</a>
        <table class="table table-sm table-hover table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No antrian</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Poli</th>
                    <th>Visit Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['nama_dokter'] ?></td>
                    <td><?= $registration['nama_poli'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <?php if($registration['approved'] == 0): ?>
                            <span class="badge bg-warning">Menunggu</span>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>