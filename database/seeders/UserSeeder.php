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
            'image' => 'default.png',
            'email' => 'arguspermono19@gmail.com',
            'email_verified_at' => now(),
            'is_admin' => '1',
            'password' => Hash::make('argus123'),
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'Selly Ajeng',
            'username' => 'PAUSS',
            'image' => 'default.png',
            'email' => 'blablabla@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('selly123'),
            'remember_token' => Str::random(10)
        ]);
    }
}
