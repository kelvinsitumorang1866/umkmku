<?php

namespace Database\Seeders;

use App\Models\gagalHewanBiasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class gagalHewanBiasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        gagalHewanBiasa::factory()->count(100)->create();
    }
}
