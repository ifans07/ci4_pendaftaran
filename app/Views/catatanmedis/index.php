<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>List of Rekam Medis</h1>
        <a href="/catatanmedis/create" class="btn btn-primary mb-3">Add New Record</a>
        <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
            <?php endif;?>
        <table id="rekamMedisTable" class="table table-striped table-sm table-hover table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Pengobatan</th>
                    <th>Catatan</th>
                    <th>Keluhan</th>
                    <th>Diagnosis</th>
                    <th>Rencana Perawatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($rekam_medis as $rm): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $rm['nama_pasien'] ?></td>
                        <td><?= $rm['nama_dokter'] ?></td>
                        <td><?= $rm['tanggal_kunjungan'] ?></td>
                        <td><?= $rm['pengobatan'] ?></td>
                        <td><?= $rm['catatan'] ?></td>
                        <td><?= $rm['keluhan'] ?></td>
                        <td><?= $rm['diagnosa'] ?></td>
                        <td><?= $rm['rencana_perawatan'] ?></td>
                        <td>
                            <a href="/catatanmedis/edit/<?= $rm['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-<?= $rm['id'] ?>" action="/catatanmedis/delete/<?= $rm['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $rm['id'] ?>)">Delete</button>
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
            if (confirm("Are you sure you want to delete this record?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
</script>

<?= $this->endSection() ?>