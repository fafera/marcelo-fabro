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
}
