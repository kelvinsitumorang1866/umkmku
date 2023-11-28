<?php

namespace Database\Factories;

use App\Models\gagalPanen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\gagalPanen>
 */
class gagalPanenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = gagalPanen::class;
    public function definition(): array
    { $timestamp = $this->faker->dateTimeBetween('-1 year', 'now');
        $timestamp->setISODate($timestamp->format('o'), $timestamp->format('W'), 1); // Set to Monday of the current week
        return [
            'Umkm_id' => 2,
            'Produk_id' => $this->faker->numberBetween(1, 3),
            'jumlah_gagal' => $this->faker->numberBetween(1, 100),
            'keterangan' => $this->faker->randomElement(['Cuaca', 'Hama', 'Lainnya']),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
