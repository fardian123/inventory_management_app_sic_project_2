<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resi;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [
        'tanggal_masuk'
    ];
    protected $fillable = [
        'id',
        'nama_barang',
        'jumlah',
        'tanggal_masuk',
        'tanggal_keluar',
        'pengirim',
        'penerima',
    ];

    public function resi()
    {
        return $this->hasOne(Resi::class);
    }


}


