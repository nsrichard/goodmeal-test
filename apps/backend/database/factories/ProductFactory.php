<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'store_id' => $this->faker->numberBetween(1, Store::count()),
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(200, 200),
            'price' => $this->faker->randomDigit,
            'discount' => $this->faker->numberBetween(0, 70),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
