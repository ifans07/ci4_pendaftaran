<?php

namespace App\Controllers;
use App\Models\DaftarModel;

class Home extends BaseController
{
    protected $daftarModel;
    public function __construct()
    {
        $this->daftarModel = new DaftarModel();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Beranda',
            'title_header' => 'Beranda',
            'title_info' => 'Halaman utama yang berisi informasi antrian yang sedang berjalan'
        ];
        $data['antrian'] = $this->daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('approved', 0)->where('tanggal_daftar', date('Y-m-d'))->findAll();
        return view('beranda/index', $data);
    }
}
