<?php

namespace Database\Seeders;

use App\Models\gagalPanen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class gagalPanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        gagalPanen::factory()->count(100)->create();
    }
}
