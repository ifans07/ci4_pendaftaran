<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>List of Resep Obat</h1>
        <a href="/resepobat/create" class="btn btn-primary mb-3">Add New Resep</a>
        <table id="resepObatTable" class="table table-hover table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Resep</th>
                    <th>Dosis</th>
                    <th>Instruksi</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($resep_obat as $ro): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $ro['nama_pasien'] ?></td>
                        <td><?= $ro['nama_dokter'] ?></td>
                        <td><?= $ro['tanggal'] ?></td>
                        <td><?= $ro['pengobatan'] ?></td>
                        <td><?= $ro['dosis'] ?></td>
                        <td><?= $ro['instruksi'] ?></td>
                        <td><?= $ro['status'] ?></td>
                        <td>
                            <a href="/resepobat/edit/<?= $ro['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-<?= $ro['id'] ?>" action="/resepobat/delete/<?= $ro['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $ro['id'] ?>)">Delete</button>
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