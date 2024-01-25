<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    const INDIVIDUAL_ACCOUNT = "individual";
    const COMPANY_ACCOUNT = "company";
    
    protected $fillable = [
        'account_type',
        'currency_id',
        'country_id',
        'amount',
        'phone',
        'name',
        'tracking_code'
    ];
}
