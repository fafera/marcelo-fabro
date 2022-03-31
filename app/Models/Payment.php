<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['value', 'contract_id'];

    public function contract() {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
