<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WithdrawalSlip;
use App\Models\Item;
use App\Models\User;

class WithdrawalSlipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)
        ->create()
        ->each(function ($user) {
            WithdrawalSlip::factory(5)
            ->create(['user_id' => $user->id])
            ->each(function ($withdrawalslip) {
                Item::factory(5)
                    ->create(['withdrawal_slip_id' => $withdrawalslip->id]);
            });
        });
        
    }
}
