<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Facades\Purifier;

class Bab extends Model
{
    protected $fillable = ['cerita_id', 'nomor', 'judul', 'isi'];

    public function cerita()
    {
        return $this->belongsTo(Cerita::class);
    }

    // Hanya tag aman yang boleh tersimpan
    public static function bersihkan(?string $html): string
    {
        return Purifier::clean($html ?? '', [
            'HTML.Allowed' => 'p,br,strong,b,em,i,u,s,blockquote,ul,ol,li,a[href],img[src|alt]',
        ]);
    }
}
