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
            'member_id' => $this->faker->randomDigit,
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 2),
            'description' => $this->faker->words,
            'invoice_no' => $this->faker->randomDigit,
        ];
    }
}
