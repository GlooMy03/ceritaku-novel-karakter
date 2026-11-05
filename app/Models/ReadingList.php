<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingList extends Model
{
     protected $fillable = ['user_id', 'cerita_id', 'bab_id'];

    public function cerita()
    {
        return $this->belongsTo(Cerita::class);
    }

    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }
}
