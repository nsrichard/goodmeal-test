<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'about' => $this->faker->paragraph(),
            'logo' => $this->faker->imageUrl(70, 70),
            'banner' => $this->faker->imageUrl(400, 200),
            'service' => $this->faker->randomElement(['store' ,'delivery', 'all']),
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
        ];
    }
}
