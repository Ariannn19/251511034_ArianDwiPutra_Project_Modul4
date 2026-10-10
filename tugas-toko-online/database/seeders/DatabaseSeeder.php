<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR-001',
            'nama_lengkap' => 'Arian Dwi Putra',
            'email' => 'arian@example.com',
            'username' => 'arian',
            'password' => Hash::make('rahasia123'),
            'no_hp' => '081234567890',
            'alamat' => 'Bandung',
        ]);

        $products = [
            ['BRG-001', 'Indomie Goreng', 'Mie instan rasa mi goreng original', 3000, 50, 'indomie_goreng.jpg'],
            ['BRG-002', 'Indomie Kuah Ayam Bawang', 'Mie instan kuah rasa ayam bawang', 2800, 40, 'indomie_ayambawang.jpg'],
            ['BRG-003', 'Indomie Kari Ayam', 'Mie instan kuah rasa kari ayam spesial', 3000, 35, 'indomie_kari.jpg'],
            ['BRG-004', 'Indomie Rendang', 'Mie instan goreng rasa rendang', 3200, 25, 'indomie_rendang.jpg'],
            ['BRG-005', 'Sedap Goreng', 'Mie goreng ', 3000, 45, 'sedaap_goreng.jpg'],
            ['BRG-006', 'Indomie Goreng Jumbo', 'Mie instan goreng porsi jumbo lebih puas', 4500, 40, 'indomie_goreng_jumbo.jpg'],
            ['BRG-007', 'Indomie Rendang Jumbo', 'Mie instan goreng rasa rendang porsi jumbo', 4700, 35, 'indomie_rendang_jumbo.jpg'],
            ['BRG-008', 'Indomie Cabe Ijo', 'Mie instan goreng rasa sambal cabai hijau', 3200, 50, 'indomie_cabeijo.jpg'],
            ['BRG-009', 'Indomie Rica Rica', 'Mie instan goreng rica-rica pedas', 3200, 30, 'indomie_ricarica.jpg'],
            ['BRG-010', 'Indomie Soto Lamongan', 'Mie instan kuah rasa soto lamongan ', 3000, 45, 'indomie_sotolamongan.jpg'],    
        ];

        foreach ($products as $p) {
            Product::create([
                'id_barang' => $p[0],
                'nama_barang' => $p[1],
                'deskripsi' => $p[2],
                'harga' => $p[3],
                'stok' => $p[4],
                'gambar' => $p[5],
            ]);
        }
    }
}