<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
                'cpf' => $faker->cpf(false),
                'telefone' => $faker->cellphoneNumber,
                'administrador' => $faker->boolean(50)
            ]);
        }
    }
}
