<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\ResepobatModel;
use App\Models\CatatanmedisModel;
use App\Models\PasienModel;
use App\Models\DaftarModel;
use App\Models\SecondPasienModel;
use App\Models\DokterModel;
use App\Models\PoliModel;

class Pasien extends BaseController
{
    protected $pasienModel;
    protected $daftarModel;
    protected $secondPasienModel;
    public function __construct()
    {
        $this->pasienModel = new PasienModel;
        $this->daftarModel = new DaftarModel;
        $this->secondPasienModel = new SecondPasienModel;
    }

    public function index()
    {
        $session = session();
        if(!$session->get('logged_in_pasien')){
            return redirect()->to('/auth/login');
        }

        $appointmentModel = new JadwalModel();
        $medicalRecordModel = new CatatanmedisModel();
        $prescriptionModel = new ResepobatModel();

        $data = [
            'appointments' => $appointmentModel->join('pasien', 'pasien.id=jadwal.id_pasien')->join('dokter', 'dokter.id=jadwal.id_dokter')->join('poli', 'poli.id=jadwal.id_poli')->where('jadwal.id_pasien', $session->get('idpasien'))->findAll(),
            'medical_records' => $medicalRecordModel->where('id_pasien', $session->get('idpasien'))->findAll(),
            'prescriptions' => $prescriptionModel->where('id_pasien', $session->get('idpasien'))->findAll(),
            'outpasients' => $this->daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('id_pasien', $session->get('idpasien'))->findAll(),
            // 'outpasientall' => $this->daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('poli', 'poli.id=daftar.id_poli')->join('second_pasien', 'second_pasien.id=daftar.id_pasien')->where('approved', 0)->where('tanggal_daftar', date('Y-m-d'))->orderBy('tanggal_daftar', 'DESC')->findAll(),
            'outpasientall' => $this->daftarModel->gabungData(),
            'riwayat_daftar' => $this->daftarModel->join('pasien', 'pasien.id=daftar.id_pasien')->join('dokter', 'dokter.id=daftar.id_dokter')->join('poli', 'poli.id=daftar.id_poli')->where('daftar.id_pasien', $session->get('idpasien'))->where('approved', 0)->where('tanggal_daftar !=', date('Y-m-d'))->orderBy('tanggal_daftar', 'DESC')->findAll(),
            'title' => 'Dashboard - Pasien',
            'title_header' => 'Dashboard',
            'title_info' => 'Selamat datang ' . "<span class='fw-medium'>". session()->get('nama_pasien') . "</span>"
        ];
        // d($data['d']);
        // dd($data['outpasientall']);
        echo view('pasien/index', $data);
    }

    public function complete_profile()
    {
        $data = [
            'title' => "Lengkapi Data - Pasien",
            'title_header' => "Lengkapi Profil",
            'title_info' => "Halaman untuk melengkapi data diri untuk bisa beralih ke halaman selanjutnya",
        ];
        return view('pasien/lengkapi_profil', $data);
    }

