<?php

namespace App\Models;

use CodeIgniter\Model;

class SecondPasienModel extends Model
{
    protected $table            = 'second_pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','id_pasien', 'nama_pasien', 'nokk', 'nik', 'tgl_lahir', 'jk', 'alamat', 'nohp', 'bpjs', 'nobpjs', 'username', 'email', 'password'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * Fungsi untuk menghasilkan ID baru dengan format huruf dan angka.
     * Contoh: A1, A2, A3, dst.
     */
    public function generateUserId()
    {
        // Mengambil ID terakhir
        $lastUser = $this->orderBy('id', 'DESC')->first();

        if ($lastUser) {
            $lastId = $lastUser['id'];
            // Mengambil bagian angka dari ID terakhir
            $number = intval(substr($lastId, 1));
            // Menambah angka tersebut dengan 1
            $newNumber = $number + 1;
            // Menggabungkan dengan huruf prefix
            $newId = 'P' . $newNumber;
        } else {
            // Jika belum ada data, mulai dari A1
            $newId = 'P1';
        }

        return $newId;
    }
}
