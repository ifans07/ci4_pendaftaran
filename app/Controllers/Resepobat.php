<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ResepobatModel;
use App\Models\PasienModel;
use App\Models\DokterModel;

class Resepobat extends BaseController
{
    protected $resepObatModel;
    protected $pasienModel;
    protected $dokterModel;

    public function __construct()
    {
        $this->resepObatModel = new ResepobatModel();
        $this->pasienModel = new pasienModel();
        $this->dokterModel = new dokterModel();
    }

    public function index()
    {
        $data['resep_obat'] = $this->resepObatModel->join('pasien', 'pasien.id=resepobat.id_pasien')->join('dokter', 'dokter.id=resepobat.id_dokter')->findAll();
        return view('resepobat/index', $data);
    }

    public function create()
    {
        $data = [
            'pasien' => $this->pasienModel->findAll(),
            'dokter' => $this->dokterModel->findAll()
        ];
        return view('resepobat/create');
    }

    public function store()
    {
        $this->resepObatModel->save([
            'id_pasien' => $this->request->getPost('pasien_id'),
            'id_dokter' => $this->request->getPost('dokter_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'pengobatan' => $this->request->getPost('resep'),
            'dosis' => $this->request->getPost('dosis'),
            'instruksi' => $this->request->getPost('instruksi'),
            'status' => 'Belum Diambil'
        ]);

        return redirect()->to('/resepobat');
    }

    public function edit($id)
    {
        $data['resep_obat'] = $this->resepObatModel->find($id);
        $data = [
            'pasien' => $this->pasienModel->findAll(),
            'dokster' => $this->dokterModel->findAll()
        ];
        return view('resepobat/edit', $data);
    }

    public function update($id)
    {
        $this->resepObatModel->update($id, [
            'id_pasien' => $this->request->getPost('pasien_id'),
            'id_dokter' => $this->request->getPost('dokter_id'),
            'pengobatan' => $this->request->getPost('resep'),
            'tanggal' => $this->request->getPost('tanggal'),
            'dosis' => $this->request->getPost('dosis'),
            'instruksi' => $this->request->getPost('instruksi'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/resepobat');
    }

    public function delete($id)
    {
        $this->resepObatModel->delete($id);
        return redirect()->to('/resepobat');
    }
}
