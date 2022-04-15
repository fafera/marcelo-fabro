<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSong extends Model
{
    protected $fillable = ['title', 'performer', 'moment_id'];
    use HasFactory;
    public function getFullStringAttribute() {
        return $this->title. " - ".$this->performer;
    }
    public function setlist() {
        return $this->hasOne(Setlist::class, 'custom_song_id');
    }
    public function quote() {
        return $this->hasOneThrough(Quote::class, Setlist::class, 'custom_song_id', 'id', 'id', 'quote_id');
    }
}
