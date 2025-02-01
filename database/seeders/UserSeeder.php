<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'id' => "5f1b45b2-24a6-41d8-a5cc-223cc9a6f004",
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'id_level' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'id_level' => 2,
            ]
        ]);
    }
}
