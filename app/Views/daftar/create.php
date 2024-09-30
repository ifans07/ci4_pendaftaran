<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Daftar Rawat Jalan</h1> -->
        <a href="/pasien" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <div class="col shadow rounded-3 text-white text-center mx-auto" style="background-color: #1abc9c; width: 12rem;">
            <div class="p-3">
                <p class="fs-1 fw-bold" style="font-size: 72px;"><?= $antrian ?></p>
                <div class="lh-1">
                    <h5><?= session()->get('nama_pasien') ?></h5>
                    <p id="setPoli">Poli</p>
                    <small class="form-text text-light"><?= date('Y-m-d') ?></small>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between rounded-3 shadow p-2 text-white mx-auto" style="background-color: #2c3e50; width: 12rem;">
            <label for="">Antrian Ke:</label>
            <span><?= $antrian ?></span>
        </div>
        <form action="/daftar/store" method="post" class="mt-3">
            <?= csrf_field() ?>
            <!-- <div class="d-flex align-items-center row border mb-3"> -->
                <!-- <label class="col-2" class="form-label">Antrian ke:</label> -->
                <input type="hidden" name="antrian" class="form-control-plaintext col" value="<?= $antrian ?>" readonly>
            <!-- </div> -->
            <!-- <div class="form-group mb-1"> -->
                <!-- <label for="registration_date">Registration Date</label> -->
                <input type="hidden" class="form-control" name="registration_date" id="registration_date" value="<?= date('Y-m-d') ?>">
            <!-- </div> -->
            <div class="mb-1">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <!-- <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= session()->get('nama_pasien') ?>" readonly required> -->
                <select name="nama_pasien" id="nama_pasien" class="form-select" required>
                    <option value="">--- Pilih Pasien di Akun ini ---</option>
                    <?php foreach($pasien_combine as $pc): ?>
                        <option value="<?= $pc['id'] ?>"><?= $pc['nama_pasien'] ?> - <?= $pc['nik'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="poli">Poli</label>
                <select class="form-select" name="poli" id="poli">
                    <option value="">--- Pilih Poli ---</option>
                    <?php foreach($poli as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_poli'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="visit_reason">Kenapa?</label>
                <textarea class="form-control" name="visit_reason" id="visit_reason"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-save"></i> Ambil Antrian</button>
        </form>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('#poli').on('change', function(){
            let idPoli = $(this).val()
            let namaPoli = $('#poli option:selected').text()
            $('#setPoli').html(namaPoli)
            $.ajax({
                url: "<?= base_url('dokter/get_data_dokter') ?>",
                method: "POST",
                data: {poli: idPoli},
                dataType: 'JSON',
                success: function(d){
                    console.log(d)
                }
            })
        })
    })
</script>

<?= $this->endSection() ?>