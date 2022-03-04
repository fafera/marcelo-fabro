<?php

namespace App\Models;

use App\Helpers\FinancialHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['quote_id', 'client_id', 'custom_text', 'file', 'value', 'value_in_full'];
    protected $appends = ['value_br'];
    // public function getValueAttribute($value) {
    //     return FinancialHelper::formatToBRL($value);
    // }
    public function getValueBrAttribute($value) {
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
    
}
