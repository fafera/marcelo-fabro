<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['quote_id', 'slug'];

    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
