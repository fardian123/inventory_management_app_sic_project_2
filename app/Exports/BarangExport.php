<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class BarangExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Barang::select('id', 'nama_barang', 'jumlah', 'tanggal_masuk', 'tanggal_keluar', 'pengirim', 'penerima')->get();
    }

    public function headings(): array
    {
        return ["id", "nama_barang", "jumlah","tanggal_masuk","tanggal_keluar","pengirim","penerima"];
    }
}
