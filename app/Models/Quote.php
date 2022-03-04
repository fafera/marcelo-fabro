<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Project;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'date', 'time', 'place', 'project_id', 'message'];
    use HasFactory;

    public function getDateAttribute($date) {
        if(isset($date)) 
            return DateHelper::covertToBRDateFormat($date);
        return null;
    }
    public function getTimeAttribute($time) {
        if(isset($time))
            return DateHelper::convertToBRTimeFormat($time);
        return null;
    }
    /* 
    public function getDateBrAttribute() {
        return DateHelper::covertToBRDateFormat($this->date);
    }
    public function getTimeBrAttribute() {
        return DateHelper::convertToBRTimeFormat($this->time);
    } */
    public function getQuoteStringAttribute() {
        if(!empty($this->attributes)) {
            return $this->name. " - ". $this->date. " - ". $this->time. " - ". $this->place . " - ". $this->project->title;
        }
        return null;
    }
    public function project() {
        return $this->belongsTo(Project::class, 'project_id' );
    }
    public function client() {
        return $this->hasOne(Client::class, 'quote_id');
    }
    // public function client() {
    //     return $this->belongsToMany(Client::class, 'client_quote');
    // }
    public function clientPage() {
        return $this->hasOne(ClientPage::class, 'quote_id')->withTrashed();
    }
    public function contract() {
        return $this->hasOne(Contract::class, 'quote_id');
    }
    public function getInfoStringAttribute() {
        if($this->client !== null) {
            $infoString = $this->client->name. " @ ".$this->place." - ". $this->date. " | ". $this->time;
            return $infoString;
        }
        return null;
    }
    public function setlist() {
        return $this->hasMany(Setlist::class, 'quote_id');
    }
}
