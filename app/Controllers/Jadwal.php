<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\DokterModel;
use App\Models\PoliModel;

class Jadwal extends BaseController
{
    public function create()
    {
        helper(['form']);
        $dokterModel = new DokterModel;
        $poliModel = new PoliModel;
        $data = [
            'dokters' => $dokterModel->findAll(),
            'poli' => $poliModel->findAll()
        ];
        echo view('jadwal/create', $data);
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'appointment_date' => 'required|valid_date[Y-m-d]',
            'appointment_time' => 'required|valid_date[H:i]',
            'reason_for_visit' => 'required|min_length[5]'
        ];

        if ($this->validate($rules)) {
            $model = new JadwalModel();
            $data = [
                'id_pasien' => session()->get('idpasien'),
                'id_dokter' => $this->request->getVar('doctor_id'),
                'id_poli' => $this->request->getPost('poli'),
                'tanggal' => $this->request->getVar('appointment_date'),
                'jam' => $this->request->getVar('appointment_time'),
                'alasan' => $this->request->getVar('reason_for_visit')
            ];
            $model->save($data);
            return redirect()->to('/jadwal');
        } else {
            $data['validation'] = $this->validator;
            echo view('jadwal/create', $data);
        }
    }

    public function index()
    {
        $model = new JadwalModel();
        $data['appointments'] = $model->select('jadwal.*, pasien.nama_pasien, dokter.nama_dokter, poli.nama_poli')->join('pasien', 'pasien.id=jadwal.id_pasien')->join('dokter', 'dokter.id=jadwal.id_dokter')->join('poli', 'poli.id=jadwal.id_poli')->where('id_pasien', session()->get('idpasien'))->findAll();
        echo view('jadwal/index', $data);
    }

    public function setStatus($id, $status)
    {
        $jadwalModel = new JadwalModel;
        $jadwalModel->setStatus($id, $status);
        return redirect()->to('/jadwal');
    }
}
