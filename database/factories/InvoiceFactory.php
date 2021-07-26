<?php

namespace Database\Factories;


use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;


class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice:: class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'member_id' => random_int(1,100),
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),

        ];
    }
}
