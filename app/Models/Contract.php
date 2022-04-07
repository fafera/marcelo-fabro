<?php

namespace App\Models;

use App\Helpers\FinancialHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['quote_id', 'client_id', 'custom_text', 'file', 'value', 'value_in_full'];
    //protected $appends = ['value_br'];
    // public function getValueAttribute($value) {
    //     return FinancialHelper::formatToBRL($value);
    // }
    public function getValueBRLAttribute($value) {
        return FinancialHelper::formatToBRL($this->value);
    }
    public function setValueAttribute($value) {
        $this->attributes['value'] = FinancialHelper::formatBRLtoDecimal($value);
    }
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
    public function payments() {
        return $this->hasMany(Payment::class, 'contract_id');
    }
    public function getisPaymentDoneAttribute() {
        if(!$this->payments->isEmpty()) {
            return $this->payments->sum('value') >= $this->value ? true : false ;
        }
        return false;
    }
    public function getRemainingAmountAttribute() {
        if(!$this->payments->isEmpty()) {
            return $this->value - $this->payments->sum('value');
        }
        return $this->value;
    }
    public function getRemainingAmountBRLAttribute () {
        if($this->remainingAmount) {
            return FinancialHelper::formatToBRL($this->remainingAmount); 
        }
        return false;
    }
    public function getIsPaymentPartialAttribute() {
        if(!$this->payments->isEmpty()) {
            return $this->value > $this->payments->sum('value');
        }
        return false;
    }
    
}
