<?php

namespace Database\Factories;

use App\Models\Paymode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paymode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker->word(),
        ];
    }
}
