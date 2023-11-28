<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\gagalPanen;
use App\Models\pertanianT;
use App\Models\transaction;
use App\Models\gagalHewanBiasa;
use App\Models\peternakanT;
use App\Models\produkPertanian;
use App\Models\suksesPanenTelur;
use Illuminate\Database\Seeder;
use Database\Seeders\produkSeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\gagalHewanBiasaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeds::class);
        $this->call(TransactionSeeder::class);
        $this->call(produkSeeder::class);
        $this->call(umkmSeeder::class);
        $this->call(gagalPanenSeeder::class);
        $this->call(ProdukPertanianSeeder::class);
        $this->call(suksesPanenSeeder::class);
        $this->call(pertanianTSeeder::class);
        $this->call(hewanSeeder::class);
        $this->call(gagalHewanBiasaSeeder::class);
        $this->call(suksesHewanBiasaSeeder::class);
        $this->call(gagalPanenTelurSeeder::class);
        $this->call(suksesPanenTelurSeeder::class);
        $this->call(peternakanTSeeder::class);



    }
}
