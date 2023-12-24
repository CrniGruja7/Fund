<?php

namespace Database\Seeders;

use App\Models\Fund;
use App\Models\User;
use App\Models\UserFund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user){
            // Prvo uzmem slucajan fond koji jos uvek nije dodeljen ni jednom korisniku

            $unusedFund = Fund::whereDoesntHave('userFunds',function ($query) use ($user) {
                $query->where('user_id',$user->id);
            });

            // Zatim izaberem slucajan fund

            $randomFund = $unusedFund->random();

            //pravljenje UserFund sa odabranim fondom

            UserFund::factory()->create([
                'user_id' => $user->id,
                'fund_id' => $randomFund->id
            ]);
        });
    }
}
