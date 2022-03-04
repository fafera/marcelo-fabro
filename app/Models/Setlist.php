<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setlist extends Model
{
    use HasFactory;
    protected $fillable = ['song_id', 'quote_id', 'moment_id', 'custom_song_id'];

    public function moment() {
        return $this->belongsTo(Moment::class, 'moment_id');
    }
    public function song() {
        return $this->belongsTo(Song::class, 'song_id');
    }
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
    public function customSong() {
        return $this->belongsTo(CustomSong::class, 'custom_song_id');
    }
}
