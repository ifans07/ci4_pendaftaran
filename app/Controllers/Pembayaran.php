<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $data['pembayaran'] = $this->pembayaranModel->findAll();
        return view('pembayaran/index', $data);
    }

    public function create()
    {
        return view('pembayaran/create');
    }

    public function store()
    {
        $this->pembayaranModel->save([
            'pasien_id' => $this->request->getPost('pasien_id'),
            'total_biaya' => $this->request->getPost('total_biaya'),
            'status' => 'Belum Lunas'
        ]);

        return redirect()->to('/pembayaran');
    }

    public function edit($id)
    {
        $data['pembayaran'] = $this->pembayaranModel->find($id);
        return view('pembayaran/edit', $data);
    }

    public function update($id)
    {
        $this->pembayaranModel->update($id, [
            'pasien_id' => $this->request->getPost('pasien_id'),
            'total_biaya' => $this->request->getPost('total_biaya'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/pembayaran');
    }

    public function delete($id)
    {
        $this->pembayaranModel->delete($id);
        return redirect()->to('/pembayaran');
    }
}
