<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Resi;
use App\Models\Barang;
class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'id' => rand(1,3).rand(100000,999999),
                'nama_barang' => 'Laptop',
                'jumlah' => 10,
                'tanggal_masuk'=> Carbon::now(),
                'tanggal_keluar' => Carbon::today()->addDays(rand(0, 30)),
                'Pengirim' => 'John Doe',
                'Penerima' => 'Jane Smith',
            ],
            [
                'id' => rand(1,3).rand(100000,999999),
                'nama_barang' => 'Smartphone',
                'jumlah' => 20,
                'tanggal_masuk'=> Carbon::now(),
                'tanggal_keluar' =>  Carbon::today()->addDays(rand(0, 30)),
                'Pengirim' => 'Alice Johnson',
                'Penerima' => 'Bob Brown',
            ],
            
        ];

        foreach ($barangs as $barang) {
            $createdBarang = Barang::create($barang);

            // Buat resi untuk barang yang baru dibuat
            Resi::create([
                'nomor_resi' => 'RESI' . rand(100000, 999999),
                'barang_id' => $createdBarang->id,
                'tanggal' => Carbon::now(),
            ]);
        }
    }
}
