<?php

namespace Database\Factories;

use App\Models\suksesPanenTelur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\suksesPanenTelur>
 */
class suksesPanenTelurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = suksesPanenTelur::class;
    public function definition(): array
    {
        $timestamp = $this->faker->dateTimeBetween('-1 year', 'now');
        $timestamp->setISODate($timestamp->format('o'), $timestamp->format('W'), 1); // Set to Monday of the current week
        return [
            'Umkm_id' => 3,
            'Produk_id' => $this->faker->numberBetween(3, 4),
            'jumlah_sukses' => $this->faker->numberBetween(1, 100),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
