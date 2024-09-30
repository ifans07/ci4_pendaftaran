<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Add New Patient</h1> -->
        <a href="/admin/datapasien" class="btn btn-secondary mb-3"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <form method="post" action="/admin/store_pasien">
        <?= csrf_field() ?>
            <div class="form-group mb-1">
                <label for="name">Nama Pasien</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-1">
                <label for="nokk">No. KK</label>
                <input type="text" class="form-control" id="nokk" name="nokk" required>
            </div>
            <div class="form-group mb-1">
                <label for="dob">NIK</label>
                <input type="text" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="form-group mb-1">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group mb-1">
                <label for="gender">Jenis Kelamin</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Laki laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="address">alamat</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group mb-1">
                <label for="phone">No HP</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group mb-1">
                <label for="username">Email</label>
                <input type="text" class="form-control" id="username" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 fw-medium"><i class="fa-solid fa-save"></i> Simpan Pasien</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>