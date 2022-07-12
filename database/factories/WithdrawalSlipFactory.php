<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WithdrawalSlip>
 */
class WithdrawalSlipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $document_series_no = 1;
    
    public function definition()
    {
        return [
            'customer_name'         => $this->faker->name(), 
            'document_series_no'    => 'GFI-MI-'.date('Y').'-'.sprintf("%05d", self::$document_series_no++),
            'pallet_no'             => $this->faker->numberBetween($min = 1000, $max = 9000),
            'warehouse'             => $this->faker->city(),
            'wh_location'           => $this->faker->address(),
            'profit_center'         => $this->faker->name(),
            'sub_profit_center'     => $this->faker->name(),
            'prepared_by'           => $this->faker->name(),
            'approved_by'           => $this->faker->name(),
            'released_by'           => $this->faker->name()
        ];
    }
}
