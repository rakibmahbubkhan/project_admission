<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    public function definition(): array
    {
        $universities = [
            'Oxford University',
            'Harvard University',
            'Daffodil International University',
            'United International University',
            'Stanford University',
            'MIT',
            'Peking University',
            'Tsinghua University',
        ];

        return [
            'name' => $this->faker->randomElement($universities),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'logo' => null,
            'details' => $this->faker->paragraph(),
            'isActive' => 1,
        ];
    }
}
