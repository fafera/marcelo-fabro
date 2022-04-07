<?php

namespace App\Models;

use App\Helpers\DateHelper;
use App\Helpers\FinancialHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['value','date', 'contract_id'];

    public function contract() {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function setDateAttribute($value) {
        $this->attributes['date'] = DateHelper::convertToDateFormat($value);
    }
    public function setValueAttribute($value) {
        $this->attributes['value'] = FinancialHelper::formatBRLtoDecimal($value);
    }
    public function getvalueBRLAttribute() {
        if($this->value != null) {
            return FinancialHelper::formatToBRL($this->value);
        }
        return false;
    }
    public function getDateBRAttribute() {
        if($this->date != null) {
            return DateHelper::covertToBRDateFormat($this->date);
        }
        return false;
    }
}
