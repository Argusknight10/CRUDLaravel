<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Arya Bagus',
            'username' => 'ARGUS',
            'image' => 'public/storage/img/default.png',
            'email' => 'arguspermono19@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'Selly Ajeng',
            'username' => 'PAUSS',
            'image' => 'public/storage/img/default.png',
            'email' => 'blablabla@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}
