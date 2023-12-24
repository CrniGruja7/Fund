<?php

namespace Database\Seeders;

use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\FundSubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // all category and subCategory

        $categories = FundCategory::all();
        $subCategories = FundSubCategory::all();

        // crete 10000 funds

        Fund::factory(1000)->create()->each(function ($fund) use ($categories, $subCategories){
            // choose randomly category and sub_category
            $randomCategory = $categories->random();
            $randomSubCategory = $subCategories->random();

            // Link the fund with the selected categories
            $fund->update([
                'fund_category_id' => $randomCategory->id,
                'fund_sub_category_id' => $randomSubCategory->id
            ]);
        });
    }
}
