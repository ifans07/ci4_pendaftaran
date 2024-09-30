<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<?php 

    $resepPisah = explode(' ',$resep['tanggal']);
    $resepTanggal = explode('-', $resepPisah[0]);
    $resepWaktu = explode(':', $resepPisah[1]);
    $resepGabungTanggal = implode($resepTanggal);
    $resepGabungWaktu = implode($resepWaktu);

    $noResep = 'A'. $resepGabungTanggal . $resep['id'] . $resepGabungWaktu .'Z';

?>

<section>
    <div class="container">
        <h1>Detail Resep dan Rekam Medis</h1>
<table class="" style="width: 50%">
    <tr>
        <th>No Resep</th>
        <td><?= $noResep ?></td>
    </tr>
    <tr>
        <th>Nama Pasien</th>
        <td><?= $resep['nama_pasien'] ?></td>
    </tr>
    <tr>
        <th>Nama Dokter</th>
        <td><?= $resep['nama_dokter'] ?></td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td><?= $resep['tanggal'] ?></td>
    </tr>
</table>

<h2>Obat yang Diresepkan</h2>
<table class="" style="width: 75%">
    <thead>
        <tr>
            <th>Nama Obat</th>
            <th>Dosis</th>
            <th>Instruksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resep_obat as $ro): ?>
        <tr>
            <td><?= $ro['nama_obat'] ?></td>
            <td><?= $ro['dosis'] ?></td>
            <td><?= $ro['instruksi'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Rekam Medis</h2>
<table class="" style="width: 100%">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keluhan</th>
            <th>Diagnosis</th>
            <th>Rencana Perawatan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rekam_medis as $rm): ?>
        <tr>
            <td><?= $rm['tanggal'] ?></td>
            <td><?= $rm['keluhan'] ?></td>
            <td><?= $rm['diagnosa'] ?></td>
            <td><?= $rm['rencana_perawatan'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/resep" class="btn btn-primary mt-5">Kembali</a>
    </div>
</section>

<?= $this->endSection() ?>
