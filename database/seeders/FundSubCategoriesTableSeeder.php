<?php

namespace Database\Seeders;

use App\Models\FundCategory;
use App\Models\FundSubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FundSubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // all category
        $categories = FundCategory::all();

        FundSubCategory::factory(100)->create()->each(function ($subCategory) use ($categories){
            // choose randomly category_id

            $radnomCategory = $categories->random();

            // Link the fund with the selected categories
            
            $subCategory->update([
                "category_id" => $radnomCategory->id
            ]);
        });
    }
}
