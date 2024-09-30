<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PoliModel;

class Poli extends BaseController
{
    protected $poliModel;

    public function __construct()
    {
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $data = [
            'title' => "Data Poli - Admin",
            'title_header' => "Data Poli",
            'title_info' => "Halaman untuk melihat data poli -- Admin"
        ];
        $data['poli'] = $this->poliModel->findAll();
        return view('admin/poli/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah data poli - Admin",
            'title_header' => "Tambah Data Poli",
            'title_info' => "Formulir tambah data poli -- Admin"
        ];
        return view('admin/poli/create', $data);
    }

    public function store()
    {
        $this->poliModel->save([
            'nama_poli' => $this->request->getPost('name'),
            // 'description' => $this->request->getPost('description'),
        ]);
        session()->setFlashdata('msg', 'Berhasil tambah data!');
        return redirect()->to('/admin/poli');
    }

    public function edit($id)
    {
        $data = [
            'title' => "Edit data poli - Admin",
            'title_header' => "Edit Data Poli",
            'title_info' => "Formulir edit data poli -- Admin"
        ];
        $data['poli'] = $this->poliModel->find($id);
        return view('admin/poli/edit', $data);
    }

    public function update($id)
    {
        $this->poliModel->update($id, [
            'nama_poli' => $this->request->getPost('name'),
            // 'description' => $this->request->getPost('description'),
        ]);
        session()->setFlashdata('msg', 'Berhasil update data!');
        return redirect()->to('/admin/poli');
    }

    public function delete($id)
    {
        $this->poliModel->delete($id);
        session()->setFlashdata('msg', 'Berhasil hapus data!');
        return redirect()->to('/admin/poli');
    }
}
