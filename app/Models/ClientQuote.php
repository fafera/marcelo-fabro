<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientQuote extends Model
{
    protected $table = ['client_quote'];
    protected $fillable = ['client_id', 'quote_id'];
    use HasFactory;
}
