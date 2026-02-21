<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    protected $model = Kelas::class;

    public function definition()
    {
        return [
            'nama_kelas' => 'Kelas ' . $this->faker->unique()->randomNumber(2),
            'kapasitas'  => $this->faker->numberBetween(20, 40),
            'user_id'    => null,
        ];
    }
}
