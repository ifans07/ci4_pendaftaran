<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Patient List</h1> -->
        <a href="/admin/dashboard" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <a href="/admin/create_pasien" class="btn btn-primary mb-3 fw-medium"><i class="fa-solid fa-plus"></i> Tambah Pasien</a>
        <a href="/admin/create_outpatient" class="btn btn-primary mb-3"><i class="fa-solid fa-stethoscope"></i> Daftar jalan</a>
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif ?>
        <table class="table table-striped table-sm table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>Nama Pasien</th>
                    <th>No. KK</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= $patient['nama_pasien'] ?></td>
                        <td><?= $patient['NOKK'] ?></td>
                        <td><?= $patient['NIK'] ?></td>
                        <td><?= $patient['jenis_kelamin'] ?></td>
                        <td><?= $patient['tgl_lahir'] ?></td>
                        <td><?= $patient['alamat'] ?></td>
                        <td><?= $patient['nohp'] ?></td>
                        <td><?= $patient['email'] ?></td>
                        <td>
                            <a href="/admin/pasien/edit/<?= $patient['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Edit</a>
                            <form id="delete-form-<?= $patient['id'] ?>" action="/admin/pasien/delete/<?= $patient['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $patient['id'] ?>)"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this patient?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<?= $this->endSection() ?>