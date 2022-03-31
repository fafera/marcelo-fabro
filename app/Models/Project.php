<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'has_songbook'];
    use HasFactory;
    public function getHasSongbookStringAttribute() {
        return $this->has_songbook === 0 ?  'Não': 'Sim';
    }
    public function quotes() {
        return $this->hasMany(Quote::class, 'project_id');
    }
}
