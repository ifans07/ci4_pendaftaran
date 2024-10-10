<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <!-- <h1>Admin Dashboard</h1> -->
        <nav class="gap-1">
            <a class="btn btn-primary fw-medium" href="/admin/dashboard"><i class="fa-solid fa-dashboard"></i> Dashboard</a>
            <a class="btn btn-dark" href="datapasien"><i class="fa-solid fa-user-injured"></i> Data Pasien</a>
            <a class="btn btn-dark" href="dokter"><i class="fa-solid fa-user-doctor"></i> Data Dokter</a>
            <a class="btn btn-dark" href="/admin/poli"><i class="fa-solid fa-house-medical"></i> Data Poli</a>
            <!-- <a class="btn btn-dark" href="/admin/pending_registrations">Pendaftaran</a> -->
            <a class="btn btn-dark" href="/admin/create_outpatient">Ambil Antrian</a>
            <!-- <a class="" href="/admin/jadwal">Temu Dokter</a>
            <a class="" href="/catatanmedis">Rekam Medis</a> -->
            <!-- <a class="btn btn-dark" href="/resep">Resep</a> -->
            <!-- <a class="nav-item nav-link" href="/resepobat">Resep Obat</a> -->
            <!-- <a href="/admin/logout" class="nav-item btn btn-danger">Logout</a> -->
        </nav>
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success mt-3">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div class="mt-3">
            <h2>Selamat datang, <?= session()->get('username'); ?></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Pendaftaran Hari Ini</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $registrations_today ?></h5>
                            <p class="card-text">Jumlah pendaftaran hari ini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Pendaftaran Bulan Ini</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $registrations_month ?></h5>
                            <p class="card-text">Jumlah pendaftar bulan ini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Pendaftaran Terlewat</div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $pending_count ?></h5>
                            <p class="card-text">Jumlah pendaftaran yang terlawat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container">
        <h1>Admin Dashboard</h1>
        <a href="/admin/create_outpatient" class="btn btn-primary mt-3">Create Outpatient Registration</a>
        <a href="/daftar/direct_daftar" class="btn btn-primary mt-3">Daftar antrian</a>
        <a href="/admin/pending_registrations" class="btn btn-primary mt-3">Daftar pending</a>
    </div> -->
    <div class="container mt-4">
        <h2>Informasi Antrian saat ini</h2>
        <!-- <small class="form-text">tidak datang/ kelewat</small> -->
        <table class="table table-striped table-sm table-hover dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter/Poli</th>
                    <th>Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations_now as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= ($registration['id_dokter'] == "0")?"<span class='badge bg-warning'>belum dipilih</span>":$registration['nama_dokter'] ?>/<?= $registration['nama_poli'] ?></td>
                    <td><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <?= $registration['approved'] == 0 ? '<span class="badge bg-warning">Menunggu</span>' : '<span class="badge bg-success">Disetujui</span>' ?>
                    </td>
                    <td>
                        <?php if($registration['approved'] == 0): ?>
                            <button class="ambilpoli btn badge bg-primary" data-poli="<?= $registration['id_poli'] ?>" data-namapoli="<?= $registration['nama_poli'] ?>" data-id="<?= $registration['id'] ?>">Panggil</button>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>Sudah Disetujui</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <div class="container mt-4">
        <h2 class="m-0 p-0">Pendaftaran sebelumnya (terlewat)</h2>
        <small class="form-text m-0 p-0">Pasien tidak datang/ terlewat ketika dipanggil</small>
        <table class="table table-striped table-sm table-hover dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th style="text-align:left">Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= ($registration['id_dokter'] == "0")?"<span class='badge bg-warning'>belum dipilih</span>":$registration['nama_dokter'] ?></td>
                    <td style="text-align:left"><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <?= $registration['approved'] == 0 ? '<span class="badge bg-warning">Menunggu</span>' : '<span class="badge bg-success">Disetujui</span>' ?>
                    </td>
                    <td>
                        <!-- <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-primary">Panggil</a> -->
                         <?php //echo $registration['id_poli'] ?>
                         <form action="<?= base_url('/admin/hapus/daftar/'.$registration['id']) ?>" method="post">
                            <span class="badge bg-secondary">Terlewat</span>
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn badge fs-6"><i class="fa-solid fa-trash text-danger"></i></button>
                        </form>
                        <!-- <a href="" class=""><i class="fa-solid fa-trash text-danger"></i></a> -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="container mt-4">
        <h2>Pendaftaran Selesai</h2>
        <table class="table table-striped table-sm table-hover table-responsive-md dashboard-table" id="dataTable">
            <thead>
                <tr>
                    <th>Antrian</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th style="text-align:left">Tanggal Daftar</th>
                    <th>Alasan?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations_appr as $registration): ?>
                <tr>
                    <td><?= $registration['no_antrian'] ?></td>
                    <td><?= $registration['nama_pasien'] ?></td>
                    <td><?= $registration['nama_dokter'] ?>/<?= $registration['nama_poli'] ?></td>
                    <td style="text-align:left"><?= $registration['tanggal_daftar'] ?></td>
                    <td><?= $registration['alasan'] ?></td>
                    <td>
                        <!-- <a href="/admin/approve_registration/<?= $registration['id'] ?>" class="btn btn-success">Approve</a> -->
                        <span class="badge bg-success">Selesai</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>

