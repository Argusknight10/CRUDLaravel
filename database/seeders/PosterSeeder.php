<?php

namespace Database\Seeders;

use App\Models\Poster;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poster::create([
            'title' => 'Poster Pertama',
            'slug' => 'poster-pertama',
            'image' => 'poster1.png',
        ]);
        Poster::create([
            'title' => 'Poster Kedua',
            'slug' => 'poster-kedua',
            'image' => 'poster2.png',
        ]);
        Poster::create([
            'title' => 'Poster Ketiga',
            'slug' => 'poster-ketiga',
            'image' => 'poster3.png',
        ]);
    }
}
