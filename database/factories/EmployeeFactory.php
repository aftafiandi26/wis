<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'nik'        => fake()->unique()->numberBetween(),
            'email'      => fake()->unique()->email,
            'position'   => fake()->jobTitle(),
            'emp_status' => fake()->randomElement(['permanent', 'contract']),
            'bod'       => fake()->dateTime(),
            'gender'    => fake()->randomElement(['Male', 'Female']),
            'department_id' => rand(1, 5),
            'join_of_contract'       => fake()->dateTime(),
        ];
    }
}
