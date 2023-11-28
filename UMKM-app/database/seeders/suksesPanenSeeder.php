<?php

namespace Database\Seeders;

use App\Models\suksesPanen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class suksesPanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        suksesPanen::factory()->count(100)->create();
    }
}
