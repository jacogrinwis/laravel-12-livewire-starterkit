<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(6, true);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'user_id' => $this->faker->numberBetween(1, 2),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'length' => $this->faker->randomFloat(2, 1, 100),
            'height' => $this->faker->randomFloat(2, 1, 100),
            'width' => $this->faker->randomFloat(2, 1, 100),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'weight' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
