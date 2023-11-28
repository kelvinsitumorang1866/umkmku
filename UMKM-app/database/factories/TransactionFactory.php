<?php

namespace Database\Factories;

use App\Models\transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = transaction::class;
    public function definition(): array
    {   
        $timestamp = $this->faker->dateTimeBetween('-1 year', 'now');
        $timestamp->setISODate($timestamp->format('o'), $timestamp->format('W'), 1); // Set to Monday of the current week
        return [
        'Umkm_id' => 1, // Assuming Umkm_id is always 1 for all records
        'Produk_id' => fake()->numberBetween(1, 3), // Random Produk_id between 1 and 3
        'jumlah' => fake()->randomNumber(2),
        'ammount' => fake()->randomNumber(5),
        'created_at' => $timestamp,
        ];
    }
}
