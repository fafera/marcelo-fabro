<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMoment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'quote_id'];
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
