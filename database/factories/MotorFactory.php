<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MotorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipeSuspensi = ['Manual', 'Automatic'];
        $tipeTransmisi = ['USD', 'Telescopic'];
        return [
            "mesin" => $this->faker->randomDigitNotNull(),
            "tipe_suspensi" => Arr::random($tipeSuspensi),
            "tipe_transmisi" => Arr::random($tipeTransmisi),
        ];
    }
}
