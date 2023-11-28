<?php

namespace Database\Seeders;

use App\Models\gagalPanenTelur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class gagalPanenTelurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        gagalPanenTelur::factory()->count(100)->create();

    }
}
