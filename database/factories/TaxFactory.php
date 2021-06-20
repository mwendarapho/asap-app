<?php

namespace Database\Factories;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'code'=>['0%','8%','16%'],
            //'rate'=>[0,0.08,0.16]

            'code'=>$this->faker->bothify('Tx-##??'),
            'rate'=>$this->faker->randomNumber(2),
        ];
           
    }
}
