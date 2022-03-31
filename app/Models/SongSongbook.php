<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongSongbook extends Model
{
    use HasFactory;
    protected $table = 'song_songbook';
    protected $fillable = ['song_id', 'songbook_id'];
}