    public function store_profile()
    {
        $this->pasienModel->update(session()->get('idpasien'), [
            'NIK' => $this->request->getPost('nik'),
            'NOKK' => $this->request->getPost('nokk'),
            'tgl_lahir' => $this->request->getPost('date_of_birth'),
            'jenis_kelamin' => $this->request->getPost('gender'),
            'nohp' => $this->request->getPost('nohp'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pasien');
    }

    public function store_pasienbaru()
    {
        $data = [
            'id' => $this->secondPasienModel->generateUserId(),
            'id_pasien' => $this->request->getPost('idpasien'),
            'nama_pasien' => $this->request->getPost('namapasien'),
            'nokk' => $this->request->getPost('nokk'),
            'nik' => $this->request->getPost('nik'),
            'tgl_lahir' => $this->request->getPost('tgllahir'),
            'jk' => $this->request->getPost('jk'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp' => $this->request->getPost('nohp'),
            'bpjs' => $this->request->getPost('bpjs'),
            'nobpjs' => $this->request->getPost('nobpjs'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        if(session()->get('nokk') == '0'){
            $this->pasienModel->update(session()->get('idpasien'), [
                'NOKK' => $this->request->getPost('nokk')
            ]);
        }

        $this->secondPasienModel->save($data);
        session()->setFlashdata('msg', 'Data keluarga baru berhasil ditambah!');
        return redirect()->to('/pasien');        
    }

    public function pasien_lama()
    {
        $data = [
            'title' => "Pasien Lama - Pasien",
            'title_header' => "Cek Pasien Lama",
            'title_info' => "Halaman untuk melakukan pengecekan data pasien",
        ];
        return view('pasien/pasien_lama', $data);
    }

    public function getDataPasien()
    {
        $nokk = $this->request->getPost('nokk');
        $nik = $this->request->getPost('nik');

        if(session()->get('nik') == $nik){
            return $this->response->setJSON([
                'data' => $this->pasienModel->where('NIK', $nik)->first()
            ]);
        }else{
            $existNokk = $this->secondPasienModel->where('second_pasien.nik', $nik)->first();
            if($nokk == $existNokk['nokk']){
                return $this->response->setJSON([
                    'data' => $this->secondPasienModel->where('nik', $nik)->first()
                ]);
            }else{
                return $this->response->setJSON([
                    'data' => 'NIK: '. $nik . ' ini tidak terdaftar di keluarga dengan No KK: ' . $nokk,
                    'nok' => $existNokk
                ]);
            }
        }
    }

    public function akun()
    {
        $data = [
            'title' => 'Akun - Pasien',
            'title_header' => 'Data Akun',
            'title_info' => "Informasi keluarga yang terdaftar di akun ini No. KK: <span class='fw-medium'>". session()->get('nokk')."</span>",
            'pasien' => $this->pasienModel->where('id', session()->get('idpasien'))->first(),
            'second_pasien' => $this->secondPasienModel->where('id_pasien', session()->get('idpasien'))->findAll()
        ];
        return view('pasien/akun_keluarga', $data);
    }

    public function second_pasien_daftar($id)
    {
        $daftarModel = new DaftarModel();
        $doctorModel = new DokterModel();
        $poliModel = new PoliModel();
        $pasienModel = new PasienModel();
        $secondPasienModel = new SecondPasienModel();
        $data = [
            'title' => 'Buat Antrian - Pasien',
            'title_header' => 'Buat Antrian',
            'title_info' => 'Halaman untuk membuat antrian -- Pasien'
        ];

        $data['doctors'] = $doctorModel->findAll();
        $data['antrian'] = $daftarModel->getNextQueueNumber();
        $data['poli'] = $poliModel->findAll();
        if(is_numeric($id)){
            $data['pasien'] = $pasienModel->where('id', $id)->first();
        }else{
            $data['pasien'] = $secondPasienModel->where('id', $id)->first();
        }

        return view('pasien/second_pasien_daftar', $data);
    }

    // reset password
    public function resetPassword()
    {
        $data = [
            'title' => 'Reset Password - Pasien',
            'title_header' => 'Reset Password',
            'title_info' => 'Form reset password/ buat ulang password'
        ];
        return view('pasien/reset_password', $data);
    }

    public function updatePassword()
    {
        $nik = $this->request->getPost('nik');
        $newPassword = $this->request->getPost('password');
        
        if ($this->pasienModel->updatePassword($nik, $newPassword)) {
            return redirect()->to('/auth/login')->with('message', 'Password berhasil diperbarui.');
        } else {
            return redirect()->to('/pasien/resetPassword')->with('error', 'Gagal memperbarui password. Pastikan NIK benar dan sesuai.');
        }
    }


    // public function index()
    // {
    //     //
    //     $data = [
    //         'appointments' => [
    //             ['date' => '2024-08-01', 'time' => '09:00', 'doctor' => 'Dr. Alice Johnson', 'department' => 'Cardiology'],
    //             ['date' => '2024-08-02', 'time' => '10:00', 'doctor' => 'Dr. Bob Williams', 'department' => 'Dermatology']
    //         ],
    //         'medical_records' => [
    //             ['date' => '2024-07-01', 'diagnosis' => 'Hypertension', 'treatment' => 'Medication'],
    //             ['date' => '2024-07-15', 'diagnosis' => 'Dermatitis', 'treatment' => 'Topical ointment']
    //         ],
    //         'prescriptions' => [
    //             ['date' => '2024-07-01', 'medication' => 'Amlodipine', 'dosage' => '5mg daily'],
    //             ['date' => '2024-07-15', 'medication' => 'Hydrocortisone cream', 'dosage' => 'Apply twice daily']
    //         ]
    //     ];

    //     return view('pasien/index', $data);
    // }
}
