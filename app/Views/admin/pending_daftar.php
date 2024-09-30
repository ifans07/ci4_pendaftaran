<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>Pending Registrations</h1>
        <table class="table table-sm table-striped table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No antrian</th>
                    <th>Nama pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal daftar</th>
                    <th>Visit Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations as $registration): ?>
                <tr>
                    <th><?= $registration['no_antrian'] ?></th>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= $registration['nama_dokter'] ?></td>
                    <td><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-primary">Panggil</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h1>Approved Registrations</h1>
        <table class="table table-striped table-sm table-hover" id="approvedTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Daftar</th>
                    <th>Visit Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrationsapp as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= $registration['nama_dokter'] ?></td>
                    <td><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td><span class="badge bg-success">Selesai</span></td>
                    <!-- <td>
                        <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-success">Approve</a>
                    </td> -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>