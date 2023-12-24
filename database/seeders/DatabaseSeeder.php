<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FundCategoriesTableSeeder::class);
        $this->call(FundSubCategoriesTableSeeder::class);
        $this->call(FundsTableSeeder::class);
        $this->call(UserFundsTableSeeder::class);
    }
}
