<?php

namespace Database\Seeders;

use App\Models\suksesHewanBiasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class suksesHewanBiasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        suksesHewanBiasa::factory()->count(100)->create();
    }
}
