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

        $currencies = [
            'BDT',
            'USD',
            'RMB',
            'GBP',
            'EURO',
            'INR',
        ];

        $rankings = [
            '3.50',
            '4.50',
            '5.00',
            '4.90',
            '4.00',
            '3.00',
        ];

        $boolians =['0', '1'];

        return [
            'name' => $this->faker->randomElement($universities),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'logo' => null,
            'content' => $this->faker->paragraph(),
            'currency'=> $this->faker->randomElement($currencies),
            'image'=> null ,
            'ranking'=> $this->faker->randomElement($rankings),
            'intake'=>  'Fall ' . rand(2025, 2027),
            'deadline'=> $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'description'=> $this->faker->paragraph(),
            'isActive' => $this->faker->randomElement($boolians),
        ];
    }
}
