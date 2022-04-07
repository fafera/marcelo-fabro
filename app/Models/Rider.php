<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;
    public $fillable = ['quote_id', 'file'];
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
