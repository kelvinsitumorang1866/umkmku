<?php

namespace Database\Seeders;

use App\Models\ProdukPertanian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukPertanianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProdukPertanian::create([
            'Umkm_id' => 2,
            'Nama_produk' => 'Padi',
            'harga' => 5000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ProdukPertanian::create([
            'Umkm_id' => 2,
            'Nama_produk' => 'Jagung',
            'harga' => 7000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ProdukPertanian::create([
            'Umkm_id' => 2,
            'Nama_produk' => 'Kentang',
            'harga' => 6000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

