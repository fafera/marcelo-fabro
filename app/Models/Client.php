<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cpf', 'email', 'phone'];
    public function address() {
        return $this->hasOne(Address::class, 'client_id');
    }
    public function quote() {
        return $this->hasOne(Quote::class, 'client_id');
    }
    public function contract() {
        return $this->hasOne(Contract::class, 'client_id');
    }
    public function eventPage() {
        return $this->hasOne(ClientEventPage::class, 'client_id');
    }
    public function setlistSongs() {
        return $this->hasManyThrough(Setlist::class, Quote::class, 'client_id', 'quote_id');
    }
}
