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
            'logo' => $this->faker->url(),
            'banner' => $this->faker->url(),
            'service' => $this->faker->randomElement(['store' ,'delivery', 'all'])
        ];
    }
}
