<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <h1>List of Apotek</h1>
        <a href="/apotek/create" class="btn btn-primary mb-3">Add New Obat</a>
        <table id="apotekTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Jenis Obat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($apotek as $a): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= $a['nama_obat'] ?></td>
                        <td><?= $a['jenis_obat'] ?></td>
                        <td><?= $a['harga'] ?></td>
                        <td><?= $a['stok'] ?></td>
                        <td>
                            <a href="/apotek/edit/<?= $a['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form id="delete-form-<?= $a['id'] ?>" action="/apotek/delete/<?= $a['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $a['id'] ?>)">Delete</button>
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