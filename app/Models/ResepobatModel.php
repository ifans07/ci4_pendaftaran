<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepobatModel extends Model
{
    protected $table = 'resepobat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'id_dokter', 'id_resep', 'id_obat', 'tanggal', 'pengobatan', 'dosis', 'instruksi', 'resep', 'status'];
    protected bool $allowEmptyInserts = true;

    public function getResepObat($resep_id)
    {
        return $this->db->table('resepobat')
            ->select('resepobat.*, apotek.nama_obat as nama_obat')
            ->join('apotek', 'apotek.id = resepobat.id_obat')
            ->where('id_resep', $resep_id)
            ->get()->getResultArray();
    }
}
