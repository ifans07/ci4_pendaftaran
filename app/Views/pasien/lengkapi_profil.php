<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container mt-5">
        <!-- <h1>Lengkapi Profil</h1> -->
        <form method="post" action="/pasien/store_profile">
            <div class="form-group mb-1">
                <label for="name">NIK</label>
                <input type="text" class="form-control" id="name" name="nik" required>
            </div>
            <div class="form-group mb-1">
                <label for="nokk">No KK</label>
                <input type="text" class="form-control" id="nokk" name="nokk" required>
            </div>
            <div class="form-group mb-1">
                <label for="date_of_birth">Tanggal lahir</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="form-group mb-1">
                <label for="gender">Jenis Kelamin</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">--- Pilih Jenis Kelamin ---</option>
                    <option value="Laki laki">Laki laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group mb-1">
                <label for="nohp">No HP</label>
                <input type="text" class="form-control" id="nohp" name="nohp" required>
            </div>
            <div class="form-group">
                <label for="name">Alamat</label>
                <textarea name="alamat" id="nohp" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>