<!-- Modal Pilih Dokter -->
<div class="modal fade" id="modalPilihDokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Dokter untuk Poli: <span id="poliName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPilihDokter" action="<?= base_url('/admin/pilihdokter') ?>" method="POST">
                    <input type="hidden" id="pendaftaranId" name="pendaftaran_id">
                    <div class="form-group">
                        <label for="dokter">Dokter</label>
                        <select name="dokter_id" id="dokter" class="form-select">
                            <option value="">Pilih Dokter</option>
                            <!-- Dokter akan dimuat di sini dengan AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary fw-medium" id="submitPilihDokter"><i class="fa-solid fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=>{
        $('.ambilpoli').on('click', (e)=>{
            let dataPoli = e.target.getAttribute('data-poli')
            let dataNamaPoli = e.target.getAttribute('data-namapoli')
            let dataId = e.target.getAttribute('data-id')
            console.log(e.target.getAttribute('data-poli'))
            console.log(dataId)
            $('#pendaftaranId').val(dataId);
            $('#poliName').text(dataNamaPoli);

        // Ambil data dokter berdasarkan poli dengan AJAX
        $.ajax({
            url: '/dokter/get_data_dokter',
            type: 'POST',
            data: { poli: dataPoli },
            dataType: 'json',
            success: function(response) {
                console.log(response)
                let dokterSelect = $('#dokter');
                dokterSelect.empty();
                dokterSelect.append('<option value="">--- Pilih Dokter ---</option>');
                response.forEach(function(dokter) {
                    dokterSelect.append(`<option value="${dokter.id}">${dokter.nama_dokter} - ${dokter.keahlian}</option>`);
                });
                $('#modalPilihDokter').modal('show');
            }
        });
    });

    // Event untuk submit pilihan dokter
    $('#submitPilihDokter').on('click', function(e) {
        e.preventDefault()
        let formData = $('#formPilihDokter').serialize();
        let dokterId = $('#dokter').val()

        if(dokterId == ''){
            alert('Silahkan pilih dokter terlebh dahulu sebelum melanjutkan!')
        }else{
            $('#formPilihDokter').submit()
        }
        
        
        
        
        
        // $.ajax({
        //     url: '/admin/approve_pendaftaran',
        //     type: 'POST',
        //     data: formData,
        //     success: function(response) {
        //         if (response.success) {
        //             alert('Pendaftaran berhasil disetujui dan dokter telah dipilih.');
        //             location.reload();
        //         } else {
        //             alert('Terjadi kesalahan, silakan coba lagi.');
        //         }
        //     }
        // });

        })
    })
</script>

<?= $this->endSection() ?>