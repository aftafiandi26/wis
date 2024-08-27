<?php

namespace Database\Factories;

use App\Models\Employes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employes>
 */
class EmployesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employes::class;

    public function definition(): array
    {
        return [
            'nik'               => fake()->unique()->randomNumber(8, true),
            'first_name'        => fake()->firstName(),
            'last_name'         => fake()->lastName(),
            'gender'            => fake()->randomElement(['male', 'female']),
            'department_id'     => rand(1, 7),
            'position'          => fake()->jobTitle(),
            'emp_status'        => fake()->randomElement(['Permanent', 'Contract', 'Intern']),
            'join_contract'     => Carbon::now(),
            'end_contract'      => Carbon::now()->addYear(),
            'bod'               => fake()->dateTime(),
            'pob'               => fake()->city(),
            'province'          => fake()->state(),
            'maiden'            => fake()->firstNameFemale(),
            'email'             => fake()->safeEmail(),
            'id_card'           => fake()->numerify('############'),
            'phone'             => fake()->e164PhoneNumber(),
            'address'           => fake()->streetAddress(),
            'area'              => fake()->streetName(),
            'city'              => fake()->city(),
            'education'         => "Strata 1",
            'institution'       => fake()->company(),
            'marital_status'    => "Single",
            'npwp'              => fake()->numerify('#######'),
            'kk'                => fake()->numerify('##########'),
            'religion'          => "Islam",
            'bpjs_ketenagakerjaan'   => fake()->numerify('#################'),
            'bpjs_kesehatan'   => fake()->numerify('#################'),
            'active'            => rand(1, 0),
        ];
    }
}