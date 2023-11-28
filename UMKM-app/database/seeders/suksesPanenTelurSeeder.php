<?php

namespace Database\Seeders;

use App\Models\suksesPanenTelur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class suksesPanenTelurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        suksesPanenTelur::factory()->count(100)->create();
    }
}
