<?php

namespace Database\Factories;

use App\Models\FundCategory;
use App\Models\FundSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fund>
 */
class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = FundCategory::inRandomOrder()->first();     // vraca niz random category-a iz FundCategory i vraca prvi
        $subCategory = FundSubCategory::inRandomOrder()->first();   // vraca niz random subcategory-a iz FundSubCategory i vraca prvi

        return [
            "name" => $this->faker->word,
            "fund_category_id" => $category->id,
            "fund_sub_category_id" => $subCategory->id,
            "ISIN" => $this->faker->unique()->regexify('[A-Z0-9]{12}'),
            "WKN" => $this->faker->unique()->regexify('[A-Z0-9]{6}'),


        ];
    }
}
