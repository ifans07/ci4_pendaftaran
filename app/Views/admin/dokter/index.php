<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>List of Doctors</h1> -->
        <a href="/admin/dashboard" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <a href="dokter/create" class="btn btn-primary mb-3 fw-medium"><i class="fa-solid fa-plus"></i> Tambah Dokter</a>
        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <table class="table table-striped table-sm table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Poli</th>
                    <th>No HP/ WA</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($doctors as $doctor): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $doctor['nama_dokter'] ?></td>
                        <td><?= $doctor['keahlian'] ?></td>
                        <td><?= $doctor['nama_poli'] ?></td>
                        <td><?= $doctor['nohp'] ?></td>
                        <td><?= $doctor['email'] ?></td>
                        <td>
                            <a href="/admin/dokter/edit/<?= $doctor['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Edit</a>
                            <!-- <form action="/admin/dokter/delete/<?= $doctor['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> -->
                            <form id="delete-form-<?= $doctor['id'] ?>" action="/admin/dokter/delete/<?= $doctor['id'] ?>" method="post" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $doctor['id'] ?>)"><i class="fa-solid fa-trash"></i> Hapus</button>
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
            if (confirm("Are you sure you want to delete this doctor?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

<?= $this->endSection() ?>