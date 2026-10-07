<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cerita;
use App\Models\Kategori;
use App\Models\Tag;

class CeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Petualangan di Negeri Awan', 'Novel', ['Fantasi', 'Aksi']],
            ['Cinta di Musim Hujan', 'Novel', ['Romance', 'Drama']],
            ['Bayangan Tengah Malam', 'Manhwa', ['Horor', 'Misteri']],
            ['Pedang Sang Penjaga', 'Manga', ['Aksi', 'Fantasi']],
            ['Kota Tanpa Langit', 'Manhua', ['Sci-Fi', 'Misteri']],
            ['Surat untuk Musim Panas', 'Novel', ['Romance', 'Slice of Life']],
            ['Raja Iblis Pensiun', 'Manga', ['Komedi', 'Fantasi']],
            ['Dapur Ajaib Nenek', 'Novel', ['Komedi', 'Slice of Life']],
            ['Sekolah Para Bayangan', 'Manhwa', ['Aksi', 'Horor']],
            ['Naga di Ujung Senja', 'Manhua', ['Fantasi', 'Drama']],
            ['Kembali ke Tahun 2010', 'Novel', ['Drama', 'Sci-Fi']],
            ['Detektif Kucing', 'Manga', ['Misteri', 'Komedi']],
            ['Putri yang Dilupakan', 'Manhwa', ['Romance', 'Drama']],
            ['Kultivator Malas', 'Manhua', ['Komedi', 'Aksi']],
            ['Menara Seribu Pintu', 'Novel', ['Fantasi', 'Misteri']],
            ['Hujan di Kota Lama', 'Novel', ['Drama', 'Romance']],
            ['Klub Detektif Sepulang Sekolah', 'Manga', ['Misteri', 'Slice of Life']],
            ['Penyihir Tanpa Sihir', 'Manhwa', ['Fantasi', 'Komedi']],
            ['Langit Merah Neo-Jakarta', 'Manhua', ['Sci-Fi', 'Aksi']],
            ['Rumah di Ujung Gang', 'Novel', ['Horor', 'Drama']],
        ];
        
         $penulis = ['Penulis A', 'Penulis B', 'Penulis C', 'Penulis D'];

        foreach ($data as [$judul, $kategori, $tags]) {
            $cerita = Cerita::updateOrCreate(
                ['judul' => $judul],
                [
                    'penulis' => $penulis[array_rand($penulis)],
                    'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ini deskripsi dummy yang nanti kamu ganti sendiri.',
                    'jumlah_baca' => rand(1000, 900000),
                    'kategori_id' => Kategori::where('nama', $kategori)->first()->id,
                ]
            );

            $cerita->tags()->sync(Tag::whereIn('nama', $tags)->pluck('id'));
        }
    }
}