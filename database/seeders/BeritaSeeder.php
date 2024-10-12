<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Berita::create([
                'title' => 'Berita Pertama',
                'slug' => 'berita-pertama',
                'image' => 'gambar1.jpg',
                'kategori_id' => 1, 
                'deskripsi' => 'Ini deskripsi berita pertama.',
        ]);
        Berita::create([
                'title' => 'Berita Kedua',
                'slug' => 'berita-kedua',
                'image' => 'gambar2.jpg',
                'kategori_id' => 2, 
                'deskripsi' => 'Ini deskripsi berita kedua.',
        ]);
    }
}
