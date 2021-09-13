<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'fname'=>$this->faker->firstName(),
            'lname'=>$this->faker->lastName(),
            'mobile'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
            'email'=>$this->faker->unique()->safeEmail(),
            'dob'=>$this->faker->date(),
            'spouse_name'=>$this->faker->firstName().' '.$this->faker->lastName(),
            'spouse_mobile'=>$this->faker->phoneNumber(),
            'joined_on'=>$this->faker->date(),
            'left_on'=>$this->faker->date(),
            'status'=>$this->faker->boolean(),
            'category_id'=>$this->faker->numberBetween(1,2),
        ];
    }
}
