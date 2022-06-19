<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'namaPaket' => $this->faker->name,
            'harga' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'deskripsi' => 'foo',
            'idPenginapan' => $this->faker->numberBetween($min = 1, $max = 100),
            'idWisata' => $this->faker->numberBetween($min = 1, $max = 100),
            'idJasa' => $this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
