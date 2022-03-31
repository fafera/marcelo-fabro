<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $fillable = ['title', 'performer'];
    public $appends = ['full_string'];
    use HasFactory;

    public function getFullStringAttribute() {
        return $this->title. ' - '.$this->performer;
    } 
    public function songbooks() {
        return $this->belongsToMany(Songbook::class, 'song_songbook', 'song_id', 'songbook_id');
    }
    public function setlists() {
        return $this->hasMany(Setlist::class, 'song_id');
    }
}
