<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_pasien', 'NOKK', 'NIK', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'nohp', 'email', 'password'];

    public function isProfileComplete($id)
    {
        $patient = $this->find($id);
        return $patient['nama_pasien'] && $patient['NIK'] && $patient['NOKK'] && $patient['tgl_lahir'] && $patient['nohp'] && $patient['jenis_kelamin'] && $patient['alamat'];
    }

    public function createPatient($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->save($data);
    }

    public function updatePassword($nik, $newPassword)
    {
        $patient = $this->where('NIK', $nik)->first();

        if ($patient['id'] == session()->get('idpasien')) {
            return $this->update($patient['id'], ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
        }

        return false;
    }

    public function getPasien()
    {
        return $this->db->table($this->table)
        ->select('id, NIK as nik, NOKK as nokk, nama_pasien, tgl_lahir, jenis_kelamin as jk, alamat, nohp, email, bpjs')
        ->where('id', session()->get('idpasien'))
        ->get()->getResultArray();
    }
    public function getSecondPasien()
    {
        return $this->db->table('second_pasien')
        ->where('id_pasien', session()->get('idpasien'))
        ->get()
        ->getResultArray();
    }
    public function combinedDataPasien()
    {
        $pasien = $this->getPasien();
        $secondPasien = $this->getSecondPasien();

        $dataCombine = array_merge($pasien, $secondPasien);
        return $dataCombine;
    }
}
