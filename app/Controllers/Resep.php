<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ResepModel;
use App\Models\ResepobatModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\ApotekModel;
use App\Models\CatatanmedisModel;

class Resep extends BaseController
{
    public function index()
    {
        $model = new ResepModel();
        $data['resep'] = $model->select('resep.*, pasien.nama_pasien, dokter.nama_dokter')->join('pasien', 'pasien.id=resep.id_pasien')->join('dokter', 'dokter.id=resep.id_dokter')->findAll();
        return view('resep/index', $data);
    }

    public function create()
    {
        $pasienModel = new PasienModel();
        $dokterModel = new DokterModel();
        $obatModel = new ApotekModel();
        $data['pasien'] = $pasienModel->findAll();
        $data['dokter'] = $dokterModel->findAll();
        $data['obat'] = $obatModel->findAll();
        return view('resep/create', $data);
    }

    public function store()
    {
        $resepModel = new ResepModel();
        $resepObatModel = new ResepobatModel();

        $resepData = [
            'id_pasien' => $this->request->getPost('pasien_id'),
            'id_dokter' => $this->request->getPost('dokter_id'),
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $resepModel->save($resepData);
        $resepId = $resepModel->insertID();

        $obatIds = $this->request->getPost('obat_id');
        $dosisList = $this->request->getPost('dosis');
        $pasien = $this->request->getPost('pasien_id');
        $dokter = $this->request->getPost('dokter_id');
        $instruksiList = $this->request->getPost('instruksi');
        $tanggal = $this->request->getPost('tanggal');

        foreach ($obatIds as $index => $obatId) {
            $resepObatData = [
                'id_resep' => $resepId,
                'id_obat' => $obatId,
                'id_pasien' => $pasien,
                'id_dokter' => $dokter,
                'tanggal' => $tanggal,
                'dosis' => $dosisList[$index],
                'instruksi' => $instruksiList[$index]
            ];
            $resepObatModel->save($resepObatData);
        }
        session()->setFlashdata('msg', 'Berhasil tambah data!');
        return redirect()->to('/resep');
    }

    public function show($id)
    {
        $resepModel = new ResepModel();
        $resepObatModel = new ResepobatModel();
        $rekamModel = new CatatanmedisModel();
        $data['resep'] = $resepModel->select('resep.*, pasien.nama_pasien, dokter.nama_dokter')->join('pasien', 'pasien.id=resep.id_pasien')->join('dokter', 'dokter.id=resep.id_dokter')->find($id);
        $data['resep_obat'] = $resepObatModel->getResepObat($id);
        $data['rekam_medis']  = $rekamModel->getRekamMedisByPasien($data['resep']['id_pasien']);

        return view('resep/show', $data);
    }
}
