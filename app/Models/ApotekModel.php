<?php

namespace App\Models;

use CodeIgniter\Model;

class ApotekModel extends Model
{
    protected $table = 'apotek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_obat', 'jenis_obat', 'harga', 'stok'];
    protected $useTimestamps = true;
}
