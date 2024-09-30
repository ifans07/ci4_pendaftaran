<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DokterModel;
use App\Models\DaftarModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\secondPasienModel;

class Daftar extends BaseController
{
    public function create()
    {
        helper(['form']);
        $doctorModel = new DokterModel();
        $daftarModel = new DaftarModel();
        $poliModel = new PoliModel();
        $pasienModel = new PasienModel();
        $data = [
            'title' => 'Daftar Antrian - Pasien',
            'title_header' => 'Buat Antrian',
            'title_info' => 'Form daftar rawat jalan (antrian)'
        ];
        $data['doctors'] = $doctorModel->findAll();
        $data['antrian'] = $daftarModel->getNextQueueNumber();
        $data['poli'] = $poliModel->findAll();
        $data['pasien_combine'] = $pasienModel->combinedDataPasien();
        // dd($data);
        echo view('daftar/create', $data);
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'registration_date' => 'required|valid_date[Y-m-d]',
            'visit_reason' => 'required|min_length[5]'
        ];

        if ($this->validate($rules)) {
            $model = new DaftarModel();
            $data = [
                // 'id_pasien' => session()->get('idpasien'),
                'id_pasien' => $this->request->getPost('nama_pasien'),
                // 'id_dokter' => $this->request->getVar('doctor_id'),
                'id_poli' => $this->request->getVar('poli'),
                'tanggal_daftar' => $this->request->getVar('registration_date'),
                'alasan' => $this->request->getVar('visit_reason'),
                'no_antrian' => $this->request->getVar('antrian')
            ];
            dd($data);
            $model->save($data);
            return redirect()->to('/daftar');
        } else {
            $doctorModel = new DokterModel();
            $data['doctors'] = $doctorModel->findAll();
            $data['validation'] = $this->validator;
            echo view('daftar/create', $data);
        }
    }

    public function store_second_pasien()
    {
        $model = new DaftarModel();
        $data = [
            'id_pasien' => $this->request->getPost('idpasien'),
            // 'id_dokter' => $this->request->getVar('doctor_id'),
            'id_poli' => $this->request->getVar('poli'),
            'tanggal_daftar' => $this->request->getVar('registration_date'),
            'alasan' => $this->request->getVar('visit_reason'),
            'no_antrian' => $this->request->getVar('antrian'),
        ];
        $model->save($data);
        return redirect()->to('/pasien');
    }

    public function index()
    {
        $model = new DaftarModel();
        $data['registrations'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('id_pasien', session()->get('idpasien'))->orderBy('tanggal_daftar', 'DESC')->findAll();
        
        echo view('daftar/index', $data);
    }

    public function direct_registration()
    {
        helper(['form']);
        $doctorModel = new DokterModel();
        $patientModel = new PasienModel();
        $data['doctors'] = $doctorModel->findAll();
        $data['patients'] = $patientModel->findAll();
        echo view('daftar/direct_daftar', $data);
    }

    public function store_direct_registration()
    {
        helper(['form']);
        $rules = [
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'registration_date' => 'required|valid_date[Y-m-d]',
            'visit_reason' => 'required|min_length[5]'
        ];

        if ($this->validate($rules)) {
            $model = new DaftarModel();
            $data = [
                'id_pasien' => $this->request->getVar('patient_id'),
                'id_dokter' => $this->request->getVar('doctor_id'),
                'tanggal_daftar' => $this->request->getVar('registration_date'),
                'alasan' => $this->request->getVar('visit_reason')
            ];
            $model->save($data);
            return redirect()->to('/daftar');
        } else {
            $doctorModel = new DokterModel();
            $patientModel = new PasienModel();
            $data['doctors'] = $doctorModel->findAll();
            $data['patients'] = $patientModel->findAll();
            $data['validation'] = $this->validator;
            echo view('daftar/direct_daftar', $data);
        }
    }

    public function getDataDaftar()
    {
        $pasienModel = new PasienModel();
        $secondPasienModel = new SecondPasienModel();
        $daftarModel = new DaftarModel();
        $idpasien = $this->request->getPost('id');
        // if(preg_match('/^P\d+$/', $idpasien)){
        if(!is_numeric($idpasien)){
            return $this->response->setJSON([
                'data' => $daftarModel->join('second_pasien', 'second_pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('id_pasien', $idpasien)->findAll()
            ]);
        }else{
            return $this->response->setJSON([
                'data' => $daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('id_pasien', $idpasien)->findAll()
            ]);
        }
        // return $this->response->setJSON([
        //     'data' => $daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('second_pasien', 'second_pasien.id=daftar.id_pasien')->where('daftar.id_pasien', '3')->findAll()
        // ]);
    }
}
