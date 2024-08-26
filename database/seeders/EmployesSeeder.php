<?php

namespace Database\Seeders;

use App\Models\Employes;
use Database\Factories\EmployesFactory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployesSeeder extends Seeder
{
    public function run(): void
    {
        Employes::factory()->count(300)->create();

    }
}
