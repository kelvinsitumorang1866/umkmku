<?php

namespace Database\Seeders;

use App\Models\produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class produkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'Umkm_id' => '1',
            'Nama_produk' => 'M16',
            'harga' => '7000',
            'kode_barang' => '123'
        ]);
        
        Produk::create([
            'Umkm_id' => '1',
            'Nama_produk' => 'Ak47',
            'harga' => '7000',
            'kode_barang' => '123'
        ]);
        
        Produk::create([
            'Umkm_id' => '1',
            'Nama_produk' => 'Glock',
            'harga' => '7000',
            'kode_barang' => '123'
        ]);
    }
}
