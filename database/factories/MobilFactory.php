<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MobilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipe = ['Hybrid', 'Coupe', 'Sport Car', 'Hatchback', 'Mini Truck'];
        return [
            "mesin" => $this->faker->randomDigitNotNull(),
            "kapasitas_penumpang" => rand(2, 7),
            "tipe" => Arr::random($tipe),
        ];
    }
}
