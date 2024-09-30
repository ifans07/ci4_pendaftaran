<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Update Data Patient</h1> -->
        <a href="/admin/datapasien" class="btn btn-secondary mb-4"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <form method="post" action="/admin/pasien/update/<?= $pasien['id'] ?>">
        <?= csrf_field() ?>
            
            <div class="form-group mb-1">
                <label for="name">Nama Pasien</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= $pasien['nama_pasien'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="nokk">No KK</label>
                <input type="text" class="form-control" id="nokk" name="nokk" required value="<?= $pasien['NOKK'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="dob">NIK</label>
                <input type="text" class="form-control" id="dob" name="dob" required value="<?= $pasien['NIK'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="dob">Tanggal Lahir</label>
                <input type="date" class="form-control" id="dob" name="tanggal_lahir" required value="<?= $pasien['tgl_lahir'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="gender">Jenis Kelamin</label>
                <select class="form-control" id="gender" name="gender" required>
                    <?php if($pasien['jenis_kelamin'] == 'Laki laki'): ?>
                        <option value="Laki laki" selected>Laki - laki</option>
                        <option value="Perempuan">Perempuan</option>
                    <?php else: ?>
                        <option value="Laki laki">Laki - laki</option>
                        <option value="Perempuan" selected>Perempuan</option>
                    <?php endif ?>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="address">alamat</label>
                <input type="text" class="form-control" id="address" name="address" required value="<?= $pasien['alamat'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="phone">No HP</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="<?= $pasien['nohp'] ?>">
            </div>
            <div class="form-group mb-1">
                <label for="username">Email</label>
                <input type="text" class="form-control" id="username" name="email" required value="<?= $pasien['email'] ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Edit Pasien</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>