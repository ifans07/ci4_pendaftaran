<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PasienModel;

class Auth extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function register()
    {
        helper(['form']);
        echo view('auth/register');
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'nama' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[pasien.email]',
            'password' => 'required|min_length[6]|max_length[200]',
            'confirm_password' => 'matches[password]'
        ];

        if($this->validate($rules)){
            $model = new PasienModel();
            $data = [
                'nama_pasien' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/auth/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }

    public function login()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function loginAuth()
    {
        $session = session();
        $model = new PasienModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'logged_in_pasien' => TRUE,
                    'idpasien' => $data['id'],
                    'nama_pasien' => $data['nama_pasien'],
                    'nokk' => $data['NOKK'],
                    'nik' => $data['NIK'],
                    'email' => $data['email'],
                ];
                $session->set($ses_data);
                
                if (!$this->pasienModel->isProfileComplete($data['id'])) {
                    return redirect()->to('/pasien/lengkapi_profil');
                }

                return redirect()->to('/pasien');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/auth/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}
