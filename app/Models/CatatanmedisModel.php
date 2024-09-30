<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanmedisModel extends Model
{
    protected $table = 'catatanmedis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'id_dokter', 'tanggal_kunjungan', 'diagnosa', 'pengobatan', 'catatan', 'keluhan', 'rencana_perawatan'];
    protected bool $allowEmptyInserts = true;

    public function getRekamMedisByPasien($pasien_id)
    {
        return $this->where('id_pasien', $pasien_id)->findAll();
    }
}
