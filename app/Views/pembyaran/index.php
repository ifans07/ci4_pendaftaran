<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>List of Pembayaran</h1>
        <a href="/pembayaran/create" class="btn btn-primary mb-3">Add New Pembayaran</a>
        <table id="pembayaranTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pasien ID</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pembayaran as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['pasien_id'] ?></td>
                        <td><?= $p['total_biaya'] ?></td>
                        <td><?= $p['status'] ?></td>
                        <td>
                            <a href="/pembayaran/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-<?= $p['id'] ?>" action="/pembayaran/delete/<?= $p['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $p['id'] ?>)">Delete</button>
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