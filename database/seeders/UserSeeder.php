<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected static ?string $password;

    public function run(): void
    {
        $data = [
            'remember_token' => null,

            'username'  => null,
            'name' => fake()->name(),
            'email' => 'user.gm@test.com',
            'password' => static::$password ??= Hash::make('12345678'),
            'active'    => true,
            'department_id' => 1,
            'officer'       => true,
            'production'       => false,
        ];

        User::create($data);
    }
}
