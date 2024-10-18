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
            'title' => 'Poster 1',
            'slug' => 'poster-1',
            'image' => 'poster1.png',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo rem perferendis excepturi eveniet sit, laborum veritatis sed at! Rem repellendus perspiciatis amet quos harum iste et similique error earum maiores.',
        ]);
        Poster::create([
            'title' => 'Poster 2',
            'slug' => 'poster-2',
            'image' => 'poster2.png',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo rem perferendis excepturi eveniet sit, laborum veritatis sed at! Rem repellendus perspiciatis amet quos harum iste et similique error earum maiores.',
        ]);
        Poster::create([
            'title' => 'Poster 3',
            'slug' => 'poster-3',
            'image' => 'poster3.png',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo rem perferendis excepturi eveniet sit, laborum veritatis sed at! Rem repellendus perspiciatis amet quos harum iste et similique error earum maiores.',
        ]);
    }
}
