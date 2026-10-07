<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $daftar = ['Fantasi', 'Drama', 'Romance', 'Aksi', 'Komedi', 'Horor', 'Misteri', 'Sci-Fi', 'Slice of Life'];

        foreach ($daftar as $nama) {
            Tag::updateOrCreate(['nama' => $nama], ['slug' => Str::slug($nama)]);
        }
    }
}
