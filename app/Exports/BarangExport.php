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

    protected $startDate;
    protected $endDate;
    protected $scheduleFilter;

    protected $filterBy;


    public function __construct($startDate, $endDate, $scheduleFilter, $filterBy)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->scheduleFilter = $scheduleFilter;
        $this->filterBy = $filterBy;

    }


    public function collection()
    {

        $query = Barang::select(
            'barangs.id',
            'barangs.nama_barang',
            'barangs.jumlah',
            'barangs.tanggal_masuk',
            'barangs.tanggal_keluar',
            'barangs.pengirim',
            'barangs.penerima',
            'resis.nomor_resi',
            'resis.tanggal as tanggal_resi'
        )
            ->leftJoin('resis', 'barangs.id', '=', 'resis.barang_id')->whereBetween($this->filterBy,[$this->startDate, $this->endDate]);
        ;

        if ($this->scheduleFilter !== null) {
            if ($this->scheduleFilter === "scheduled") {
                $query->whereNotNull('tanggal_keluar');
            } else {
                $query->whereNull('tanggal_keluar');
            }
        }

        return $query->get();


    }

    public function headings(): array
    {
        return ["id", "nama_barang", "jumlah", "tanggal_masuk", "tanggal_keluar", "pengirim", "penerima", "RESI", "RESI dibuat"];
    }
}
