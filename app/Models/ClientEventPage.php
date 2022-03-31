<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientEventPage extends Model
{
    use HasFactory;
    protected $fillable = ['quote_id', 'client_id', 'slug'];
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
    public function contract() {
        return $this->hasOne(Contract::class, 'client_id', 'client_id');
    }
}
