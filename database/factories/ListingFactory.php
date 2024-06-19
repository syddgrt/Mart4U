<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stock_name' => $this->faker->word(),
            'tags' => 'drinks, food',
            'stock_price' => $this->faker->randomFloat(2, min:1, max:100),
            'stock_quantity' => $this->faker->randomNumber(),
            'stock_description' => $this->faker->paragraph(5),
        ];
    }

    
}
