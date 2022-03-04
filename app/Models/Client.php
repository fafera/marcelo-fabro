<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cpf', 'email', 'phone', 'user_id', 'quote_id'];
    public function address() {
        return $this->hasOne(Address::class, 'client_id');
    }
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
