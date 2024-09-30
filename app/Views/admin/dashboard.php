<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Admin Dashboard</h1> -->
        <nav class="gap-1">
            <a class="btn btn-primary fw-medium" href="/admin/dashboard"><i class="fa-solid fa-dashboard"></i> Dashboard</a>
            <a class="btn btn-dark" href="datapasien"><i class="fa-solid fa-user-injured"></i> Data Pasien</a>
            <a class="btn btn-dark" href="dokter"><i class="fa-solid fa-user-doctor"></i> Data Dokter</a>
            <a class="btn btn-dark" href="/admin/poli"><i class="fa-solid fa-house-medical"></i> Data Poli</a>
            <a class="btn btn-dark" href="/admin/pending_registrations">Pendaftaran</a>
            <a class="btn btn-dark" href="/admin/create_outpatient">Ambil Antrian</a>
            <!-- <a class="" href="/admin/jadwal">Temu Dokter</a>
            <a class="" href="/catatanmedis">Rekam Medis</a> -->
            <!-- <a class="btn btn-dark" href="/resep">Resep</a> -->
            <!-- <a class="nav-item nav-link" href="/resepobat">Resep Obat</a> -->
            <!-- <a href="/admin/logout" class="nav-item btn btn-danger">Logout</a> -->
        </nav>
        <div class="mt-3">
            <h2>Welcome, <?= session()->get('username'); ?></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Pendaftaran Hari Ini</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $registrations_today ?></h5>
                            <p class="card-text">Jumlah pendaftaran hari ini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Pendaftaran Bulan Ini</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $registrations_month ?></h5>
                            <p class="card-text">Jumlah pendaftar bulan ini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Pendaftaran Terlewat</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $pending_count ?></h5>
                            <p class="card-text">Jumlah pendaftaran yang terlawat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container">
        <h1>Admin Dashboard</h1>
        <a href="/admin/create_outpatient" class="btn btn-primary mt-3">Create Outpatient Registration</a>
        <a href="/daftar/direct_daftar" class="btn btn-primary mt-3">Daftar antrian</a>
        <a href="/admin/pending_registrations" class="btn btn-primary mt-3">Daftar pending</a>
    </div> -->
    <div class="container mt-4">
        <h2>Informasi Antrian saat ini</h2>
        <!-- <small class="form-text">tidak datang/ kelewat</small> -->
        <table class="table table-striped table-sm table-hover dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations_now as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
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


    <div class="container mt-4">
        <h2 class="m-0 p-0">Pendaftaran sebelumnya</h2>
        <small class="form-text m-0 p-0">Pasien tidak datang/ terlewat ketika dipanggil</small>
        <table class="table table-striped table-sm table-hover dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th style="text-align:left">Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= $registration['nama_dokter'] ?></td>
                    <td style="text-align:left"><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <!-- <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-primary">Panggil</a> -->
                        <span class="badge bg-secondary">Terlewat</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="container mt-4">
        <h2>Pendaftaran Selesai</h2>
        <table class="table table-striped table-sm table-hover table-responsive-md dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th style="text-align:left">Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations_appr as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= $registration['nama_dokter'] ?></td>
                    <td style="text-align:left"><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <!-- <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-success">Approve</a> -->
                        <span class="badge bg-success">Selesai</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>

<?= $this->endSection() ?>