<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'date', 'time', 'place', 'project', 'message'];

    use HasFactory;

    /* public function setDateAttribute($date) {
        if(isset($date)) {
            $date = Carbon::createFromFormat('d/m/Y', $date);
            $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
        }
    }
    public function setTimeAttribute($time) {
        if(isset($time)) {
            $time = Carbon::createFromFormat('H:i', $time);
            $this->attributes['time'] = Carbon::parse($time)->format('hh:mm:ss');
        }
    } */
}
