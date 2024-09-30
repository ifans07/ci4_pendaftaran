<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Dashboard</h1> -->
        <a href="/daftar/create" class="btn btn-dark fw-medium"><i class="fa-solid fa-stethoscope"></i> Daftar jalan</a>
        <!-- <a href="/jadwal/create" class="btn btn-dark">Janji temu</a> -->
        <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa-solid fa-user-plus"></i> Pasien Baru</a>
        <a href="/pasien/pasien_lama" class="btn btn-dark <?= (session()->get('nokk') == '0')? "disabled":"" ?>"><i class="fa-solid fa-user-gear"></i> Pasien Lama</a>
        <a href="/pasien/akun_keluarga" class="btn btn-dark"><i class="fa-solid fa-user-group"></i> Data Akun</a>
        <!-- <a href="/pasien/resetPassword" class="btn btn-dark">Reset Password</a>
        <a href="/auth/logout" class="btn btn-danger">Logout</a> -->
        
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif ?>

        <!-- daftar -->
        <h2 class="">Daftar antrian saat ini</h2>
        <div class="mb-5">
            <div class="container text-center">
                <div class="row row-cols-2 row-cols-lg-5 gap-2 g-lg-3">
                    <?php if(count($outpasientall) == 0): ?>
                        <div class="alert alert-info">
                            Belum ada antrian!
                        </div>
                    <?php endif ?>
                    <?php foreach($outpasientall as $row): ?>
                        <div class="col shadow rounded-3 text-white" style="<?= ($row['nama_pasien'] == session()->get('nama_pasien'))? 'background-color: #1abc9c':'background-color: #2c3e50' ?>">
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
            <div class="mt-4">
                <div>Keterangan:</div>
                <small>*Background warna <span class="fw-medium" style="background-color: #1abc9c; width: 40px; height: 40px; padding: 2px 12px;border-radius:5px;"> </span>&nbsp; merupakan Antrian saya</small>
            </div>
        </div>
        <table class="table table-sm table-striped table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No Antrian</th>
                    <th>Pasien</th>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($outpasientall as $pasien): ?>
                    <tr class="<?= ($pasien['nama_pasien'] == session()->get('nama_pasien'))? 'table-info':'' ?>">
                        <td><?= $pasien['no_antrian'] ?></td>
                        <td><?= $pasien['nama_pasien'] ?></td>
                        <td><?= $pasien['tanggal_daftar'] ?></td>
                        <td><?= $pasien['nama_dokter'] ?? 'Diisi admin' ?></td>
                        <td><?= $pasien['nama_poli'] ?></td>
                        <td><span class="badge bg-info">Menunggu</span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="">Riwayat</h2>
        <table class="table table-sm table-striped table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No Antrian</th>
                    <th>Pasien</th>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($riwayat_daftar as $rd): ?>
                <tr>
                    <td><?= $rd['no_antrian'] ?></td>
                    <td><?= $rd['nama_pasien'] ?></td>
                    <td><?= $rd['tanggal_daftar'] ?></td>
                    <td><?= $rd['nama_dokter'] ?></td>
                    <td><?= $rd['nama_poli'] ?></td>
                    <td><span class="badge bg-secondary">Terlewat</span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <form action="/pasien/store_pasienbaru" method="post">
                <?= csrf_field() ?>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pendaftaran pasien baru (keluarga)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <input type="hidden" name="idpasien" value="<?= session()->get('idpasien') ?>">
                <div class="">
                    <label for="namapasien" class="col-form-label">Nama Pasien:</label>
                    <input type="text" class="form-control" id="namapasien" name="namapasien">
                </div>
                <div class="">
                    <label for="nokk" class="col-form-label">No KK:</label>
                    <input type="text" class="form-control" id="nokk" name="nokk">
                </div>
                <div class="">
                    <label for="nik" class="col-form-label">NIK:</label>
                    <input type="text" class="form-control" id="nik" name="nik">
                </div>
                <div class="">
                    <label for="tgllahir" class="col-form-label">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                </div>
                <div class="">
                    <label for="tgllahir" class="col-form-label">Jenis Kelamin:</label>
                    <!-- <input type="text" class="form-control" id="tgllahir" name="tgllahir"> -->
                    <select name="jk" id="jk" class="form-select">
                        <option value="">--- Pilih Jenis ---</option>
                        <option value="Laki laki">Laki laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="">
                    <label for="message-text" class="col-form-label">Alamat:</label>
                    <textarea class="form-control" id="message-text" name="alamat"></textarea>
                </div>
                <div class="">
                    <label for="nohp" class="col-form-label">No HP/WA</label>
                    <input type="text" class="form-control" id="nohp" name="nohp">
                </div>
                <div class="">
                    <label for="bpjs" class="col-form-label">BPJS</label>
                    <!-- <input type="text" class="form-control" id="bpjs" name="bpjs"> -->
                    <select name="bpjs" id="bpjs" class="form-select">
                        <option value="">--- Pilih ---</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="" id="elbpjs">
                    <!-- <label for="nobpjs" class="col-form-label">No BPJS</label>
                    <input type="text" class="form-control" id="nobpjs" name="nobpjs"> -->
                </div>
                <div class="">
                    <label for="username" class="col-form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary fw-medium"><i class="fa-solid fa-save"></i> Simpan data</button>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    let bpjs = document.getElementById('bpjs')
    let elBpjs = document.getElementById('elbpjs')
    let label = document.createElement('label')
    label.setAttribute('for', 'nobpjs')
    label.textContent = "No BPJS"
    label.className = "col-form-label"

    let input = document.createElement('input')
    input.setAttribute('type', 'text')
    input.className = "form-control"
    input.id = "nobpjs"
    input.name = "nobpjs"

    let inputHidden = document.createElement('input')
    inputHidden.setAttribute('type', 'hidden')
    inputHidden.name = "nobpjs"
    inputHidden.value = "-"
    bpjs.addEventListener('change', function (e) {
        let isBpjs = this.value
        if(isBpjs == "Ya"){
            elBpjs.appendChild(label)
            elBpjs.appendChild(input)
        }else if(isBpjs == "Tidak"){
            label.remove()
            elBpjs.appendChild(inputHidden)
        }else{
            label.remove()
            input.remove()
        }
    })
</script>

<?= $this->endSection() ?>