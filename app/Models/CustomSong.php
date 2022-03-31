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
}
