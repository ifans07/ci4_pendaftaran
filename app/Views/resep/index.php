<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <h1>Daftar Resep</h1>
<a href="/resep/create" class="btn btn-primary">Tambah Resep</a>
<?php if(session()->getFlashdata('msg')): ?>
    <div class="alert alert-success mt-3">
        <?= session()->getFlashdata('msg') ?>
    </div>
<?php endif ?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Nama Dokter</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($resep as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['nama_pasien'] ?></td>
            <td><?= $r['nama_dokter'] ?></td>
            <td><?= $r['tanggal'] ?></td>
            <td>
                <a href="/resep/show/<?= $r['id'] ?>" class="btn btn-info">Lihat</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</section>

<?= $this->endSection() ?>
