<?php

namespace Database\Factories;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'id' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'nama_barang' => $this->faker->randomElement([
                "telepon",
                "komputer",
                "laptop",
                "tablet",
                "smartphone",
                "buku",
                "pensil",
                "pulpen",
                "penghapus",
                "penggaris",
                "meja",
                "kursi",
                "lemari",
                "rak",
                "tempat tidur",
                "piring",
                "mangkuk",
                "sendok",
                "garpu",
                "pisau",
                "gelas",
                "botol",
                "kulkas",
                "kompor",
                "microwave",
                "pakaian",
                "celana",
                "kaus",
                "kemeja",
                "rok",
                "sabun",
                "sampo",
                "pasta gigi",
                "sikat gigi",
                "handuk",
                "buah",
                "sayur",
                "nasi",
                "daging",
                "ikan",
                "kopi",
                "teh",
                "susu",
                "air",
                "jus",
                "kertas",
                "gunting",
                "stapler",
                "perekat",
                "spidol",
                "jam tangan",
                "kalung",
                "cincin",
                "anting-anting",
                "gelang",
                "uang",
                "dompet",
                "tas",
                "koper",
                "payung",
                "kunci",
                "kacamata",
                "topi",
                "sepatu",
                "sandal",
                "mouse",
                "keyboard",
                "monitor",
                "headset",
                "speaker",
                "baterai",
                "charger",
                "kabel",
                "flashdisk",
                "harddisk"
            ]),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'tanggal_masuk' => $tanggalMasuk = today(),
            'tanggal_keluar' => $this->faker->optional()->dateTimeBetween($tanggalMasuk, $tanggalMasuk->format('Y-m-d H:i:s') . ' +1 week'),
            'Pengirim' => $this->faker->name,
            'Penerima' => $this->faker->name,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Barang $barang) {
            $barang->resi()->create([
                'nomor_resi' => $this->faker->unique()->numerify('RESI-####'),
                'tanggal' => $this->faker->date(),
            ]);
        });
    }
}
