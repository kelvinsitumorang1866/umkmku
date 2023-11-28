<?php

namespace Database\Factories;

use App\Models\suksesHewanBiasa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\suksesHewanBiasa>
 */
class suksesHewanBiasaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = suksesHewanBiasa::class;
    public function definition(): array
    {
        $timestamp = $this->faker->dateTimeBetween('-1 year', 'now');
        $timestamp->setISODate($timestamp->format('o'), $timestamp->format('W'), 1); // Set to Monday of the current week
        return [
            'Umkm_id' => 3,
            'Produk_id' => $this->faker->numberBetween(1, 2),
            'jumlah_sukses' => $this->faker->numberBetween(1, 100),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
