<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Resi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_resi',
        'barang_id',
        'tanggal',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
