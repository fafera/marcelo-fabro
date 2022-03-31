<?php

namespace App\Models;

use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Songbook extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'singable'];

    public function getSingableStringAttribute() {
        return $this->singable === 1 ? 'Sim' : 'Não';
    }
    public function songs() {
        return $this->belongsToMany(Song::class, 'song_songbook', 'songbook_id', 'song_id');
    }
}
