<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'id_dokter', 'id_poli', 'tanggal', 'jam', 'alasan', 'status'];

    public function setStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
