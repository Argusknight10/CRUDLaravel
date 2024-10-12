<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'name' => 'HIBURAN',
            'slug' => 'hiburan',
        ]);
        Kategori::create([
            'name' => 'OLAHRAGA',
            'slug' => 'olahraga',
        ]);
        Kategori::create([
            'name' => 'POLITIK',
            'slug' => 'politik',
        ]);
        Kategori::create([
            'name' => 'KESEHATAN',
            'slug' => 'kesehatan',
        ]);
    }
}
