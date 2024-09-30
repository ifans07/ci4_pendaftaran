<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'id_dokter', 'total_biaya', 'status'];
    protected $useTimestamps = true;
}
