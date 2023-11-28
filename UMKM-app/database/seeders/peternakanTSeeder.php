<?php

namespace Database\Seeders;

use App\Models\peternakanT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class peternakanTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        peternakanT::factory()->count(100)->create();

    }
}
