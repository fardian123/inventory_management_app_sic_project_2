<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use hash;


class BarangImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'id'=> $row['id'],
            'nama_barang'=> $row['nama_barang'],
            'jumlah'=> $row['jumlah'],
            'tanggal_masuk'=> $row['tanggal_masuk'],
            'tanggal_keluar'=> $row['tanggal_keluar'],
            'pengirim'=> $row['pengirim'],
            'penerima'=> $row['penerima'],
        ]);
    }
}
