<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerita extends Model
{
    protected $table = 'ceritas';
    protected $fillable = ['judul', 'penulis', 'deskripsi', 'cover', 'jumlah_baca', 'status', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
