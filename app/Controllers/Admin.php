<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DokterModel;
use App\Models\DaftarModel;
use App\Models\AdminModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\JadwalModel;

class Admin extends BaseController
{
    protected $pasienModel;
    protected $jadwalModel;
    protected $dokterModel;
    protected $poliModel;
    public function __construct()
    {
        $this->pasienModel = new PasienModel;
        $this->jadwalModel = new JadwalModel;
        $this->dokterModel = new DokterModel;
        $this->poliModel = new PoliModel;
    }

    public function register()
    {
        helper(['form']);
        echo view('admin/register');
    }

    public function store_registration()
    {
        helper(['form']);
        $model = new AdminModel();

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[admin.username]',
            'password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/admin/login');
        } else {
            echo view('admin/register', [
                'validation' => $this->validator
            ]);
        }
    }

    public function login()
    {
        helper(['form']);
        echo view('admin/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword) {
                $ses_data = [
                    'idadmin'       => $data['id'],
                    'username'     => $data['username'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/admin/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/admin/login');
        }
    }

    public function dashboard()
    {
        if(!session()->get('logged_in')){
            return redirect()->to('/admin/login');
        }
        $model = new DaftarModel();
        $data = [
            'title' => 'Dashboard - Admin',
            'title_header' => 'Dashboard',
            'title_info' => 'Halaman utama untuk admin Puskesmas - mengecek pasien yang melakukan pendaftaran'
        ];
        $data['registrations'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->where('approved', 0)->where('tanggal_daftar !=', date('Y-m-d'))->orderBy('tanggal_daftar', 'DESC')->findAll();

        $data['registrations_now'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->where('approved', 0)->where('tanggal_daftar', date('Y-m-d'))->orderBy('tanggal_daftar', 'DESC')->findAll();

        $data['registrations_appr'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->where('approved', 1)->findAll();

        // Statistik pendaftaran hari ini
        $today = date('Y-m-d');
        $data['registrations_today'] = $model->where('tanggal_daftar', $today)->countAllResults();

        // Statistik pendaftaran bulan ini
        $startOfMonth = date('Y-m-01');
        $data['registrations_month'] = $model->where('tanggal_daftar >=', $startOfMonth)->countAllResults();
        
        // Notifikasi pendaftaran yang perlu approval
        $data['pending_count'] = $model->where('approved', 0)->countAllResults();

        echo view('admin/dashboard', $data);
    }

    public function create_outpatient()
    {
        helper(['form']);
        if(!session()->get('logged_in')){
            return redirect()->to('/admin/login');
        }
        $doctorModel = new DokterModel();
        $pasienModel = new PasienModel();
        $daftarModel = new DaftarModel();
        $poliModel = new PoliModel();
        
        $data = [
            'title' => 'Daftar Antrian Pasien - Admin',
            'title_header' => "Pendaftaran Antrian Pasien",
            'title_info' => 'Halaman pendaftaran pasien rawat jalan (ambil antrian) -- Admin',
        ];

        $data['doctors'] = $doctorModel->findAll();
        $data['patients'] = $pasienModel->findAll();
        $data['antrian'] = $daftarModel->getNextQueueNumber();
        $data['poli'] = $poliModel->findAll();
        echo view('admin/create_daftar', $data);
    }

    public function store_outpatient()
    {
        helper(['form']);
        if(!session()->get('logged_in')){
            return redirect()->to('/admin/login');
        }
        $rules = [
            'patient_id' => 'required|integer',
            'registration_date' => 'required|valid_date[Y-m-d]',
            'visit_reason' => 'required|min_length[5]'
        ];

        if ($this->validate($rules)) {
            $model = new DaftarModel();
            $data = [
                'id_pasien' => $this->request->getVar('patient_id'),
                'id_dokter' => $this->request->getVar('doctor_id'),
                'id_poli' => $this->request->getVar('poli'),
                'tanggal_daftar' => $this->request->getVar('registration_date'),
                'alasan' => $this->request->getVar('visit_reason'),
                'no_antrian' => $this->request->getVar('antrian'),
            ];
            $model->save($data);
            return redirect()->to('/admin/dashboard');
        } else {
            $doctorModel = new DokterModel();
            $data['doctors'] = $doctorModel->findAll();
            $data['validation'] = $this->validator;
            echo view('admin/create_outpatient', $data);
        }
    }

    public function pending_registrations()
    {
        if(!session()->get('logged_in')){
            return redirect()->to('/admin/login');
        }
        $model = new DaftarModel();
        $data['registrations'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('approved', 0)->where('tanggal_daftar', date('Y-m-d'))->orderBy('no_antrian')->findAll();
        $data['registrationsapp'] = $model->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('approved', 1)->findAll();
        echo view('admin/pending_daftar', $data);
    }

    public function approve_registration($id)
    {
        if(!session()->get('logged_in')){
            return redirect()->to('/admin/login');
        }
        $model = new DaftarModel();
        $model->update($id, ['approved' => 1]);
        return redirect()->to('/admin/pending_registrations');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login');
    }

    // Pasien Daftar via Admin
    public function index_pasien()
    {
        $data = [
            'title' => 'Data Pasien - Admin',
            'title_header' => 'Data Pasien',
            'title_info' => 'Halaman untuk melihat data pasien yang sudah terdaftar - Admin'
        ];
        $data['patients'] = $this->pasienModel->findAll();
        return view('admin/index_pasien', $data);
    }

    public function create_pasien()
    {
        $data = [
            'title' => 'Tambah Pasien - Admin',
            'title_header' => "<i class='fa-solid fa-plus'></i> Tambah Pasien",
            'title_info' => 'Halaman untuk menambahkan data pasien agar terdaftar -- Admin'
        ];
        return view('admin/create_pasien', $data);
    }
    public function store_pasien()
    {
        $this->pasienModel->createPatient([
            'email' => $this->request->getPost('email'),
            'nama_pasien' => $this->request->getPost('name'),
            'NOKK' => $this->request->getPost('nokk'),
            'NIK' => $this->request->getPost('dob'),
            'jenis_kelamin' => $this->request->getPost('gender'),
            'alamat' => $this->request->getPost('address'),
            'tgl_lahir' => $this->request->getPost('tanggal_lahir'),
            'nohp' => $this->request->getPost('phone'),
            // 'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ]);
        session()->setFlashdata('msg', 'Berhasil edit data!');
        return redirect()->to('/admin/datapasien');
    }

    public function edit_pasien($id)
    {
        $data = [
            'title' => "Edit data pasien - Admin",
            'title_header' => "Edit Data Pasien",
            'title_info' => "Formulir edit data pasien -- Admin"
        ];
        $data['pasien'] = $this->pasienModel->find($id);
        return view('admin/edit_pasien', $data);
    }

    public function update_pasien($id)
    {
        $this->pasienModel->update($id, [
            'email' => $this->request->getPost('email'),
            'nama_pasien' => $this->request->getPost('name'),
            'NIK' => $this->request->getPost('dob'),
            'jenis_kelamin' => $this->request->getPost('gender'),
            'alamat' => $this->request->getPost('address'),
            'tgl_lahir' => $this->request->getPost('tanggal_lahir'),
            'nohp' => $this->request->getPost('phone'),
        ]);
        session()->setFlashdata('msg', 'Berhasil edit data!');
        return redirect()->to('/admin/datapasien');
    }

    public function delete_pasien($id)
    {
        $this->pasienModel->delete($id);
        session()->setFlashdata('msg', 'Berhasil hapus data!');
        return redirect()->to('/admin/datapasien');
    }

    // jadwal temu pasien dengan dokter
    public function index_jadwal()
    {
        $data['appointments'] = $this->jadwalModel->join('pasien', 'pasien.id=jadwal.id_pasien')->join('dokter', 'dokter.id=jadwal.id_dokter')->where('status', 'scheduled')->join('poli', 'poli.id=jadwal.id_poli')->findAll();
        $data['appointments_status'] = $this->jadwalModel->join('pasien', 'pasien.id=jadwal.id_pasien')->join('dokter', 'dokter.id=jadwal.id_dokter')->where('status !=', 'scheduled')->join('poli', 'poli.id=jadwal.id_poli')->findAll();
        return view('admin/jadwal/index', $data);
    }

    public function create_jadwal()
    {
        $data['pasien'] = $this->pasienModel->findAll();
        $data['dokters'] = $this->dokterModel->findAll();
        $data['poli'] = $this->poliModel->findAll();
        return view('admin/jadwal/create', $data);
    }

    public function store_jadwal()
    {
        $this->jadwalModel->save([
            'id_pasien' => $this->request->getPost('pasien'),
            'id_dokter' => $this->request->getPost('doctor_id'),
            'id_poli' => $this->request->getPost('poli'),
            'tanggal' => $this->request->getPost('appointment_date'),
            'jam' => $this->request->getPost('appointment_time'),
            'alasan' => $this->request->getPost('reason_for_visit')
        ]);

        return redirect()->to('/admin/jadwal');
    }
    
    public function setStatus($id, $status)
    {
        $this->jadwalModel->setStatus($id, $status);
        return redirect()->to('/admin/jadwal');
    }
}
