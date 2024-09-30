<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>List of Poli</h1> -->
        <a href="/admin/dashboard" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <a href="/admin/poli/create" class="btn btn-primary mb-3 fw-medium"><i class="fa-solid fa-plus"></i> Tambah Poli</a>
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>
        <table class="table table-striped table-sm table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <!-- <th>Description</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($poli as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nama_poli'] ?></td>
                        
                        <td>
                            <a href="/admin/poli/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Edit</a>
                            <form id="delete-form-<?= $p['id'] ?>" action="/admin/poli/delete/<?= $p['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $p['id'] ?>)"><i class="fa-solid fa-trash"></i> Hapus</button>
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
            if (confirm("Are you sure you want to delete this poli?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

<?= $this->endSection() ?>