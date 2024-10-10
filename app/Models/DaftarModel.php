<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarModel extends Model
{
    protected $table = 'daftar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'id_dokter', 'id_poli', 'tanggal_daftar', 'alasan', 'no_antrian', 'approved'];

    public function getNextQueueNumber()
    {
        $today = date('Y-m-d');
        $lastQueue = $this->where('DATE(tanggal_daftar)', $today)->orderBy('id', 'DESC')->first();
        
        $lastQueueNumber = $lastQueue ? (int)substr($lastQueue['no_antrian'], 1) : 0;
        return 'A' . ($lastQueueNumber + 1);
    }

    public function getDataPasien()
    {
        return $this->join('pasien', 'pasien.id=daftar.id_pasien')
        ->join('poli', 'poli.id=daftar.id_poli')
        ->join('dokter', 'dokter.id=daftar.id_dokter', 'left')
        ->where('approved', 0)
        ->where('tanggal_daftar', date('Y-m-d'))
        ->orderBy('tanggal_daftar', 'DESC')
        ->findAll();
    }

    public function getDataSecondPasien()
    {
        
        return $this->db->table($this->table)
        ->join('second_pasien', 'second_pasien.id=daftar.id_pasien')
        ->join('poli', 'poli.id=daftar.id_poli')
        ->join('dokter', 'dokter.id=daftar.id_dokter', 'left')
        ->where('approved', 0)
        ->where('tanggal_daftar', date('Y-m-d'))
        ->orderBy('tanggal_daftar', 'DESC')
        ->get()
        ->getResultArray();

    }

    public function gabungData()
    {
        
        $dataA = $this->getDataPasien();
        $dataB = $this->getDataSecondPasien();

        // Menggabungkan hasil dari dua query
        $combinedData = array_merge($dataA, $dataB);

        return $combinedData;

    }

    public function getCombinedData($approvedStatus, $tanggal = null)
    {
        // if($tanggalDaftar !== null){
        //     $tanggalFilter = ' AND daftar.tanggal_daftar = ' . $this->db->escape($tanggalDaftar);
        // }else{
        //     $tanggalFilter = '';
        // }

        $query1 = $this->db->table('daftar')
                        ->select('daftar.*, pasien.nama_pasien, poli.nama_poli, dokter.nama_dokter')
                        ->join('pasien', 'pasien.id=daftar.id_pasien')
                        ->join('poli', 'poli.id=daftar.id_poli')
                        ->join('dokter', 'dokter.id=daftar.id_dokter', 'left')
                        ->where('daftar.approved', $approvedStatus);
                        // ->where('1=1'. $tanggalFilter)
                        // ->orderBy('daftar.tanggal_daftar', 'DESC')
                        // Tambahkan kondisi untuk tanggal
                        if ($tanggal) {
                            $query1->where('daftar.tanggal_daftar', $tanggal);
                        } else {
                            // Kecualikan tanggal hari ini jika tidak ada parameter tanggal
                            $query1->where('daftar.tanggal_daftar !=', date('Y-m-d'));
                        }

                        $query1 = $query1->getCompiledSelect();
        
        $query2 = $this->db->table('daftar')
                        ->select('daftar.*, second_pasien.nama_pasien, poli.nama_poli, dokter.nama_dokter')
                        ->join('second_pasien', 'second_pasien.id=daftar.id_pasien')
                        ->join('poli', 'poli.id=daftar.id_poli')
                        ->join('dokter', 'dokter.id=daftar.id_dokter', 'left')
                        ->where('daftar.approved', $approvedStatus);
                        // ->where('1=1'. $tanggalFilter)
                        // ->orderBy('daftar.tanggal_daftar', 'DESC')
                        // Tambahkan kondisi untuk tanggal
                        if ($tanggal) {
                            $query2->where('daftar.tanggal_daftar', $tanggal);
                        } else {
                            // Kecualikan tanggal hari ini jika tidak ada parameter tanggal
                            $query2->where('daftar.tanggal_daftar !=', date('Y-m-d'));
                        }
                        $query2 = $query2->getCompiledSelect();
        
        $finalQuery = $this->db->query($query1 . ' UNION ' . $query2 . ' ORDER BY tanggal_daftar DESC');
        return $finalQuery->getResultArray();
    }
}
