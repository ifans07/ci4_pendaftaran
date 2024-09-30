<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ApotekModel;

class Apotek extends BaseController
{
    protected $apotekModel;

    public function __construct()
    {
        $this->apotekModel = new ApotekModel();
    }

    public function index()
    {
        $data['apotek'] = $this->apotekModel->findAll();
        return view('apotek/index', $data);
    }

    public function create()
    {
        return view('apotek/create');
    }

    public function store()
    {
        $this->apotekModel->save([
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jenis_obat' => $this->request->getPost('jenis_obat'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/apotek');
    }

    public function edit($id)
    {
        $data['apotek'] = $this->apotekModel->find($id);
        return view('apotek/edit', $data);
    }

    public function update($id)
    {
        $this->apotekModel->update($id, [
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jenis_obat' => $this->request->getPost('jenis_obat'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/apotek');
    }

    public function delete($id)
    {
        $this->apotekModel->delete($id);
        return redirect()->to('/apotek');
    }
}
