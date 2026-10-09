<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $daftarBarang = [
            ['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 10],
            ['nama' => 'Pulpen', 'harga' => 3000, 'stok' => 15],
            ['nama' => 'Penggaris', 'harga' => 4000, 'stok' => 8],
            ['nama' => 'Pensil 2B', 'harga' => 2500, 'stok' => 20],
            ['nama' => 'Penghapus', 'harga' => 1500, 'stok' => 12],
        ];

        foreach ($daftarBarang as $b) {
            Barang::create($b);
        }
    }
}
