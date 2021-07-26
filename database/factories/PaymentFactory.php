<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Paymode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'amount'=>$this->faker->randomNumber(4),
            'pay_date'=>$this->faker->date('Y-m-d','now','2016-01-01'),
            'member_id'=>random_int(1,10),
            'ref'=>$this->faker->catchPhrase(),
            'paymode_id'=>random_int(1,5),


        ];
    }
}
