<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'currency_id',
    ];

    protected $table = "country";
    
    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
