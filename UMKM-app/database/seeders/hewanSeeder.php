<?php

namespace Database\Seeders;

use App\Models\hewan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class hewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        hewan::create([
            'Umkm_id' => '3',
            'nama' => 'Kuda Liar',
            'harga' => '10000',
            'group' => 'Hewan Penghasil Bahan Pakan Lainnya'
        ]);
        hewan::create([
            'Umkm_id' => '3',
            'nama' => 'Kucing Hutan',
            'harga' => '11000',
            'group' => 'Hewan Penghasil Bahan Pakan Lainnya'
        ]);
        hewan::create([
            'Umkm_id' => '3',
            'nama' => 'Ayam Sakti',
            'harga' => '9000',
            'group' => 'Hewan Penghasil Bahan Pakan Telur'
        ]);
        hewan::create([
            'Umkm_id' => '3',
            'nama' => 'Angsa Lawan Po',
            'harga' => '7000',
            'group' => 'Hewan Penghasil Bahan Pakan Telur'
        ]);
    }
}
