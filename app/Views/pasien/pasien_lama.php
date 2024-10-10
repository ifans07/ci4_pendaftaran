<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<section>
    <div class="container">
        <div>
            <a href="/pasien" class="btn btn-secondary"><i class="fa-solid fa-angles-left"></i> Kembali</a>
            <div id="notif" class="mt-3">
            
            </div>
            <input type="hidden" id="nikutama" value="<?= session()->get('nik') ?>">
            <div class="mt-3">
                <label for="nokk" class="col-form-label">No KK</label>
                <input type="text" name="nokk" id="nokk" class="form-control" value="<?= session()->get('nokk') ?>" readonly>
            </div>
            <div>
                <label for="nik" class="col-form-label">NIK</label>
                <input type="text" class="form-control" name="nik" id="niko">
            </div>
            <div class="mt-3">
                <button class="btn btn-dark fw-medium" style="background-color: #2c3e50" id="getdata"><i class="fa-solid fa-check-to-slot"></i> Cek Data</button>
            </div>
        </div>
        <div class="mt-5">
            <div class="card">
                <div class="card-header fw-medium text-white" style="background-color: #1abc9c">
                    Data Pasien
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nama Pasien: <span id="datanama" class="fw-medium"></span></li>
                        <li>NIK: <span id="datanik" class="fw-medium"></span></li>
                        <li>Tanggal Lahir: <span id="datatgl" class="fw-medium"></span></li>
                        <li>Jenis Kelamin: <span id="datajk" class="fw-medium"></span></li>
                        <li>BPJS: <span id="databpjs" class="fw-medium"></span></li>
                    </ul>
                </div>
            </div>
            <div id="btnDaftar" class="mt-3">
                
            </div>
            <div class="card mt-3">
                <div class="card-header fw-medium text-white" style="background-color: #1abc9c">
                    Riwayat
                </div>
                <div class="card-body">
                    <div>
                        <table id="taruhdaftar">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        let nokk = $('#nokk').val()
        let nikUtama = $('#nikutama').val()

        $('#getdata').on('click', (e)=>{
            let nik = $('#niko').val()
            $.ajax({
                url: '<?= base_url('/pasien/get_data_pasien') ?>',
                type: 'POST',
                data: {
                    nokk: nokk, 
                    nik:nik
                    },
                dataType: 'JSON',
                success: function(d){
                    console.log(d)
                    if(d.data == null){

                    }
                    if(nikUtama == nik){
                        $('#datanama').html(d.data.nama_pasien)
                        $('#datanik').html(d.data.NIK)
                        $('#datatgl').html(d.data.tgl_lahir)
                        $('#datajk').html(d.data.jenis_kelamin)
                        $('#databpjs').html(d.data.bpjs)
                        // idpasien=d.data.id
                        // console.log(idpasien)
                    }else{
                        $('#datanama').html(d.data.nama_pasien)
                        $('#datanik').html(d.data.nik)
                        $('#datatgl').html(d.data.tgl_lahir)
                        $('#datajk').html(d.data.jk)
                        $('#databpjs').html(d.data.bpjs)
                        // idpasien=d.data.id
                        // console.log(idpasien)
                    }
                    let idpasien = d.data.id
                    $('#btnDaftar').html(
                        `
                            <a href="/pasien/pasien_daftar/${idpasien}" class="btn btn-dark" style="background-color: #2c3e50"><i class="fa-solid fa-stethoscope"></i> Ambil Antrian</a>
                        `
                    )
                    $('#taruhdaftar').empty()
                    getDataDaftar(idpasien)
                },
                error: function(xhr, status, error){
                    console.log("error: ", error)
                    if(nik == nokk){
                        $('#notif').html(`
                            <div class="alert alert-danger">
                                yang anda input adalah No KK: ${nik}, Tolong input NIK yang benar!
                            </div>
                        `)
                    }else{
                        $('#btnDaftar').html('')
                        $('#taruhdaftar').empty()
                        $('#notif').html(`
                            <div class="alert alert-danger">
                                NIK: ${nik} tidak terdaftar di keluarga dengan No KK: ${nokk}.
                            </div>
                        `)
                    }

                }
            })
            
            function getDataDaftar(idpasien){
                $.ajax({
                    url: '<?= base_url('/daftar/get_data_daftar') ?>',
                    type: 'POST',
                    data: {id: idpasien},
                    dataType: 'JSON',
                    cache: false,
                    success: function(e){
                        
                        let html = `
                                    <tr>
                                        <th class="p-2">No</th>
                                        <th class="p-2">Tanggal Daftar</th>
                                        <th class="p-2">No Antrian</th>
                                        <th class="p-2">Dokter</th>
                                        <th class="p-2">Poli</th>
                                        <th class="p-2">Alasan</th>
                                        <th class="p-2">Status</th>
                                    </tr>
                                `

                        for(let i=0; i < e.data.length; i++){                            
                            html+=`
                                <tr>
                                    <td class="p-2">${i+1}</td>
                                    <td class="p-2">`+ e.data[i].tanggal_daftar +`</td>
                                    <td class="p-2">${e.data[i].no_antrian}</td>
                                    <td class="p-2">${e.data[i].nama_dokter}</td>
                                    <td class="p-2">${e.data[i].nama_poli}</td>
                                    <td class="p-2">${e.data[i].alasan}</td>
                                    if(e.data[i].approved == 0){
                                        <td class="p-2"><span class="badge bg-secondary">Terlewat</span></td>
                                    }else{
                                        <td class="p-2"><span class="badge bg-sucess">Selesai</span></td>
                                    }
                                </tr>
                            `
                        }
                        
                        $('#taruhdaftar').html(html)
                    },
                    error: function(xhr, status, error){
                        $('#taruhdaftar').html(`<div class="alert alert-info">Belum ada riwayat!</div>`)
                    }
                })

            }
        })
    })
</script>

<?= $this->endSection() ?>