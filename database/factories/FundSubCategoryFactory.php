<?php

namespace Database\Factories;

use App\Models\FundCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FundSubCategory>
 */
class FundSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = FundCategory::inRandomOrder()->first();

        return [
            "category_id" => $category->id,
            "name" => $this->faker->word
        ];
    }
}
