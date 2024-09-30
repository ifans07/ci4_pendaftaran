<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DokterModel;
use App\Models\PoliModel;

class Dokter extends BaseController
{
    protected $dokterModel;
    protected $poliModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $data = [
            'title' => "Data Dokter - Admin",
            'title_header' => "Data Dokter",
            'title_info' => "Halaman admin untuk melihat data dokter"
        ];
        $data['doctors'] = $this->dokterModel->select('dokter.*, poli.nama_poli')->join('poli', 'poli.id=dokter.id_poli')->findAll();
        return view('admin/dokter/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah data dokter - Admin",
            'title_header' => "Tambah Data Dokter",
            'title_info' => "Formulir menambah data dokter -- Admin",
            'poli' => $this->poliModel->findAll()
        ];
        return view('admin/dokter/create', $data);
    }

    public function store()
    {
        $this->dokterModel->save([
            'nama_dokter' => $this->request->getPost('name'),
            'keahlian' => $this->request->getPost('specialization'),
            'id_poli' => $this->request->getPost('poli'),
            'nohp' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
        ]);
        session()->setFlashdata('msg', 'Berhasil tambah data!');
        return redirect()->to('/admin/dokter');
    }

    public function edit($id)
    {
        $data = [
            'title' => "Edit data dokter - Admin",
            'title_header' => "Edit Data Dokter",
            'title_info' => "Formulir edit data dokter -- Admin",
            'poli' => $this->poliModel->findAll()
        ];
        $data['doctor'] = $this->dokterModel->find($id);
        return view('admin/dokter/edit', $data);
    }

    public function update($id)
    {
        $this->dokterModel->update($id, [
            'nama_dokter' => $this->request->getPost('name'),
            'keahlian' => $this->request->getPost('specialization'),
            'id_poli' => $this->request->getPost('poli'),
            'nohp' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
        ]);
        session()->setFlashdata('msg', 'Berhasil edit data!');
        return redirect()->to('/admin/dokter');
    }

    public function delete($id)
    {
        $this->dokterModel->delete($id);
        session()->setFlashdata('msg', 'Berhasil hapus data!');
        return redirect()->to('/admin/dokter');
    }

    // getdatadokter
    public function getDokter()
    {        
        $id_poli = $this->request->getPost('poli');
        $dokter = $this->dokterModel->getDokterByPoli($id_poli);
        return json_encode($dokter);
    }
}
