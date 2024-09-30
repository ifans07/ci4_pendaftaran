<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <a href="/pasien" class="btn btn-secondary mb-4"><i class="fa-solid fa-angles-left"></i> Kembali</a>
        <!-- akun utama -->
        <div>
            <div class="mb-2">
                <span class="fs-1 fw-medium">Akun Utama</span>
            </div>
            <div class="d-flex gap-3 p-3">
                <div class="rounded-circle d-flex justify-content-center align-items-center text-white" style="background-color: #1abc9c;width: 50px; height: 50px;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <h5><?= $pasien['nama_pasien'] ?></h5>
                    <div>
                        <table>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><?= $pasien['NIK'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $pasien['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><?= $pasien['tgl_lahir'] ?></td>
                            </tr>
                                <td>No Hp/ WA</td>
                                <td>:</td>
                                <td><?= $pasien['nohp'] ?></td>
                            </tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?= $pasien['email'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- akun pendamping -->
        <div class="mt-4">
            <div class="mb-2">
                <span class="fs-1 fw-medium">Akun Keluarga</span>
            </div>
            <div class="d-flex gap-3">
                <?php foreach($second_pasien as $sc): ?>
                <div class="d-flex gap-3 shadow p-3 rounded" style="width: 18rem">
                    <div class="rounded-circle d-flex justify-content-center align-items-center p-3 text-white" style="background-color: #1abc9c;width: 50px; height: 50px;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h5><?= $sc['nama_pasien'] ?></h5>
                        <div class="d-flex flex-column">
                            <small><?= $sc['nik'] ?></small>
                            <small><?= $sc['alamat'] ?></small>
                            <small><?= $sc['nohp'] ?></small>
                            <small><?= $sc['email'] ?></small>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                <a href="" class="d-flex gap-3 shadow p-3 rounded" style="width: 18rem;background-color: #1abc9c; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <div class="rounded d-flex justify-content-center align-items-center p-3 text-white" style="width: 100%; height: 100%">
                        <i class="fa-solid fa-plus fs-1"></i>
                    </div>
                </a>
            </div>
        </div>
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