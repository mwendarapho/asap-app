<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => random_int(1,30),
            'qty'=> random_int(1,5),
             'amount' => $this->faker->randomFloat(2, 2),
             'description' => $this->faker->catchPhrase,
            'invoice_no' => $this->faker->biasedNumberBetween(1,100),
        ];
    }
}
