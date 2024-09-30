<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CatatanmedisModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\PoliModel;

class Catatanmedis extends BaseController
{
    protected $catatanmedisModel;
    protected $pasienModel;
    protected $dokterModel;
    protected $poliModel;

    public function __construct()
    {
        $this->catatanmedisModel = new catatanmedisModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $data['rekam_medis'] = $this->catatanmedisModel->join('pasien', 'pasien.id=catatanmedis.id_pasien')->join('dokter','dokter.id=catatanmedis.id_dokter')->findAll();
        return view('catatanmedis/index', $data);
    }

    public function create()
    {
        $data = [
            'pasien' => $this->pasienModel->findAll(),
            'dokter' => $this->dokterModel->findAll(),
            'poli' => $this->poliModel->findAll(),
        ];
        return view('catatanmedis/create', $data);
    }

    public function store()
    {
        $this->catatanmedisModel->save([
            'id_pasien' => $this->request->getPost('pasien_id'),
            'id_dokter' => $this->request->getPost('dokter_id'),
            'tanggal_kunjungan' => $this->request->getPost('tanggal_kunjungan'),
            'pengobatan' => $this->request->getPost('pengobatan'),
            'catatan' => $this->request->getPost('catatan'),
            'keluhan' => $this->request->getPost('keluhan'),
            'diagnosa' => $this->request->getPost('diagnosis'),
            'rencana_perawatan' => $this->request->getPost('rencana_perawatan'),
        ]);
        session()->setFlashdata('msg', 'Tambah data berhasil!');
        return redirect()->to('/catatanmedis');
    }

    public function edit($id)
    {
        $data = [
            'pasien' => $this->pasienModel->findAll(),
            'dokter' => $this->dokterModel->findAll(),
            'poli' => $this->poliModel->findAll()
        ];
        $data['rekam_medis'] = $this->catatanmedisModel->find($id);
        return view('catatanmedis/edit', $data);
    }

    public function update($id)
    {
        $this->catatanmedisModel->update($id, [
            'id_pasien' => $this->request->getPost('pasien_id'),
            'id_dokter' => $this->request->getPost('dokter_id'),
            'keluhan' => $this->request->getPost('keluhan'),
            'tanggal_kunjungan' => $this->request->getPost('tanggal_kunjungan'),
            'diagnosa' => $this->request->getPost('diagnosis'),
            'pengobatan' => $this->request->getPost('pengobatan'),
            'catatan' => $this->request->getPost('catatan'),
            'rencana_perawatan' => $this->request->getPost('rencana_perawatan'),
        ]);
        session()->setFlashdata('msg', 'Data berhasil di ubah!');
        return redirect()->to('/catatanmedis');
    }

    public function delete($id)
    {
        $this->catatanmedisModel->delete($id);
        session()->setFlashdata('msg', 'Hapus data berhasil!');
        return redirect()->to('/catatanmedis');
    }
}
