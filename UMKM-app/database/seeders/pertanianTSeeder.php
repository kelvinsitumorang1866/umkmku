<?php

namespace Database\Seeders;

use App\Models\pertanianT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pertanianTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pertanianT::factory()->count(100)->create();
    }
}
