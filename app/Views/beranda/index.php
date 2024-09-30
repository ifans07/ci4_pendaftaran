<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <div class="mb-4" style="">
            <a href="/auth/login" class="btn btn-dark fw-medium" style="background-color: #2c3e50"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
            <a href="/auth/register" class="btn btn-dark" style="background-color: #2c3e50"><i class="fa-solid fa-clipboard-user"></i> Daftar</a>
        </div>
        <div class="header lh-1">
            <p class="fs-1 fw-medium"><i class="fa-solid fa-list-check"></i> Informasi Antrian Pasien</p>
            <small class="form-text">Saat ini <?= date('Y-m-d') ?> menunggu dipanggil</small>
        </div>
        <div class="mt-3">
            <div class="container text-center">
                        <div class="row row-cols-2 row-cols-lg-5 gap-2 g-lg-3">
                            <?php if(count($antrian) == 0): ?>
                                <div class="alert alert-info">
                                    Belum ada antrian!
                                </div>
                            <?php endif ?>
                            <?php foreach($antrian as $row): ?>
                                <div class="col shadow rounded-3 text-white" style="background-color: #1abc9c">
                                    <div class="p-3">
                                        <p class="fs-1 fw-bold"><?= $row['no_antrian'] ?></p>
                                        <div class="lh-1">
                                            <h5><?= $row['nama_pasien'] ?></h5>
                                            <p><?= $row['nama_poli'] ?></p>
                                            <small class="form-text text-light"><?= $row['tanggal_daftar'] ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
        </div>
    </div>
</section>


<?= $this->endSection('') ?>