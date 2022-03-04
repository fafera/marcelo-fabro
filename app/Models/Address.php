<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['client_id', 'cep', 'street', 'city', 'uf', 'district', 'number', 'complement'];
    protected $appends = ['full_address'];
    use HasFactory;

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function getFullAddressAttribute() {
        return $this->street. ", nº ". $this->number." - ".$this->district. " - ".$this->city;  
    }
}
