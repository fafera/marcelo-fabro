<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Project;
use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'date', 'time', 'place', 'city', 'project_id', 'message', 'with_singer', 'client_id'];
    use HasFactory;

    public function getDateAttribute($date) {
        if(isset($date) && $date != null) 
            return DateHelper::covertToBRDateFormat($date);
        return null;
    }
    public function getTimeAttribute($time) {
        if(isset($time))
            return DateHelper::convertToBRTimeFormat($time);
        return null;
    }
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
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function clientPage() {
        return $this->hasOne(ClientPage::class, 'quote_id')->withTrashed();
    }
    public function eventPage() {
        return $this->hasOne(ClientEventPage::class, 'quote_id');
    }
    public function contract() {
        return $this->hasOne(Contract::class, 'quote_id');
    }
    public function getInfoStringAttribute() {
        if($this->client !== null) {
            $infoString = $this->client->name. " @ ".$this->place." - ". $this->date. " | ". $this->time. " - ". $this->project->title;
            return $infoString;
        }
        return null;
    }
    public function setlist() {
        return $this->hasMany(Setlist::class, 'quote_id');
    }
    public function customMoment() {
        return $this->hasOne(CustomMoment::class, 'quote_id');
    }
}
